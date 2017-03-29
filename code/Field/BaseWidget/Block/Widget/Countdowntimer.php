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
use Field\BaseWidget\Block\AbstractProductWidget;
use Magento\Framework\Url;

class Countdowntimer extends AbstractProductWidget{
	/** @var UrlBuilder */
    protected $actionUrlBuilder;

    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;

    protected $_imageHelper;

    protected $_localeDate;

    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Url\Helper\Data $urlHelper,
        \Magento\Cms\Model\Block $blockModel,
        \Field\BaseWidget\Helper\Data $dataHelper,
        \Magento\Catalog\Model\Product $productModel,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        //\Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate,
        Url $actionUrlBuilder,
        \Field\BaseWidget\Helper\Image $imageHelper,
        array $data = []
        ) {
        parent::__construct($context, $urlHelper, $blockModel, $dataHelper, $productModel, $data);
        $this->actionUrlBuilder = $actionUrlBuilder;
        $this->_objectManager = $objectManager;
        $this->_imageHelper = $imageHelper;
        $this->_localeDate = $context->getLocaleDate();

        if($this->hasData("template")) {
            $my_template = $this->getData("template");
        } elseif(isset($data['template']) && $data['template']) {
            $my_template = $data['template'];
        } else{
            $my_template = "widget/countdowntimer.phtml";
        }
        $this->setTemplate($my_template);
    }

    public function getLocaleDate() {
        return $this->_localeDate;
    }
    public function getImageHelper() {
        return $this->_imageHelper;
    }
    public function filter($str)
	{
		$html = $this->getDataFilterHelper()->filter($str);
		return $html;
	}
    
    public function getBaseMediaUrl(){
        $storeMediaUrl = $this->_objectManager->get('Magento\Store\Model\StoreManagerInterface')
        ->getStore()
        ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        return $storeMediaUrl;
    }
}