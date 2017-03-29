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
 * @package    Field_Setup
 * @copyright  Copyright (c) 2014 Fieldthemes (http://www.fieldthemes.com/)
 * @license    http://www.fieldthemes.com/LICENSE-1.0.html
 */
namespace Field\Setup\Model\System\Config\Source\Export;

class Widgets implements \Magento\Framework\Option\ArrayInterface
{
	protected  $_widgetModel;

    /**
     * @param \Magento\Cms\Model\Page $widgetModel
     */
    public function __construct(
    	\Magento\Widget\Model\Widget\Instance $widgetModel
    	) {
    	$this->_widgetModel = $widgetModel;
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
    	$collection = $this->_widgetModel->getCollection();
    	$blocks = array();
    	foreach ($collection as $_widget) {
    		$blocks[] = [
    		'value' => $_widget->getId(),
    		'label' => addslashes($_widget->getTitle())
    		];
    	}
        return $blocks;
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toArray()
    {
        $collection = $this->_widgetModel->getCollection();
        $blocks = array();
        foreach ($collection as $_widget) {
            $blocks[$_widget->getId()] = addslashes($_widget->getTitle());
        }
        return $blocks;
    }
}