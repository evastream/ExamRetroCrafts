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

class Singledeals extends AbstractProductWidget{
	/** @var UrlBuilder */
    protected $actionUrlBuilder;

    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;

    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Url\Helper\Data $urlHelper,
        \Magento\Cms\Model\Block $blockModel,
        \Field\BaseWidget\Helper\Data $dataHelper,
        \Magento\Catalog\Model\Product $productModel,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        Url $actionUrlBuilder,
        array $data = []
        ) {
        parent::__construct($context, $urlHelper, $blockModel, $dataHelper, $productModel, $data);
        $this->actionUrlBuilder = $actionUrlBuilder;
        $this->_objectManager = $objectManager;
        if($this->hasData("template")) {
            $my_template = $this->getData("template");
        } elseif(isset($data['template']) && $data['template']) {
            $my_template = $data['template'];
        } else{
            $my_template = "widget/singledeals.phtml";
        }
        
        $this->setTemplate($my_template);
    }

    public function getMediaUrl(){
        $storeMediaUrl = $this->_objectManager->get('Magento\Store\Model\StoreManagerInterface')
        ->getStore()
        ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        return $storeMediaUrl;
    }
}