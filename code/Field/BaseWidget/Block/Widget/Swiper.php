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

class Swiper extends AbstractWidget{
	
	protected $_blockModel;
	protected $_dataFilterHelper;

	protected $_filterProvider;

	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Magento\Cms\Model\Template\FilterProvider $filterProvider,
		\Magento\Cms\Model\Block $blockModel,
		\Field\BaseWidget\Helper\Data $dataHelper,
		array $data = []
		) {
		parent::__construct($context, $blockModel, $dataHelper, $data);
		$this->_blockModel = $blockModel;
		$this->_dataFilterHelper = $dataHelper;
		$this->_filterProvider = $filterProvider;

		if($this->hasData("template")) {
			$my_template = $this->getData("template");
		}elseif(isset($data['template']) && $data['template']) {
			$my_template = $data['template'];
		}else{
			$my_template = "widget/swiper.phtml";
		}
		$this->setTemplate($my_template);
		
	}

	public function _toHtml(){
		if(!$this->getDataFilterHelper()->getConfig('general/show')) return;

		$carousels = array();
		$limit = 30;
		$filter = $this->_filterProvider->getPageFilter();

		for($i=1; $i<=$limit; $i++) {
			$tmp = [];
			$tmp['content'] = $this->getConfig("content_".$i);
			$tmp['size'] = $this->getConfig("size_".$i);
			if($tmp['content']) {
				$tmp['content'] = str_replace(" ", "+", $tmp['content']);
				$tmp['content'] = base64_decode($tmp['content']);
				$tmp['content'] = $filter->filter($tmp['content']);
				$carousels[] = $tmp;
			}
		}
		$this->setDataItems($carousels);

		return parent::_toHtml();
	}
}