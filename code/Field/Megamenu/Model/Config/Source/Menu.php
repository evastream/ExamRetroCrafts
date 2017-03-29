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

class Menu implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var \Field\Megamenu\Model\Menu
     */
	protected  $_menu;

    public function __construct(
    	\Field\Megamenu\Model\Menu $menu
    	) {
    	$this->_menu = $menu;
    }

	public function toOptionArray()
	{
		$data = [];
		$collection = $this->_menu->getCollection();
		foreach ($collection as $menu) {
			$data[] = [
				'value' => $menu->getAlias(),
				'label' => $menu->getName()
			];
		}
		return $data;
	}

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
    	return [0 => __('No'), 1 => __('Yes')];
    }
}