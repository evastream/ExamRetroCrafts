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

class Footer extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Cms\Model\Template\FilterProvider
     */
    protected $_filterProvider;

    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * Block factory
     *
     * @var \Magento\Cms\Model\BlockFactory
     */
    protected $_blockFactory;

    /**
     *
     * @var \Field\Themesettings\Helper\Theme
     */
    protected $_field;

    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Context $context
     * @param \Magento\Cms\Model\Template\FilterProvider $filterProvider
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Cms\Model\BlockFactory $blockFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Cms\Model\Template\FilterProvider $filterProvider,
        \Magento\Cms\Model\BlockFactory $blockFactory,
        \Field\Themesettings\Helper\Theme $field,
        array $data = []
    ) {
        $this->_filterProvider = $filterProvider;
        $this->_blockFactory = $blockFactory;
        $this->_field = $field;
        parent::__construct($context, $data);
    }
    public function getRequestParam( $param, $alias_param ="", $default = null) {
        return $this->getRequest()->getParam($param, $this->getRequest()->getParam($alias_param, $default));
    }
    public function getStaticBlock($blockId){
        $html = '';
        if($this->_field->getGeneralCfg("general_settings/paneltool")){
            $blockId_tmp = $this->getRequest()->getParam('footer_layout', $this->getRequest()->getParam('footer', false));
            if($blockId_tmp) {
                $blockId = trim($blockId_tmp);
            }
        }

        if ($blockId) {
            $storeId = $this->_storeManager->getStore()->getId();
            /** @var \Magento\Cms\Model\Block $block */
            $block = $this->_blockFactory->create();
            if(is_numeric($blockId)) {
                $block->setStoreId($storeId)->load((int)$blockId);
            } else {
                $block->setStoreId($storeId)->getBlockByAlias($blockId);
            }
            
            if ($block->isActive()) {
                $html = $this->_filterProvider->getBlockFilter()->setStoreId($storeId)->filter($block->getContent());
            }
        }
        return $html;
    }
}