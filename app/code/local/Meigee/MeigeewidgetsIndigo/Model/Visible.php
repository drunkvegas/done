<?php class Meigee_MeigeewidgetsIndigo_Model_Visible
{
    public function toOptionArray()
    {
        return array(
            array('value'=>'1', 'label'=>Mage::helper('meigeewidgetsindigo')->__('1')),
            array('value'=>'2', 'label'=>Mage::helper('meigeewidgetsindigo')->__('2')),
            array('value'=>'3', 'label'=>Mage::helper('meigeewidgetsindigo')->__('3')),
            array('value'=>'4', 'label'=>Mage::helper('meigeewidgetsindigo')->__('4'))
        );
    }

}