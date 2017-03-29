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
namespace Field\Themesettings\Model\System\Config\Source\Css\Background;

class Repeat implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
		return [
			['value' => 'no-repeat', 'label' => __('no-repeat')],
            ['value' => 'repeat', 'label' => __('repeat')],
            ['value' => 'repeat-x',	'label' => __('repeat-x')],
			['value' => 'repeat-y',	'label' => __('repeat-y')]
        ];
    }
}