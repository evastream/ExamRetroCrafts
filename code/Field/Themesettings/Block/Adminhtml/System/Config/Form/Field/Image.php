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

class Image extends \Magento\Config\Block\System\Config\Form\Field
{

    /**
     * Add Media Chooser
     *
     * @param Varien_Data_Form_Element_Abstract $element
     * @return String
     */
    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {

        $elementId = $element->getHtmlId();
        $html = $element->getElementHtml();

        $html .= "<div id='field-".$elementId."'>Click Me</div>";
        $html .= "<script type='text/javscript'>
        define(['jquery','mage/adminhtml/browser'
        ], function($) {
            jQuery('#field-".$elementId."').click(function(){
                alert('abc');
            });
        };});
        </script>";
        return $html;
    }
}
