<?php

/**
 * @category    Pademobile
 * @package     Pademobile_Pademobile
 * @copyright   Copyright (c) Pademobile International, LLC (https://www.pademobile.com/)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Redirect
 *
 * @author Pademobile Development Team
 */
class Pademobile_Pademobile_Block_Result extends Mage_Core_Block_Template
{

    public function getPademobileErrorMessage()
    {
        return Mage::app()->getRequest()->getParam('message');
    }

    public function getInternalErrorMessage()
    {
        return Mage::registry('pademobile_error_message');
    }
}