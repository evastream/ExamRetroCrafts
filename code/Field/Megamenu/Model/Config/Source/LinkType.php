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
 * @package    Field_Megamenu
 * @copyright  Copyright (c) 2014 Fieldthemes (http://www.fieldthemes.com/)
 * @license    http://www.fieldthemes.com/LICENSE-1.0.html
 */
namespace Field\Megamenu\Model\Config\Source;

class LinkType
{
    public function toOptionArray()
    {
        $options = [];
        $options[] = [
            'label' => __('Custom Link'),
            'value' => 'custom_link'
        ];
        $options[] = [
            'label' => __('Category Link'),
            'value' => 'category_link'
        ];
        /*$options[] = [
            'label' => __('None'),
            'value' => 'none'
        ];*/
        return $options;
    }
}
