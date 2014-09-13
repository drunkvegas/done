<?php

/**
 * @category    Pademobile
 * @package     Pademobile_Pademobile
 * @copyright   Copyright (c) Pademobile International, LLC (https://www.pademobile.com/)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Pademobile
 *
 * @author Pademobile Development Team
 */
class Pademobile_Pademobile_Model_Pademobile extends Mage_Payment_Model_Method_Abstract
{
    const ACTION_CAPTURE = 'capture';
    const XML_PATH_NEW_ORDER_STATE = 'payment/pademobile/order_status';

    /**
     * Payment Method features
     * @var bool
     */
    protected $_canCapture = true;
    protected $_canUseForMultishipping = false;
    protected $_code = 'pademobile';

    /**
     * Return Order place redirect url
     *
     * @return string
     */
    public function getOrderPlaceRedirectUrl()
    {
        return Mage::getUrl('pademobile/standard/redirect', array('_secure' => true));
    }

    public function setOrderAsPaid($order)
    {
        $orderState = Mage::getStoreConfig(self::XML_PATH_NEW_ORDER_STATE);
        $order->setState($orderState, true, Mage::helper('pademobile')->__('Payment through Pademobile.com successfull'));
        $order->save();
        
        return $order;
    }

}