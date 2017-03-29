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
 * @package    Field_Themesettings
 * @copyright  Copyright (c) 2014 Fieldthemes (http://www.fieldthemes.com/)
 * @license    http://www.fieldthemes.com/LICENSE-1.0.html
 */
namespace Field\Themesettings\Model\System\Config\Source;

class ThumbLayout implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
                /*['value' => 'default', 'label' => __('Default')],*/
                ['value' => 'horizontal',  'label' => __('Horizontal')],
                ['value' => 'vertical',  'label' => __('Vertical')]
            ];
    }
}