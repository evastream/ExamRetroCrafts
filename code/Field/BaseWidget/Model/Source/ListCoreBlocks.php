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

class ListCoreBlocks implements \Magento\Framework\Option\ArrayInterface
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
                  array('value' => "top.links", 'label'=>__('Top Links')),
                  array('value' => "catalog.topnav", 'label'=>__('Top Navigation')),
                  array('value' => "wishlist_sidebar", 'label'=>__('Wishlist Sidebar')),
                  array('value' => "form.subscribe", 'label'=>__('Newsletter')),
                  array('value' => "top.search", 'label'=>__('Top Search')),
                  array('value' => "catalog.compare.sidebar", 'label'=>__('Catalog Compare Sidebar')),
                  array('value' => "footer_links", 'label'=>__('Footer Links')),
                  array('value' => "copyright", 'label'=>__('Copyright')),
                  array('value' => "category.products", 'label'=>__('Main Content - Category Products(grid/list)'))
                );
    }
}
