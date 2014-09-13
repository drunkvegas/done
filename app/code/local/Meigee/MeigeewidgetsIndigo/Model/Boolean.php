<?php class Meigee_MeigeewidgetsIndigo_Model_Boolean
{
    public function toOptionArray()
    {
        return array(
            array('value'=>'1', 'label'=>Mage::helper('meigeewidgetsindigo')->__('True')),
            array('value'=>'0', 'label'=>Mage::helper('meigeewidgetsindigo')->__('False'))
        );
    }

}