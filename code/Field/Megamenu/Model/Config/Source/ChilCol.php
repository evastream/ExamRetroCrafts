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

class ChilCol implements OptionSourceInterface
{
    public function toOptionArray()
    {
        $options = [];
        $options[] = [
                'label' => '1',
                'value' => 1,
            ];
        $options[] = [
                'label' => '2',
                'value' => 2,
            ];
        $options[] = [
                'label' => '3',
                'value' => 3,
            ];
        $options[] = [
                'label' => '4',
                'value' => 4,
            ];
        $options[] = [
                'label' => '5',
                'value' => 5,
            ];
        $options[] = [
                'label' => '6',
                'value' => 6,
            ];
        $options[] = [
                'label' => '7',
                'value' => 7,
            ];
        $options[] = [
                'label' => '8',
                'value' => 8,
            ];
        $options[] = [
                'label' => '9',
                'value' => 9,
            ];
        $options[] = [
                'label' => '10',
                'value' => 10,
            ];
        $options[] = [
                'label' => '11',
                'value' => 11,
            ];
        $options[] = [
                'label' => '12',
                'value' => 12,
            ];
        return $options;
    }
}
