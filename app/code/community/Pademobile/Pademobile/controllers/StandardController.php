<?php

/**
 * @category    Pademobile
 * @package     Pademobile_Pademobile
 * @copyright   Copyright (c) Pademobile International, LLC (https://www.pademobile.com/)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * StandardController
 *
 * @author Pademobile Development Team
 */
class Pademobile_Pademobile_StandardController extends Mage_Core_Controller_Front_Action
{

    /**
     * redirect customer from shop to Pademobile.com
     */
    public function redirectAction()
    {
        try {
            $session = $this->_getCheckout();

            $order = Mage::getModel('sales/order');
            $order->loadByIncrementId($session->getLastRealOrderId());
            if (!$order->getId()) {
                Mage::throwException('No order for processing found');
            }
            $order->setState(Mage_Sales_Model_Order::STATE_PENDING_PAYMENT, Mage_Sales_Model_Order::STATE_PENDING_PAYMENT,
                Mage::helper('moneybookers')->__('The customer was redirected to Pademobile.')
            );
            $order->save();

            $this->loadLayout();
            $this->renderLayout();
        } catch (Exception $e){
            Mage::logException($e);
            parent::_redirect('checkout/cart');
        }
    }

    /**
     * when customer comes back from Pademobile.com, fetch result and react accordingly
     */
    public function resultAction()
    {
        if (Mage::getStoreConfig('payment/pademobile/debug')) {
            Mage::log($this->getRequest()->getParams(), NULL, 'pademobile.log', TRUE);
        }
        $status = $this->getRequest()->getParam('status');//true or false
        if ($status == 'true') {//payment successfull
            $checkout = $this->_getCheckout();
            if ($checkout->hasLastOrderId()) {//there is a last_order_id param in checkout session
                $lastOrderId = $checkout->getLastOrderId();
                $orderId = $this->getRequest()->getParam('order_id');
                if ($lastOrderId == $orderId) {//checkout session order ID matches order ID sent by Pademobile
                    $order = Mage::getModel('sales/order')->load($orderId);
                    Mage::getModel('pademobile/pademobile')->setOrderAsPaid($order);//mark order as paid
                    $this->_redirect('checkout/onepage/success');//redirect to success page
                } else {//no match between checkout session order ID and order ID sent by Pademobile
                    Mage::register('pademobile_error_message', Mage::helper('pademobile')->__('The order ID doesn\'t match Pademobile.com\'s data.'));
                }
            } else {//last_order_id param in checkout session
                Mage::register('pademobile_error_message', Mage::helper('pademobile')->__('The checkout session has expired.'));
            }
        }
        $this->loadLayout();
        $this->renderLayout();
    }
    
    /**
     * Get singleton of Checkout Session Model
     *
     * @return Mage_Checkout_Model_Session
     */
    protected function _getCheckout()
    {
        return Mage::getSingleton('checkout/session');
    }
}