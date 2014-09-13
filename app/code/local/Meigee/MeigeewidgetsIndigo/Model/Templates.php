<?php 
/**
 * Magento
 *
 * @author    Meigeeteam http://www.meaigeeteam.com <nick@meaigeeteam.com>
 * @copyright Copyright (C) 2010 - 2012 Meigeeteam
 *
 */
class Meigee_MeigeewidgetsIndigo_Model_Templates
{
    public function toOptionArray()
    {
        return array(
            array('value'=>'meigee/meigeewidgetsindigo/grid.phtml', 'label'=>'Grid'),
            array('value'=>'meigee/meigeewidgetsindigo/list.phtml', 'label'=>'List'),
            array('value'=>'meigee/meigeewidgetsindigo/slider.phtml', 'label'=>'Slider')
        );
    }

}