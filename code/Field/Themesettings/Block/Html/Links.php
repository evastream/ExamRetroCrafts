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

class Links extends \Magento\Framework\View\Element\Html\Links
{
    /**
     * @var \Field\Themesettings\Helper\Theme
     */
	public $_field;
    
    /**
     * @var \Field\Themesettings\Helper\Data
     */
	public $_fieldData;

    public $_fieldBlockData;
	
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context 
     * @param \Field\Themesettings\Helper\Theme                  $field     
     * @param \Field\Themesettings\Helper\Data                   $fieldData 
     * @param array                                            $data    
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Field\Themesettings\Helper\Theme $field,
        \Field\Themesettings\Helper\Data $fieldData,
        array $data = []
        ) {
        parent::__construct($context, $data);
        $this->_field = $field;
        $this->_fieldData = $fieldData;
        $this->_fieldBlockData = $data;
    }

	/**
     * Render block HTML
     *
     * @return string
     */
    protected function _toHtml()
    {	
        if (isset($this->_fieldBlockData['template']) && !empty($this->_fieldBlockData['template'])) {
            $this->setTemplate($this->_fieldBlockData['template']);
        }
        if(!$this->getTemplate()){
    	   $this->setTemplate("Field_Themesettings::html/links.phtml");
        }
        return parent::_toHtml();
    }
}