<?php 
/**
 * Magento
 *
 * @author    Meigeeteam http://www.meaigeeteam.com <nick@meaigeeteam.com>
 * @copyright Copyright (C) 2010 - 2012 Meigeeteam
 *
 */
class Meigee_ThemeOptionsIndigo_Model_Cssgenerate extends Mage_Core_Model_Abstract
{
    private $baseColors;
    private $headerColors;
    private $appearance;
    private $mediaPath;
    private $dirPath;
    private $filePath;

    private function setParams () {
        $this->baseColors = Mage::getStoreConfig('meigee_indigo_design/base');
		$this->headerColors = Mage::getStoreConfig('meigee_indigo_design/header');
        $this->appearance = Mage::getStoreConfig('meigee_indigo_design/appearance');
    }

    private function setLocation () {
        $this->mediaPath = Mage::getBaseDir('media') . 'images/';
        $this->dirPath = Mage::getBaseDir('skin') . '/frontend/indigo/default/css/';
        $this->filePath = $this->dirPath . 'skin.css';
    }

    public function saveCss()
    {

        $this->setParams();

$css = "/**
*
* This file is generated automaticaly. Please do no edit it directly cause all changes will be lost.
*
*/
";
if ($this->appearance['font'] == 1)
{
    $css .= '/*====== Font Replacement =======*/ ';
    if ($this->appearance['default_sizes'] == 0)
        {
$css .= '
.nav-wide#nav-wide .right-content h2,
.nav-wide#nav-wide .top-content,
.nav-wide#nav-wide .bottom-content,
.nav-wide#nav-wide ul.level0 a span.subtitle,
.product-collateral h2,
header#header .top-cart .block-title a,
.text-block button span,
.std h1,
.price,
.product-name a,
.page-title h2,
.page-title h1,
#footer .custom_footer h3,
aside.sidebar .block .block-title strong span,
aside.sidebar .block .filter-label span,
aside.sidebar .actions a,
button.button span span,
.dashboard .welcome-msg .hello,
.dashboard .box-head h2,
.dashboard .box-title h3,
#login-holder form .actions .link-box a,
.add-to-cart-success,
.add-to-cart-success a,
.account-login .indent h2,
.opc .step-title,
.opc .grid_4 h3,
aside.sidebar .block.block-progress .block-title strong span,
#onepagecheckout_forgotbox .page-title span,
#onepagecheckout_loginbox .page-title span,
#onepagecheckout_forgotbox button.button span span,
#onepagecheckout_loginbox button.button span span,
#onepagecheckout_orderform .col3-set.onepagecheckout_datafields .op_block_title,
#checkout-coupon-discount-load .discount-form .buttons-set button.button span span,
#checkout-review-submit #review-buttons-container button.btn-checkout,
.cart .cart-collaterals h2,
.cart .btn-proceed-checkout,
.product-view .product-name h2,
.block-related .block-title strong span,
.catalog-product-view .box-reviews ul li h6,
header#header .top-cart .block-content .actions a,
header#header .top-cart .block-content .subtotal span,
.catalog-product-view .box-reviews h2,
aside.sidebar .block.block-wishlist li.item .product-details .product-name a,
aside.sidebar .block.block-wishlist .link-cart,
.header-slider-container .iosSlider .slider .item .slide-container h2,
.header-slider-container .iosSlider .slider .item .slide-container.slide-skin-2 h3,
.header-slider-container .iosSlider .slider .item h5,
.header-slider-container .iosSlider .slider .item .slide-container.slide-skin-3 h3{
    font-family: '. $this->appearance['gfont'] .', sans-serif; 
    font-size:'. $this->appearance['fontsize'] .'px !important;
    line-height:' . $this->appearance['lineheight'] .'px !important;
    font-weight:' .$this->appearance['fontweight'] .' !important;
	-webkit-text-stroke-width: 0.02em;
}';
        } else {
        $css .= '
.nav-wide#nav-wide .right-content h2,
.nav-wide#nav-wide .top-content,
.nav-wide#nav-wide .bottom-content,
.nav-wide#nav-wide ul.level0 a span.subtitle,
.product-collateral h2,
header#header .top-cart .block-title a,
.text-block button span,
.std h1,
.price,
.product-name a,
.page-title h2,
.page-title h1,
#footer .custom_footer h3,
aside.sidebar .block .block-title strong span,
aside.sidebar .block .filter-label span,
aside.sidebar .actions a,
button.button span span,
.dashboard .welcome-msg .hello,
.dashboard .box-head h2,
.dashboard .box-title h3,
#login-holder form .actions .link-box a,
.add-to-cart-success,
.add-to-cart-success a,
.account-login .indent h2,
.opc .step-title,
.opc .grid_4 h3,
aside.sidebar .block.block-progress .block-title strong span,
#onepagecheckout_forgotbox .page-title span,
#onepagecheckout_loginbox .page-title span,
#onepagecheckout_forgotbox button.button span span,
#onepagecheckout_loginbox button.button span span,
#onepagecheckout_orderform .col3-set.onepagecheckout_datafields .op_block_title,
#checkout-coupon-discount-load .discount-form .buttons-set button.button span span,
#checkout-review-submit #review-buttons-container button.btn-checkout,
.cart .cart-collaterals h2,
.cart .btn-proceed-checkout,
.product-view .product-name h2,
.block-related .block-title strong span,
.catalog-product-view .box-reviews ul li h6,
header#header .top-cart .block-content .actions a,
header#header .top-cart .block-content .subtotal span,
.catalog-product-view .box-reviews h2,
aside.sidebar .block.block-wishlist li.item .product-details .product-name a,
aside.sidebar .block.block-wishlist .link-cart,
.header-slider-container .iosSlider .slider .item .slide-container h2,
.header-slider-container .iosSlider .slider .item .slide-container.slide-skin-2 h3,
.header-slider-container .iosSlider .slider .item h5,
.header-slider-container .iosSlider .slider .item .slide-container.slide-skin-3 h3{font-family: ' . $this->appearance['gfont'] .', sans-serif; -webkit-text-stroke-width: 0.02em;}';
    }
}

if ($this->appearance['custompatern']) {
$css .= '

/*====== Custom Patern =======*/
body { background: url("' . MAGE::helper('ThemeOptionsIndigo')->getThemeOptionsIndigo('mediaurl') . $this->appearance['custompatern'] . '") center top repeat !important;}';
}
$css .= '

/*====== Site Bg =======*/
body {background-color:#' . $this->baseColors['sitebg'] . ';}

/*====== Skin Color #1 =======*/
.product-collateral .box-collateral ul a:hover,
.product-collateral .box-collateral ol a:hover,
.product-view .short-description ul a:hover,
.product-view .short-description ol a:hover,
.price-as-configured .price,
.minimal-price .price,
.price-box .regular-price .price,
.product-name a:hover,
.color-block .grid_3:hover h3,
nav.breadcrumbs li a:hover,
#categories-accordion li.parent .btn-cat.closed i,
#categories-accordion li.parent.closed .btn-cat i,
.minimal-price-link .price,
.special-price .price,
a,
.availability-only span,
.add-to-links li a i,
p.email-friend a i ,
.add-to-links li a:hover,
p.email-friend a:hover,
.dashboard .welcome-msg .hello strong,
.dashboard a:hover,
.block-account li:hover i,
.block-account li.current i,
#login-holder .close-button i:hover,
#login-holder form a.f-left:hover,
.add-to-cart-success > span,
.account-login .content .buttons-set a:hover,
#checkout-step-login .buttons-set .f-left:hover,
.close_la i:hover,
.onepagecheckout-index-index #onepagecheckout_forgotbox.op_login_area #forgot-password-form .onepagecheckout_loginlink:hover,
.onepagecheckout-index-index #onepagecheckout_loginbox.op_login_area #login-form .onepagecheckout_forgotlink:hover,
.data-table .c_actions a:hover,
.cart-table .price,
.cart .totals table .price,
.cart .totals li > a:hover,
.ratings .rating-links a:hover,
.availability.out-of-stock span,
.tier-prices .price,
.price-from .price,
.price-to .price,
.price-notice .price,
.block-related .block-content .block-subtitle a,
.catalog-product-view .box-reviews ul li small span,
.catalog-product-view .box-reviews .form-add h3 span,
header#header .top-cart .product-name a:hover,
header#header .top-cart .btn-remove i:hover,
header#header .top-cart .btn-edit i:hover,
header#header .top-cart .block-content .mini-products-list .product-details .price,
aside.sidebar .btn-remove i:hover,
.my-wishlist .data-table .table-buttons a:hover i,
.fancybox-close i:hover,
#header > .container_12 .form-currency a:hover,
#header > .container_12 .form-language a:hover,
header#header .top-cart .block-content .subtotal .price,
.block-poll .block-subtitle,
aside.sidebar .block.block-wishlist li.item .product-details .product-name a:hover {color: #' . $this->baseColors['maincolor'] . ';} 

.products-list li.item .product-shop button > span,
.header-slider-container button.button > span,
#checkout-step-login .buttons-set button > span,
.op_login_area button.button > span,
#checkout-coupon-discount-load .discount-form .buttons-set button.button > span,
.cart-table .btn-continue > span,
.discount button > span,
.cart .shipping .buttons-set > span,
.cart .btn-proceed-checkout > span,
#footer > .container_12 button > span,
.block-compare button > span,
.block-reorder button > span,
.products-grid li.item .btn-quick-view.small > span,
aside.sidebar .block.block-subscribe button > span,
.my-wishlist td button > span,
.my-wishlist button.btn-share > span,
#login-holder form .actions button > span,
.cart-empty button.button > span,
header#header .form-search button:hover > span,
header#header .top-cart .block-content .button > span,
.btn-buy > span,
.add-to-cart-success a > span,
#checkout-review-submit #review-buttons-container button.btn-checkout,
header#header .home-button,
#nav > li:hover > a,
#nav > li.over > a,
#nav > li.active > a,
#nav-wide > li:hover > a,
#nav-wide > li.over > a,
#nav-wide > li.active > a,
.header-slider-container .iosSlider:hover .prev:hover,
.header-slider-container .iosSlider:hover .next:hover,
.color-block .grid_3:hover span,
.slider-container .prev i,
.slider-container .next i,
.more-views .prev i,
.more-views .next i,
.block-related .prev i,
.block-related .next i,
aside.sidebar .block.block-wishlist .next i,
aside.sidebar .block.block-wishlist .prev i,
#footer ul.social-links li a:hover,
#slider-range.ui-slider .ui-slider-range.ui-widget-header,
.label-sale,
.opc .active .step-title .number,
#cart-accordion h3.accordion-title.active,
#cart-accordion h3.accordion-title:hover,
.meigee-tabs li.active a,
.meigee-tabs li a:hover,
.product-collateral#collateral-accordion h2:hover,
.product-collateral#collateral-accordion h2.active,
.catalog-product-view .box-reviews .full-review,
#toTopHover,
header#header .links-container > .links > li:hover,
.toolbar-bottom .pager .pages ol li.current,
.toolbar-bottom .pager .pages ol li:hover a,
.menu-button i,
aside.sidebar .block .block-title.active i,
header#header .top-cart .block-title .title-cart > span,
aside.sidebar .block .block-title i:hover,
.ajax-index-options .product-view .product-shop .add-to-cart button > span {background-color: #' . $this->baseColors['maincolor'] . ';}

#onepagecheckout_forgotbox button.button > span,
#onepagecheckout_loginbox button.button > span{background-color: #' . $this->baseColors['maincolor'] . '!important;}

#footer ul.social-links li a:hover,
aside.sidebar .block .filter-label span:after,
header#header .links-container > .links > li:hover a span,
.slider-container .next:after,
aside.sidebar .block.block-wishlist .next:after,
.block-related .next:after {border-color: #' . $this->baseColors['maincolor'] . ';}

span.label-sale:after {border-top-color: #' . $this->baseColors['maincolor'] . '; border-left-color: #' . $this->baseColors['maincolor'] . ';}



/*====== Skin Color #2 =======*/
a:hover,
.product-name a,
.color-block .grid_3 h3,
.minimal-price-link .label,
.dashboard .welcome-msg .hello,
.dashboard .box-title h3,
.account-login .indent h2,
.block-related .block-content .block-subtitle a:hover,
header#header .top-cart .product-name a,
aside.sidebar .block.block-wishlist li.item .product-details .product-name a,
.header-slider-container .iosSlider .slider .item .slide-container.right-caption h2,
.header-slider-container .iosSlider .slider .item .slide-container.slide-skin-2 h3 {color:#' . $this->baseColors['secondcolor'] . ';}

.product-view .product-prev,
.product-view .product-next,
.nav-wide#nav-wide .right-content .banner-box i,
header#header,
footer#footer,
.color-block .grid_3 span,
.view-mode strong,
.view-mode a:hover,
.pager a.asc i,
.pager a.desc i,
aside.sidebar .block.block-layered-nav .ui-slider .ui-slider-handle,
.label-new,
div.quantity-decrease i,
div.quantity-increase i,
#login-holder form .actions .link-box a,
.catalog-product-view .box-reviews .data-table thead,
.button > span,
aside.sidebar .actions a,
.product-buttons .btn-quick-view > span,
header#header .top-cart .block-content .actions a,
.products-grid .product-img-box .btn-quick-view:hover span span,
.products-list .product-img-box .btn-quick-view:hover span span,
 aside.sidebar .block.block-wishlist .link-cart {background-color:#' . $this->baseColors['secondcolor'] . ';}
 
span.label-new:after {
    border-top-color: #' . $this->baseColors['secondcolor'] . ';
    border-left-color: #' . $this->baseColors['secondcolor'] . ';
}
';


    	$this->saveData($css);
        Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('ThemeOptionsIndigo')->__("CSS file with custom styles has been created"));
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




        return true;
    }

    private function saveData($data)
    {
        $this->setLocation ();

        try {
	        /*$fh = fopen($file, 'w');
	       	fwrite($fh, $data);
	        fclose($fh);*/

            $fh = new Varien_Io_File(); 
            $fh->setAllowCreateFolders(true); 
            $fh->open(array('path' => $this->dirPath));
            $fh->streamOpen($this->filePath, 'w+'); 
            $fh->streamLock(true); 
            $fh->streamWrite($data); 
            $fh->streamUnlock(); 
            $fh->streamClose(); 
    	}
    	catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('ThemeOptionsIndigo')->__('Failed creation custom css rules. '.$e->getMessage()));
        }
    }

}