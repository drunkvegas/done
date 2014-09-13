<?php
/**
 * Magento
 *
 * @author    Meigeeteam http://www.meaigeeteam.com <nick@meaigeeteam.com>
 * @copyright Copyright (C) 2010 - 2012 Meigeeteam
 *
 */
class Meigee_ThemeOptionsIndigo_RestoreController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
     $this->loadLayout(array('default'));

         $this->_addLeft($this->getLayout()
                ->createBlock('core/text')
                ->setText('
                    <h5>Predefined pages:</h5>
                    <ul>
                        <li>home</li>
                    </ul><br />
                    <h5>Predefined static blocks:</h5>
                    <ul>
                        <li>indigo_boxed_slide_1</li>
						<li>indigo_boxed_slide_2</li>
						<li>indigo_boxed_slide_3</li>
						<li>indigo_cart_banner</li>
						<li>indigo_footer</li>
						<li>indigo_product_banner</li>
						<li>indigo_product_custom</li>
						<li>indigo_slide_1</li>
						<li>indigo_slide_2</li>
						<li>indigo_slide_3</li>
                    </ul><br />
                    <strong style="color:red;">To get more info regarding these blocks please read documentation that comes with this theme.</strong>'));
		$this->_addContent($this->getLayout()->createBlock('themeoptionsindigo/adminhtml_restore_edit'));
		$this->renderLayout();


    }

    public function saveAction() {
        if ($data = $this->getRequest()->getPost()) {
        	
        $stores = $this->getRequest()->getParam('stores', array(0));
        $setup_package = $this->getRequest()->getParam('setup_package', 0);
        $this->_clear = $this->getRequest()->getParam('clear_scope', false);
        $setup_pages = $this->getRequest()->getParam('setup_pages', 0);
        $setup_blocks = $this->getRequest()->getParam('setup_blocks', 0);

        if ($this->_clear) {
            if ( !in_array(0, $this->_stores) )
                $stores[] = 0;
        }

        try {
            foreach ($stores as $store) {
                $scope = ($store ? 'stores' : 'default');
                Mage::getConfig()->saveConfig('design/header/logo_src', 'images/logo.gif', $scope, $store);
                Mage::getConfig()->saveConfig('design/footer/copyright', '&copy; 2012 Magento Demo Store. All Rights Reserved.', $scope, $store);

                if ($setup_package) {
                    Mage::getConfig()->saveConfig('design/package/name', 'default', $scope, $store);
                }
            }
            $defaults = new Varien_Simplexml_Config();
            $defaults->loadFile(Mage::getBaseDir().'/app/code/local/Meigee/ThemeOptionsIndigo/etc/config.xml');

            $this->_restoreSettings($defaults->getNode('default/meigee_indigo_general')->children(), 'meigee_indigo_general');
            $this->_restoreSettings($defaults->getNode('default/meigee_indigo_general')->children(), 'meigee_indigo_productpage');
            $this->_restoreSettings($defaults->getNode('default/meigee_indigo_general')->children(), 'meigee_indigo_sidebar');
            $this->_restoreSettings($defaults->getNode('default/meigee_indigo_general')->children(), 'meigee_indigo_headerslider');

            if ($setup_pages) {
                Mage::getModel('ThemeOptionsIndigo/restore')->setupPages();
            }

            if ($setup_blocks) {
                Mage::getModel('ThemeOptionsIndigo/restore')->setupBlocks();
            }

            Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('ThemeOptionsIndigo')->__('Default settings has been restored. Please clear all the cache (System > Cache management)'));
        
        }
        catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('ThemeOptionsIndigo')->__('An error occurred while restoring theme. '.$e->getMessage()));
        }

        $this->getResponse()->setRedirect($this->getUrl("*/*/"));
        }
    }

    private function _restoreSettings($items, $path)
    {
        $websites = Mage::app()->getWebsites();
        $stores = Mage::app()->getStores();
        foreach ($items as $item) {
            if ($item->hasChildren()) {
                $this->_restoreSettings($item->children(), $path.'/'.$item->getName());
            } else {
                if ($this->_clear) {
                    Mage::getConfig()->deleteConfig($path.'/'.$item->getName());
                    foreach ($websites as $website) {
                        Mage::getConfig()->deleteConfig($path.'/'.$item->getName(), 'websites', $website->getId());
                    }
                    foreach ($stores as $store) {
                        Mage::getConfig()->deleteConfig($path.'/'.$item->getName(), 'stores', $store->getId());
                    }
                }
                foreach ($this->_stores as $store) {
                    $scope = ($store ? 'stores' : 'default');
                    Mage::getConfig()->saveConfig($path.'/'.$item->getName(), (string)$item, $scope, $store);
                }
            }
        }
    }
}