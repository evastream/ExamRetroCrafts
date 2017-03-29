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

class Basemagento extends AbstractWidget
{

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

	public function _toHtml(){
		if(!$this->getDataFilterHelper()->getConfig('general/show')) return;

		$core_block = $this->getMagentoBlock();
		$custom_template = $this->getConfig("custom_template", "");
		if($core_block) {
			if($custom_template) {
				$core_block->setTemplate($custom_template);
			}
			return $core_block->toHtml();
		}
		return;
	}

	protected function _prepareLayout() {
        $block_name = $this->getConfig("block_name", "");
        $custom_block_name = $this->getConfig("custom_block_name", "");
        if($custom_block_name) {
        	$block_name = $custom_block_name;
        }
		$core_block = null;
		if($block_name) {
			$core_block = $this->getLayout()->getBlock($block_name);
		}
		$this->setMagentoBlock($core_block);

        return parent::_prepareLayout();
    }
	
}