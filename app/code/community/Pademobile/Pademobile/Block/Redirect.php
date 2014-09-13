<?php

/**
 * @category    Pademobile
 * @package     Pademobile_Pademobile
 * @copyright   Copyright (c) Pademobile International, LLC (https://www.pademobile.com/)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Redirect
 *
 * @author Pademobile Development Team
 */
class Pademobile_Pademobile_Block_Redirect extends Mage_Core_Block_Template
{
    const AMPERSEN = '&';
    const EQUAL = '=';

    /**
     * La URL a cual hay que enviar el cliente
     * El procedimiento de cálculo es el siguiente:
     * Partimos de una "cadena" que consiste en los parámetros originales que vamos a pasar al módulo de pago "online" ya en formato URL, por ejemplo:
     *
     * url=http%3A%2F%2Fwww.dowhiletrue.net%2Fpademobile%2Fstandard%2Fresult%2F&id_usuario=244&param2=arbitrario2&param1=arbitrario1&descripcion=Ha+comprado+usted+algo+bonito&pais=MX&importe=10
     *
     * A la cadena le aplicamos un HMAC usando SHA1 (http://en.wikipedia.org/wiki/HMAC) obteniendo la firma.
     * Añadimos firma como un parámetro más.
     *
     * @return String
     */
    public function getFormActionUrl()
    {
        $backUrl = $this->getBackUrl();
        $userId = $this->getUserId();
        $description = $this->getDescription();
        $country = $this->getCountry();
        $total = $this->getTotal();
        $orderId = $this->getCheckout()->getLastOrderId();
        $gatewayUrl = Mage::getStoreConfig('payment/pademobile/cgi_url');

        $stringToEncrypt = 'url' . self::EQUAL . $backUrl .
                self::AMPERSEN . 'id_usuario' . self::EQUAL . $userId .
                self::AMPERSEN . 'descripcion' . self::EQUAL . $description .
                self::AMPERSEN . 'pais' . self::EQUAL . $country .
                self::AMPERSEN . 'importe' . self::EQUAL . $total .
                self::AMPERSEN . 'order_id' . self::EQUAL . $orderId;
        $signature = $this->encrypt($stringToEncrypt);
        
        if (Mage::getStoreConfig('payment/pademobile/debug')) {
            Mage::log($stringToEncrypt . self::AMPERSEN . 'firma' . self::EQUAL . $signature, NULL, 'pademobile.log', TRUE);
        }

        return $gatewayUrl . '?' . $stringToEncrypt . self::AMPERSEN . 'firma' . self::EQUAL . $signature;
        //http://dev.pademobile.com:710/comprar/?url=http%3A%2F%2Fdowhiletrue.local%2Fpademobile%2Fstandard%2Fresult%2F&id_usuario=244&descripcion=Ha+comprado+usted+algo+bonito&pais=MX&importe=5.90&firma=5bb791c7cace4eceba43116223ace20423a4536f
    }

    public function encrypt($stringToEncrypt)
    {
        $privateKey = Mage::getStoreConfig('payment/pademobile/private_key');

        return hash_hmac('sha1', $stringToEncrypt, $privateKey);
    }

    public function getBackUrl()
    {
        return urlencode(Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB, true) . Mage::getModel('core/url')->sessionUrlVar('pademobile/standard/result', array('_secure' => true)));
    }

    public function getUserId()
    {
        return Mage::getStoreConfig('payment/pademobile/id_usuario');
    }

    public function getDescription()
    {
        $order = $this->getOrder();

        return str_replace(' ', '+', Mage::helper('pademobile')->__('Payment Order %s', $order->getIncrementId()));
    }

    public function getCountry()
    {
        return Mage::getStoreConfig('payment/pademobile/pais');
    }

    public function getTotal()
    {
        $order = $this->getOrder();

        return number_format($order->getBaseGrandTotal(), 2);
    }

    /**
     * Get checkout session namespace
     *
     * @return Mage_Checkout_Model_Session
     */
    public function getCheckout()
    {
        return Mage::getSingleton('checkout/session');
    }

    public function getOrder()
    {
        $checkout = $this->getCheckout();

        return Mage::getModel('sales/order')->load($checkout->getLastOrderId());
    }
}