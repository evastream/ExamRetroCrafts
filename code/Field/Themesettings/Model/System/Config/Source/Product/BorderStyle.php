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
namespace Field\Themesettings\Model\System\Config\Source\Product;

class BorderStyle implements \Magento\Framework\Option\ArrayInterface
{
	public function toOptionArray()
	{
		return [
				['value' => 'none', 'label' => __('None')],
				['value' => 'solid', 'label' => __('Solid')],
				['value' => 'dashed', 'label' => __('Dashed')],
				['value' => 'dotted', 'label' => __('Dotted')],
				['value' => 'double', 'label' => __('Double')],
				['value' => 'groove', 'label' => __('Groove')],
				['value' => 'inset', 'label' => __('Inset')],
				['value' => 'outset', 'label' => __('Outset')],
				['value' => 'ridge', 'label' => __('Ridge')],
			];
	}
}
