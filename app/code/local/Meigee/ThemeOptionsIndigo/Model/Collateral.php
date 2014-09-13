<?php 
/**
 * Magento
 *
 * @author    Meigeeteam http://www.meaigeeteam.com <nick@meaigeeteam.com>
 * @copyright Copyright (C) 2010 - 2012 Meigeeteam
 *
 */
class Meigee_ThemeOptionsIndigo_Model_Collateral
{
    public function toOptionArray()
    {
        return array(
            array('value'=>'collateral_list', 'label'=>Mage::helper('ThemeOptionsIndigo')->__('Simple List')),
            array('value'=>'collateral_tabs', 'label'=>Mage::helper('ThemeOptionsIndigo')->__('Tabs')),
            array('value'=>'collateral_accordion', 'label'=>Mage::helper('ThemeOptionsIndigo')->__('Accordion'))          
        );
    }

}