<?php

/**
 * @category    Pademobile
 * @package     Pademobile_Pademobile
 * @copyright   Copyright (c) Pademobile International, LLC (https://www.pademobile.com/)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Padmeobile
 *
 * @author Pademobile Development Team
 */
class Pademobile_Pademobile_Test_Model_Pademobile extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @test
     * @loadFixture order
     */
    public function orderPaidStatusIsProcessing()
    {
        $expected = $this->_getExpectations();
        $order = Mage::getModel('sales/order')->load(2);
        $actual = Mage::getModel('pademobile/pademobile')->setOrderAsPaid($order);

        $this->assertEquals($expected->getState(), $order->getState());
    }
}