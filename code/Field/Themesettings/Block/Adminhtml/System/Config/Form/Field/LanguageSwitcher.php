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
namespace Field\Themesettings\Block\Adminhtml\System\Config\Form\Field;

class LanguageSwitcher extends \Magento\Config\Block\System\Config\Form\Field
{
    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
    	$elementId = $element->getHtmlId();
    	$html = $element->getElementHtml();
    	$moduleName = $this->getModuleName();
    	$mcPath = $this->getViewFileUrl($moduleName.'/js/mcolorpicker');
    	$html .= '
    	<script>
    	require([
        "jquery",
        "Field_Themesettings/js/mcolorpicker/mcolorpicker.min"
        ], function (jQuery) {
				var folderImageUrl = "'.$mcPath.'/images";
        		jQuery.noConflict();
				jQuery.fn.mColorPicker.init.replace = false;
				jQuery.fn.mColorPicker.defaults.imageFolder = "'. $mcPath .'/images/";
				jQuery.fn.mColorPicker.init.allowTransparency = true;
				jQuery.fn.mColorPicker.init.showLogo = false;
				jQuery("#'. $elementId .'").attr("data-hex", true).width("250px").mColorPicker();
				
				jQuery("#mColorPickerImg").css("background-image","url('.$mcPath.'/images/picker.png)");
				jQuery("#mColorPickerFooter").css("background-image","url('.$mcPath.'/images/grid.gif)");
				jQuery("#mColorPickerFooter img").attr({"src":"'.$mcPath.'/images/meta100.png"});

				jQuery("#'. $elementId .'").click(function(){
					console.log("aaa");
					jQuery("#mcp_'. $elementId .' img").trigger("click");
				});
			});</script>';
    	return $html;
    }

}