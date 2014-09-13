<?php 
/**
 * Magento
 *
 * @author    Meigeeteam http://www.meaigeeteam.com <nick@meaigeeteam.com>
 * @copyright Copyright (C) 2010 - 2012 Meigeeteam
 *
 */
class Meigee_ThemeOptionsIndigo_Helper_Data extends Mage_Core_Helper_Abstract
{
 public function getThemeOptionsIndigo ($themeOption) {
 	switch ($themeOption) {
		case 'meigee_indigo_general':
		    return Mage::getStoreConfig('meigee_indigo_general');
		break;
		case 'meigee_indigo_design':
		    return Mage::getStoreConfig('meigee_indigo_design');
		break;
		case 'meigee_indigo_productpage':
		    return Mage::getStoreConfig('meigee_indigo_productpage');
		break;
		case 'meigee_indigo_sidebar':
		    return Mage::getStoreConfig('meigee_indigo_sidebar');
		break;
		case 'meigee_indigo_headerslider':
		    return Mage::getStoreConfig('meigee_indigo_headerslider');
		break;
		case 'meigee_indigo_bgslider':
		    return Mage::getStoreConfig('meigee_indigo_bgslider');
		break;
		case 'mediaurl':
		    return Mage::getBaseUrl('media') . 'images/';
		break;
 	}
 }

 public function getProductLabels ($product) {
 	$html = '';
 	if (Mage::getStoreConfig('meigee_indigo_general/productlabels/labelnew')):
		$from = $product->getNewsFromDate();
		$to = new Zend_Date($product->getNewsToDate());
		$now = new Zend_Date(Mage::getModel('core/date')->timestamp(time()));
		if (isset($from) && $to->isLater($now)) $html .= '<span class="label-new">'.$this->__('New').'</span>';
	endif;
	if (Mage::getStoreConfig('meigee_indigo_general/productlabels/labelonsale') and $this->isOnSale($product)):
	 	$html .= '<span class="label-sale">'.$this->__('Sale').'</span>';
	endif;
	return $html;
 }

 public function isNew($product)
	{
		return $this->_nowIsBetween($product->getData('news_from_date'), $product->getData('news_to_date'));
	}
public function isOnSale($product)
{
	$specialPrice = number_format($product->getFinalPrice(), 2);
	$regularPrice = number_format($product->getPrice(), 2);
	
	if ($specialPrice != $regularPrice)
		return true;
	else
		return false;
}

 public function prevnext ($product) {
 	if ($product->getIndigoPrprevnext() < 2 ):
		$prevnext = $this->getThemeOptionsIndigo('meigee_indigo_productpage');
		if ($product->getIndigoPrprevnext() == 1 or $prevnext['productpage']['prevnext'] == 'prevnext'):
		
		 	$_helper = Mage::helper('catalog/output');
			$_product = $product->getProduct();
			$prev_url = $next_url = $url = $product->getProductUrl();
			 
			if (Mage::helper('catalog/data')->getCategory()) {
				$category = Mage::helper('catalog/data')->getCategory();
			} else {
				$_ccats = Mage::helper('catalog/data')->getProduct()->getCategoryIds();
				if(isset($_ccats[0])){
					$category = Mage::getModel('catalog/category')->load($_ccats[0]);
				}else{
					return false;
				}
			}
			 
			$children = $category->getProductCollection();
			$_count = is_array($children) ? count($children) : $children->count();
			if ($_count) {
			foreach ($children as $product) {
			$plist[] = $product->getId();
			}
			 
			/**
			* Determine the previous/next link and link to current category
			*/
			$current_pid  = Mage::helper('catalog/data')->getProduct()->getId();
			$curpos   = array_search($current_pid, $plist);
			// get link for prev product
			$previd   = isset($plist[$curpos+1])? $plist[$curpos+1] : $current_pid;
			$product  = Mage::getModel('catalog/product')->load($previd);
			$prevpos  = $curpos;
			while (!$product->isVisibleInCatalog()) {
			$prevpos += 1;
			$nextid   = isset($plist[$prevpos])? $plist[$prevpos] : $current_pid;
			$product  = Mage::getModel('catalog/product')->load($nextid);
			}
			$prev_url = $product->getProductUrl();
			// get link for next product
			$nextid   = isset($plist[$curpos-1])? $plist[$curpos-1] : $current_pid;
			$product  = Mage::getModel('catalog/product')->load($nextid);
			$nextpos  = $curpos;
			while (!$product->isVisibleInCatalog()) {
			$nextpos -= 1;
			$nextid   = isset($plist[$nextpos])? $plist[$nextpos] : $current_pid;
			$product  = Mage::getModel('catalog/product')->load($nextid);
			}
			$next_url = $product->getProductUrl();
			}
			
			$html ='';
		    if ($url <> $prev_url):
		        $html = '<a class="product-next" title="' . $this->__('Next Product') . '" href="' . $prev_url . '"><i class="fa fa-angle-right"></i></a>';
		    endif;
		    if ($url <> $next_url): 
				$html .= '<a class="product-prev" title="' . $this->__('Previous Product') . '" href="' . $next_url . '"><i class="fa fa-angle-left"></i></a>';
		    endif;

		    return $html;
		else: 
			return false;
		endif;
	else: 
		return false;
	endif;
 }

