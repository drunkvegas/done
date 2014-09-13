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
class Pademobile_Pademobile_Test_Block_Redirect extends EcomDev_PHPUnit_Test_Case
{

    private $_blockRedirect;

    /**
     * Set up controller params
     * (non-PHPdoc)
     * @see EcomDev_PHPUnit_Test_Case::setUp()
     */
    protected function setUp()
    {
        parent::setUp();

        $this->setCurrentStore('default');
        $this->_blockRedirect = Mage::app()->getLayout()->createBlock('pademobile/redirect');
    }

    /**
     * Stubbing Mage::getSingleton('checkout/session');
     *
     * @return EcomDev_PHPUnit_Test_Case_Controller
     */
    protected function checkoutSessionStub()
    {
        $checkoutSession = $this->getModelMock('checkout/session', array('getData'));

        $checkoutSession->expects($this->any())
            ->method('getData')
            ->will($this->returnCallback(
                array($this, 'stubQuote')
            ));

        $this->replaceByMock('singleton', 'checkout/session', $checkoutSession);
        return $this;
    }

    /**
     * The fixture's order ID is 2
     *
     * @return Integer
     */
    public function stubQuote()
    {
        return 2;
    }

    /**
     * @test
     * @loadFixture config
     * @loadFixture sale
     */
    public function getFormActionUrl()
    {
        $this->checkoutSessionStub();
        $actual = $this->_blockRedirect->getFormActionUrl();
        $expected = $this->expected()->getFormActionUrl();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     * @loadFixture config
     */
    public function encrypt()
    {
        $stringToEncrypt = 'url=http%3A%2F%2Fdowhiletrue.local%2Fpademobile%2Fstandard%2Fresult%2F&id_usuario=244&descripcion=Ha+comprado+usted+algo+bonito&pais=MX&importe=5.90';
        $actual = $this->_blockRedirect->encrypt($stringToEncrypt);
        $expected = $this->expected()->getEncryptedString();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     * @loadFixture sale
     */
    public function getOrder()
    {
        $this->checkoutSessionStub();
        $actual = $this->_blockRedirect->getOrder();
        $expected = $this->expected();

        $this->assertEquals($expected->getEntityId(), $actual->getEntityId());
        $this->assertEquals($expected->getBaseGrandTotal(), $actual->getBaseGrandTotal());
    }

    /**
     * @test
     * @loadFixture sale
     */
    public function getTotal()
    {
        $this->checkoutSessionStub();
        $actual = $this->_blockRedirect->getTotal();
        $expected = $this->expected()->getTotal();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function getBackUrl()
    {
        $expected = $this->expected()->getBackUrl();
        $actual = $this->_blockRedirect->getBackUrl();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     * @loadFixture config
     */
    public function getUserId()
    {
        $expected = $this->expected()->getUserId();
        $actual = $this->_blockRedirect->getUserId();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     * @loadFixture sale
     */
    public function getDescription()
    {
        $this->checkoutSessionStub();
        $expected = $this->expected()->getDescription();
        $actual = $this->_blockRedirect->getDescription();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     * @loadFixture config
     */
    public function getCountry()
    {
        $expected = $this->expected()->getCountry();
        $actual = $this->_blockRedirect->getCountry();

        $this->assertEquals($expected, $actual);
    }
}