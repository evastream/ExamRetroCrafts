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

class BannerCountdown extends AbstractWidget
{
	
	protected $_blockModel;
	protected $_dataFilterHelper;
	protected $_ruleFactory;
	protected $_customerSession;
	protected $_imageHelper;

	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Magento\Cms\Model\Block $blockModel,
		\Field\BaseWidget\Helper\Data $dataHelper,
		\Magento\SalesRule\Model\RuleFactory $ruleFactory,
		\Magento\Customer\Model\Session $customerSession,
		\Magento\Framework\ObjectManagerInterface $objectManager,
		\Field\BaseWidget\Helper\Image $imageHelper,
		array $data = []
		) {
		parent::__construct($context, $blockModel, $dataHelper, $data);
		$this->_blockModel = $blockModel;
		$this->_dataFilterHelper = $dataHelper;
		$this->_ruleFactory = $ruleFactory;
		$this->_customerSession = $customerSession;
		$this->_imageHelper = $imageHelper;
		$this->_objectManager = $objectManager;

		if($this->hasData("template")) {
			$my_template = $this->getData("template");
		}else{
			$my_template = "widget/bannercountdown.phtml";
		}
		$this->setTemplate($my_template);
	}

	public function _toHtml(){
		if(!$this->getDataFilterHelper()->getConfig('general/show')) return;
		$this->setRule($this->getRuleById());
		return parent::_toHtml();
	}
	public function getImageHelper() {
        return $this->_imageHelper;
    }
	public function getRuleById(){
		$current_id = $this->getConfig('filter_group');
		$rule = $this->_ruleFactory->create();
        $rule->load($current_id);
        if ($rule->getId()) {
        	return $rule;
        }
		return false;
	}

	public function checkGroupCustomer($groupid){
		if($groupid) {
			foreach ($groupid as $key => $value) {
				$groupId = $this->_customerSession->getCustomerGroupId();
				if($groupId == $value){
					return true;
				}
			}
		}
		return false;
	}

	public function getBaseMediaUrl(){
        $storeMediaUrl = $this->_objectManager->get('Magento\Store\Model\StoreManagerInterface')
									        ->getStore()
									        ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        return $storeMediaUrl;
    }
}