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

class ListButtonSize implements \Magento\Framework\Option\ArrayInterface
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
            array('value' => "", 'label'=>__('Standard')),
            array('value' => "small", 'label'=>__('Small')),
            array('value' => "medium", 'label'=>__('Medium')),
            array('value' => "larger", 'label'=>__('Larger')),
            array('value' => "tall", 'label'=>__('Tall'))
            );
    }
}
