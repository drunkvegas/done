<?php
/**
 * Magento
 *
 * @author    Meigeeteam http://www.meaigeeteam.com <nick@meaigeeteam.com>
 * @copyright Copyright (C) 2010 - 2012 Meigeeteam
 *
 */
class Meigee_ThemeOptionsIndigo_ActivationController extends Mage_Adminhtml_Controller_Action
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
		$this->_addContent($this->getLayout()->createBlock('themeoptionsindigo/adminhtml_activation_edit'));
        $block = $this->getLayout()->createBlock('core/text')->setText('<strong style="color:red;">Activation feature is provided only for testing. Please do not use it on real stores! Make backup of your database every time when you use activation. </strong><br /><strong>Note:</strong> Please make sure you have at least 8 products marked as new to display homepage widgets correctly.');
        $this->getLayout()->getBlock('content')->append($block);
		$this->renderLayout();
    }

    public function saveAction() {
        if ($data = $this->getRequest()->getPost()) {
        	
        $stores = $this->getRequest()->getParam('stores', array(0));
        $setup_pages = $this->getRequest()->getParam('setup_pages', 0);
        $setup_blocks = $this->getRequest()->getParam('setup_blocks', 0);

        try {

            foreach ($stores as $store) {
                $scope = ($store ? 'stores' : 'default');

                Mage::getConfig()->saveConfig('design/package/name', 'indigo', $scope, $store);
                Mage::getConfig()->saveConfig('design/header/logo_src', 'images/logo.png', $scope, $store);
                Mage::getConfig()->saveConfig('design/footer/copyright', 'Meigee &copy; 2013 <a href="http://meigeeteam.com" >Premium Magento Themes</a>', $scope, $store);
				/*Mage::getConfig()->saveConfig('meigee_indigo_headerslider/coin/slides', 'indigo', $scope, $store);*/
            }

            if ($setup_pages) {
                Mage::getModel('ThemeOptionsIndigo/activation')->setupPages();
            }

            if ($setup_blocks) {
                Mage::getModel('ThemeOptionsIndigo/activation')->setupBlocks();
            }

            Mage::getSingleton('adminhtml/session')->addNotice(Mage::helper('ThemeOptionsIndigo')->__('<div class="meigee-please"><a target="_blank" href="http://themeforest.net/user/MeigeeTeam#contact"><img src="' . Mage::getBaseUrl('skin') . '/adminhtml/default/indigo/images/support.png" /></a>&nbsp;<a target="_blank" href="http://themeforest.net/downloads"><img src="' . Mage::getBaseUrl('skin') . '/adminhtml/default/indigo/images/rating.png" /></a><h2>Like us</h2>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>
<div class="fb-like" data-href="http://facebook.com/meigeeteam" data-layout="button_count" data-action="like" data-show-faces="false" data-width="200" data-share="true"></div>&nbsp;
<a href="https://twitter.com/meigeeteam" class="twitter-follow-button" data-show-count="false" data-lang="en">Follow @meigeeteam</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>'));

            Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('ThemeOptionsIndigo')->__('IndigoTheme has been activated.<br/>
                    Please clear all the cache and then logout and login again to see the theme options block
                '));
        }
        catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('ThemeOptionsIndigo')->__('An error occurred while activating theme. '.$e->getMessage()));
        }

        $this->getResponse()->setRedirect($this->getUrl("*/*/"));
        }
    }
}