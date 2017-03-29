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
namespace Field\Themesettings\Observer;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class ProductList implements ObserverInterface
{
	/**
	 * @var \Field\Themesettings\Helper\Theme
	 */
	protected $_field;

	public function __construct(\Field\Themesettings\Helper\Theme $field)
	{
		$this->_field = $field;
	}

	/**
     * Add coupon's rule name to order data
     *
     * @param EventObserver $observer
     * @return $this
     */
	public function execute(EventObserver $observer)
	{
		$field = $this->_field;
		$itemSettings = [
			'show_name',
			'show_name_single_line',
			'show_short_description',
			'short_max_char',
			'show_learnmore',
			'show_price',
			'show_review',
			'show_countdowntimer',
			'show_quickview',
			'quickview_popup_height',
			'quickview_popup_width',
			'show_addtocart',
			'addtocart_popup_height',
			'addtocart_popup_width',
			'show_wishlist',
			'show_compare',
			'show_new_label',
			'show_sale_label',
			'show_image',
			'aspect_ratio',
			'image_width',
			'image_height',
			'alt_image',
			'alt_image_column',
			'alt_image_column_value'
		];
		if($field->getProductListingCfg('general/ovveride_productlist')){
			$obj = $observer->getEvent()->getProductList();
			foreach ($itemSettings as $k => $v) {
				$setting = $field->getProductListingCfg('product_settings/'.$v);
				//echo $v.':'.var_dump($setting).'____';
				$obj->setData($v, $setting);
			}
		}

		$itemDesign = [
			'quickview_format_type',
			'quickview_format_text',
			'quickview_format_class',
			'addtocart_format_type',
			'addtocart_format_text',
			'addtocart_format_class',
			'wishlist_format_type',
			'wishlist_format_text',
			'wishlist_format_class',
			'compare_format_type',
			'compare_format_text',
			'compare_format_class'
		];
		if($field->getProductListingCfg('general/ovveride_productlist')){
			$obj = $observer->getEvent()->getProductList();
			foreach ($itemDesign as $k => $v) {
				$setting = $field->getProductListingCfg('design/'.$v);
				//echo $v.':'.var_dump($setting).'____';
				$obj->setData($v, $setting);
			}
		}
	}
}