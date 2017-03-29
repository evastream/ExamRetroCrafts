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
namespace Field\Themesettings\Block;

class PanelTool extends \Magento\Framework\View\Element\Template
{
	/**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
	protected $_storeManager;

	/**
	 * @var \Field\Themesettings\Model\System\Config\Source\General\Skins
	 */
	protected $_skins;

	/**
	 * @var \Field\Themesettings\Model\System\Config\Source\Header\Layouts
	 */
	protected $_headerLayout;

	/**
	 * @var \Field\Themesettings\Helper\Theme
	 */
	protected $_field;

	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Field\Themesettings\Model\System\Config\Source\General\Skins $skins,
		\Field\Themesettings\Model\System\Config\Source\Header\Layouts $headerLayout,
		\Field\Themesettings\Helper\Theme $field,
		array $data = []
		){
		parent::__construct($context, $data);
		$this->_skins = $skins;
		$this->_headerLayout = $headerLayout;
		$this->_field = $field;
	}

	public function _toHtml(){
		$field = $this->_field;
		if(!$field->getGeneralCfg("general_settings/paneltool")){
			return;
		}
		return parent::_toHtml();
	}

	public function getSkins(){
		return $this->_skins->toOptionArray();
	}

	public function getHeaderLayouts(){
		return $this->_headerLayout->toOptionArray();
	}

	public function getStoreSwitcherHtml(){
		$html = $this->getLayout()->createBlock('Magento\Store\Block\Switcher')->setTemplate('Field_Themesettings::paneltool/stores.phtml')->toHtml();
		return $html;
	}

	public function getFormUrl(){
		$url = $this->getUrl('themesettings/index/paneltool');
		return $url;
	}
}