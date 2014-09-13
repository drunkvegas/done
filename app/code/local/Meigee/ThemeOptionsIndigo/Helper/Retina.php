<?php 
/**
 * Magento
 *
 * @author    Meigeeteam http://www.meaigeeteam.com <nick@meaigeeteam.com>
 * @copyright Copyright (C) 2010 - 2012 Meigeeteam
 *
 */
class Meigee_ThemeOptionsIndigo_Helper_Retina extends Mage_Core_Helper_Abstract
{
 
	public function getRetinaData ($data, $_item=0, $_itemparameter=0) {

 		$helpImg = MAGE::helper('ThemeOptionsIndigo/images');

 		if (Mage::getStoreConfig('meigee_indigo_general/retina/status')) {
			switch ($data) {
				case 'logo':
					$html = 'data-srcX2="' . Mage::getDesign()->getSkinUrl('images/@x2/logo@x2.png') . '"';
				break;
				case 'logo_custom':
    				$customlogo = MAGE::helper('ThemeOptionsIndigo')->getThemeOptionsIndigo('customlogo');
					$mediaurl = MAGE::helper('ThemeOptionsIndigo')->getThemeOptionsIndigo('mediaurl');
					$html = 'data-srcX2="' . $mediaurl.$customlogo['logo_retina'] . '"';
				break;
				case 'small_logo':
					$html = 'data-srcX2="' . Mage::getDesign()->getSkinUrl('images/@x2/small_logo@x2.png') . '"';
				break;
				case 'small_logo_custom':
    				$customlogo = MAGE::helper('ThemeOptionsIndigo')->getThemeOptionsIndigo('customlogo');
					$mediaurl = MAGE::helper('ThemeOptionsIndigo')->getThemeOptionsIndigo('mediaurl');
					$html = 'data-srcX2="' . $mediaurl.$customlogo['logo_retina'] . '"';
				break;
				default:
					# code...
					break;
			}
			return $html;
		}
		else return false;
	}

}