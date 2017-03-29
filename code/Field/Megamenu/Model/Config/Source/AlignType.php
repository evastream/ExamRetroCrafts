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

class AlignType implements OptionSourceInterface
{
    public function toOptionArray()
    {
        $options = [];
        $options[] = [
                'label' => __('From left menu'),
                'value' => '1',
            ];
        $options[] = [
                'label' => __('From right menu'),
                'value' => '2',
        ];
        $options[] = [
                'label' => __('From left item'),
                'value' => '3',
        ];
        $options[] = [
                'label' => __('From right item'),
                'value' => '4',
        ];
        return $options;
    }
}
