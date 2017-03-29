<?php
/**
 * Fieldthemes
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the Fieldthemes.com license that is
 * available through the world-wide-web at this URL:
 * http://www.fieldthemes.com/license-agreement.html
 * 
 * DISCLAIMER
 * 
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 * 
 * @category   Fieldthemes
 * @package    Field_BaseWidget
 * @copyright  Copyright (c) 2015 Fieldthemes (http://www.fieldthemes.com/)
 * @license    http://www.fieldthemes.com/LICENSE-1.0.html
 */
namespace Field\BaseWidget\Model\Source;

class ListButtonType implements \Magento\Framework\Option\ArrayInterface
{
    public function __construct() {

    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {   
        return array(
                  array('value' => "btn-default", 'label'=>__('Default')),
                  array('value' => "btn-primary", 'label'=>__('Primary')),
                  array('value' => "btn-success", 'label'=>__('Success')),
                  array('value' => "btn-info", 'label'=>__('Info')),
                  array('value' => "btn-warning", 'label'=>__('Warning')),
                  array('value' => "btn-danger", 'label'=>__('Danger')),
                  array('value' => "btn-link", 'label'=>__('Link'))
                  );
    }
}
