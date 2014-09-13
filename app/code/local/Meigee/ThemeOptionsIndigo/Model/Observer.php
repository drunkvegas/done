<?php
/**
 * Call actions after configuration is saved
 */
class Meigee_ThemeOptionsIndigo_Model_Observer
{
	/**
     * After any system config is saved
     */
	public function cssgenerate()
	{
		$section = Mage::app()->getRequest()->getParam('section');

		if ($section == 'meigee_indigo_design')
		{
			Mage::getSingleton('ThemeOptionsIndigo/Cssgenerate')->saveCss();
			$response = Mage::app()->getFrontController()->getResponse();
			$response->sendResponse();
		}

	}
}
