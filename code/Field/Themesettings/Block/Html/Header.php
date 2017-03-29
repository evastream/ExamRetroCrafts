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
namespace Field\Themesettings\Block\Html;

class Header extends \Magento\Framework\View\Element\Template
{
	/**
     * Current template name
     *
     * @var string
     */
    protected $_template = 'header/default.phtml';

    /**
     * @var \Field\Themesettings\Helper\Theme
     */
    protected $_fieldTheme;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context  
     * @param \Field\Themesettings\Helper\Theme                  $fieldTheme 
     * @param array                                            $data     
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Field\Themesettings\Helper\Theme $fieldTheme,
        array $data = []
        ) {
        parent::__construct($context, $data);
        $this->_fieldTheme = $fieldTheme;
    }

    public function toHtml(){
        $field = $this->_fieldTheme;
        $template = $this->_fieldTheme->getHeaderCfg("general_settings/header_layout");

        if($field->getGeneralCfg("general_settings/paneltool")){
            $header_request = $this->getRequest()->getParam('header_layout', $this->getRequest()->getParam('header', false));
            $header_request = trim($header_request);
            if($header_request) {
                $template = $header_request.".phtml";
            }
        }
        $this->_template = "Field_Themesettings::header/".$template;
        return parent::toHtml();
    }

    public function getFieldElemet($elementName){
        $html = $this->getLayout()->renderElement($elementName);
        return $html;
    }
}