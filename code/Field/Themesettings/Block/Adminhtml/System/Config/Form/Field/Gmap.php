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

class Gmap extends \Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray
{
    /**
     * @param  \Magento\Framework\Data\Form\Element\AbstractElement $element
     */
    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $html = $element->getElementHtml();
        $elementId = $element->getHtmlId();
        $elementId = str_replace("_address_preview", "", $elementId);
        $latElementId = $elementId.'_location_lat';
        $lngElementId = $elementId.'_location_lng';
        $radiusElementId = $elementId.'_radius';
        $addressElementId = $element->getHtmlId();

        $html .= '<br/><div id="map-'.$element->getHtmlId().'" style="width:600px;height:400px">';
        $html.= '</div>';
        $html.= '<script>
            require([
                "jquery",
                "http://maps.google.com/maps/api/js?sensor=false&libraries=places",
                "Field_Themesettings/js/locationpicker.jquery"],function(){
                jQuery(window).load(function(){
                    jQuery("#map-'.$element->getHtmlId().'").locationpicker({
                        location: {latitude: $("'.$latElementId.'").value, longitude: $("'.$lngElementId.'").value},
                        radius: 100,
                        enableAutocomplete: true,
                        inputBinding: {
                            latitudeInput: jQuery("#'.$latElementId.'"),
                            longitudeInput: jQuery("#'.$lngElementId.'"),
                            locationNameInput: jQuery("#'.$addressElementId.'"),
                            radiusInput: jQuery("#'.$radiusElementId.'")
                        }
                    });
                });
            });
        </script>';
        return $html;
    }
}