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

class Heading extends AbstractWidget{

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

		if($this->hasData("template")) {
        	$my_template = $this->getData("template");
        }else{
 			$my_template = "widget/heading.phtml";
 		}
 		$this->setTemplate($my_template);
	}

	protected function _toHtml(){
		if(!$this->getDataFilterHelper()->getConfig('general/show')) return;

		$content_html = $this->getConfig('content');
		$content_html = str_replace(" ", "+", $content_html);
		$content_html = base64_decode($content_html);
		
		if($content_html) {
			$content_html = $this->getDataFilterHelper()->filter($content_html);
		}
		
		$this->assign('content', $content_html);
		$this->assign('heading_tag', $this->getConfig('heading_tag', 'h1'));
		$this->assign('prefix', $this->getConfig('prefix'));

		return parent::_toHtml();
	}

}