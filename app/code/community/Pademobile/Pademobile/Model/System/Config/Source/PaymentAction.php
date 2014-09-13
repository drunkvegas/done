<?php
/**
 * @category    Pademobile
 * @package     Pademobile_Pademobile
 * @copyright   Copyright (c) Pademobile International, LLC (https://www.pademobile.com/)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * PaymentAction
 *
 * @author Pademobile Development Team
 */
class Pademobile_Pademobile_Model_System_Config_Source_PaymentAction
{
    public function toOptionArray()
    {
        return array(
            //for the future...
//            array(
//                'value' => Pademobile_Pademobile_Model_Pademobile::ACTION_AUTHORIZE,
//                'label' => Mage::helper('pademobile')->__('Authorize Only')
//            ),
            array(
                'value' => Pademobile_Pademobile_Model_Pademobile::ACTION_CAPTURE,
                'label' => Mage::helper('pademobile')->__('Capture')
            )
        );
    }
}