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
 * @copyright  Copyright (c) 2014 Fieldthemes (http://www.fieldthemes.com/)
 * @license    http://www.fieldthemes.com/LICENSE-1.0.html
 */
namespace Field\BaseWidget\Block\Widget;
use Field\BaseWidget\Block\AbstractWidget;

class Newsletter extends AbstractWidget{

	protected $_blockModel;
	protected $_dataFilterHelper;
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Magento\Cms\Model\Block $blockModel,
		\Field\BaseWidget\Helper\Data $dataHelper,
		array $data = []
		) {
		parent::__construct($context, $blockModel, $dataHelper, $data);
		$this->_blockModel = $blockModel;
		$this->_dataFilterHelper = $dataHelper;
	}

	protected function _toHtml(){
		if(!$this->getDataFilterHelper()->getConfig('general/show')) return;

		$block_type = "Magento\Newsletter\Block\Subscribe";
		$block_name = "fieldnewsletter".rand().time();

		$my_template = "";
		if($this->hasData("template") && $this->getData("template")) {
			$my_template = $this->getData("template");
		}else{
			$my_template = "Field_BaseWidget::widget/newsletter.phtml";
		}

		$block_html = "";
		if($block_type) {
			$block = $this->getLayout()->createBlock($block_type, $block_name);
			$block->setData("widget_heading", $this->getConfig("title"));
			$block->setData("signup_text", $this->getConfig("signup_text"));
			$block->setData("button_text", $this->getConfig("button_text"));
			$block->setData("addition_cls", $this->getConfig("addition_cls"));
			$block->setData("title_class", $this->getConfig("title_class"));
			$block->setData("button_class", $this->getConfig("button_class"));
			$block->setData("input_class", $this->getConfig("input_class"));
			$block->setTemplate($my_template);
			$block_html = $block->toHtml();
		}

		return $block_html;
	}
	
}