	public function isActive($attribute, $value){

	    $col = Mage::getModel('cms/block')->getCollection();
	    $col->addFieldToFilter($attribute, $value);
	    $item = $col->getFirstItem();
	    $id = $item->getData('is_active');

	    if($id == 1){
	        return true;
	    }else{
	        return false;
	    }

	}

	public function switchHeader() {
		$headertype = $this->getThemeOptionsIndigo('meigee_indigo_general');
		if ($headertype['header']['headertype'] > 1){
			return 'page/html/header_'.$headertype['header']['headertype'].'.phtml';
		}
		return 'page/html/header.phtml';
	}
	
	public function switchGrid() {
		$switchGrid = $this->getThemeOptionsIndigo('meigee_indigo_general');
		if ((int)$switchGrid['layout']['responsiveness'] !== 1):
			return 'css/grid_' . $switchGrid['layout']['responsiveness'] . '.css';
		endif;
		return 'css/grid_responsive.css';
	}
	
	public function fancySwitcher(){
		$fancy = $this->getThemeOptionsIndigo('meigee_indigo_general');
		if ((int)$fancy['fancybox'] == 1 or (int)$this->getThemeOptionsIndigo('ajax_general') == 1 or (int)$this->getThemeOptionsIndigo('ajax_toolbar') == 1 or (int)$this->getThemeOptionsIndigo('ajax_wishlistcompare') == 1):
			return 'css/fancybox.css';
		endif;
	}

	public function getPaternClass (){
		$patern = $this->getThemeOptionsIndigo('meigee_indigo_design');
		return $patern['appearance']['patern'];
	}
	
	public function getSidebarPos (){
		$sidePos = $this->getThemeOptionsIndigo('meigee_indigo_general');
		return $sidePos['layout']['sidebar'];
	}

	public function fancySwitcherJs(){
		$fancy = $this->getThemeOptionsIndigo('meigee_indigo_general');
		if ((int)$fancy['fancybox'] == 1 or (int)$this->getThemeOptionsIndigo('ajax_general') == 1 or (int)$this->getThemeOptionsIndigo('ajax_toolbar') == 1 or (int)$this->getThemeOptionsIndigo('ajax_wishlistcompare') == 1):
			return 'js/jquery.fancybox.pack.js';
		endif;
	}

	public function HexToRGB($hex) {
	    //$hex = srt_replace("#", "", $hex);
	    $color = '';
	    
	    if(strlen($hex) == 3) {
		    $color .= hexdec(substr($hex, 0, 1) . $r) . ',';
		    $color .= hexdec(substr($hex, 1, 1) . $g) . ',';
		    $color .= hexdec(substr($hex, 2, 1) . $b);
	    }
	    else if(strlen($hex) == 6) {
		    $color .= hexdec(substr($hex, 0, 2)) . ',';
		    $color .= hexdec(substr($hex, 2, 2)) . ',';
		    $color .= hexdec(substr($hex, 4, 2));
	    }
	    
	    return $color;
    }
}
?>