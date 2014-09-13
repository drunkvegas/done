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
class Pademobile_Pademobile_Model_System_Config_Source_Url
{
    /**
     * @todo lista de paises
     * 
     * @return Array
     */
    public function toOptionArray()
    {
        return array(
            array(
                'value' => 'http://dev.pademobile.com:710/comprar',
                'label' => Mage::helper('pademobile')->__('Test')
            ),
            array(
                'value' => 'https://www.pademobile.com:810/comprar',
                'label' => Mage::helper('pademobile')->__('Production')
            )
        );
    }
}