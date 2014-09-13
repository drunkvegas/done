<?php
class Meigee_ThemeOptionsIndigo_Block_Adminhtml_Addresses extends Mage_Adminhtml_Block_System_Config_Form_Field
{
   protected $_addRowButtonHtml = array();
   protected $_removeRowButtonHtml = array();
 
   /**
    * Returns html part of the setting
    *
    * @param Varien_Data_Form_Element_Abstract $element
    * @return string
    */
   protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
   {
       $this->setElement($element);
 
       $html = '<div id="emailblocker_addresses_template" style="display:none">';
       $html .= $this->_getRowTemplateHtml();
       $html .= '</div>';
 
       $html .= '<ul id="emailblocker_addresses_container">';
       if ($this->_getValue('addresses')) {
           foreach ($this->_getValue('addresses') as $i => $f) {
               if ($i) {
                   $html .= $this->_getRowTemplateHtml($i);
               }
           }
       }
       $html .= '</ul>';
       $html .= $this->_getAddRowButtonHtml('emailblocker_addresses_container',
           'emailblocker_addresses_template', $this->__('Add New Email'));
 
       return $html;
   }
 
   /**
    * Retrieve html template for setting
    *
    * @param int $rowIndex
    * @return string
    */
   protected function _getRowTemplateHtml($rowIndex = 0)
   {
       $html = '<li>';
 
       $html .= '<div style="margin:5px 0 10px;">';
       $html .= '<input style="width:100px;" name="'
           . $this->getElement()->getName() . '[addresses][]" value="'
           . $this->_getValue('addresses/' . $rowIndex) . '" ' . $this->_getDisabled() . '/> ';
 
       $html .= $this->_getRemoveRowButtonHtml();
       $html .= '</div>';
       $html .= '</li>';
 
       return $html;
   }
 
   protected function _getDisabled()
   {
       return $this->getElement()->getDisabled() ? ' disabled' : '';
   }
 
   protected function _getValue($key)
   {
       return $this->getElement()->getData('value/' . $key);
   }
 
   protected function _getSelected($key, $value)
   {
       return $this->getElement()->getData('value/' . $key) == $value ? 'selected="selected"' : '';
   }
 
   protected function _getAddRowButtonHtml($container, $template, $title='Add')
   {
       if (!isset($this->_addRowButtonHtml[$container])) {
           $this->_addRowButtonHtml[$container] = $this->getLayout()->createBlock('adminhtml/widget_button')
               ->setType('button')
               ->setClass('add ' . $this->_getDisabled())
               ->setLabel($this->__($title))
               ->setOnClick("Element.insert($('" . $container . "'), {bottom: $('" . $template . "').innerHTML})")
               ->setDisabled($this->_getDisabled())
               ->toHtml();
       }
       return $this->_addRowButtonHtml[$container];
   }
 
   protected function _getRemoveRowButtonHtml($selector = 'li', $title = 'Delete')
   {
       if (!$this->_removeRowButtonHtml) {
           $this->_removeRowButtonHtml = $this->getLayout()->createBlock('adminhtml/widget_button')
               ->setType('button')
               ->setClass('delete v-middle ' . $this->_getDisabled())
               ->setLabel($this->__($title))
               ->setOnClick("Element.remove($(this).up('" . $selector . "'))")
               ->setDisabled($this->_getDisabled())
               ->toHtml();
       }
       return $this->_removeRowButtonHtml;
   }
}