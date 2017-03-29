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
use Magento\Framework\Data\OptionSourceInterface;

class MenuType implements OptionSourceInterface
{
    public function toOptionArray()
    {
        $options = [];
        $options[] = [
                'label' => __('Child Menu Item'),
                'value' => 'childmenu',
        ];
        $options[] = [
                'label' => __('Content'),
                'value' => 'content',
        ];
        $options[] = [
                'label' => __('Dynamic Content Tab'),
                'value' => 'dynamic',
        ];
        $options[] = [
                'label' => __('Sub-Categories'),
                'value' => 'parentcat',
        ];
        return $options;
    }
}
