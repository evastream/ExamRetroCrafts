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
namespace Field\Megamenu\Block\Adminhtml\System\Config\Form\Field;

use Magento\Backend\Block\Template;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Data\Form\Element\Renderer\RendererInterface;

class Yesno extends \Magento\Backend\Block\Widget\Grid\Extended
{

	/**
     * Prepare chooser element HTML
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element Form Element
     * @return \Magento\Framework\Data\Form\Element\AbstractElement
     */
    public function prepareElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
    	$defaultValue = $this->getData("value");
    	$values = [
    		[
    			'label' => __('Yes'),
    			'value' => 1
    		],
    		[
    			'label' => __('No'),
    			'value' => 0
    		]
    	];
    	$name = $element->getName();
    	$value = $element->getValue();
    	$html = '';
    	$html .= '<select name="' . $name . '" class="widget-option select admin__control-select">';
    	foreach ($values as $k => $v) {
    		$attr = '';
    		if(($value!='' && $v['value'] == $value )){
    			$attr = 'selected';
    		}
    		$html .= '<option value="' . $v['value'] . '" ' . $attr . '>' . $v['label'] . '</option>';
    	}
    	$html .= '</select>';

        $element->setData('after_element_html', $html);
        return $element;
    }

    public function getLabelHtml(){
    	return '';
    }
}
