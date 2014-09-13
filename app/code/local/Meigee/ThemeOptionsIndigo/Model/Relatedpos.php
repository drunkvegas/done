<?php 
/**
 * Magento
 *
 * @author    Meigeeteam http://www.meaigeeteam.com <nick@meaigeeteam.com>
 * @copyright Copyright (C) 2010 - 2012 Meigeeteam
 *
 */
class Meigee_ThemeOptionsIndigo_Model_Relatedpos
{
    public function toOptionArray()
    {
        return array(
            array('value'=>'left', 'label'=>Mage::helper('ThemeOptionsIndigo')->__('Left Column')),
			array('value'=>'right', 'label'=>Mage::helper('ThemeOptionsIndigo')->__('Right Column')),
			array('value'=>'bottom', 'label'=>Mage::helper('ThemeOptionsIndigo')->__('Bottom'))
        );
    }

}