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
 * @package    Field_PageBuilder
 * @copyright  Copyright (c) 2016 Fieldthemes (http://www.fieldthemes.com/)
 * @license    http://www.fieldthemes.com/LICENSE-1.0.html
 */
namespace Field\PageBuilder\Block\Widget;

use Magento\Framework\App\Filesystem\DirectoryList;

class Builder extends AbstractWidget
{


    /**
     * Block Collection
     */
    protected $_blockCollection;

	/**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var \Field\PageBuilder\Helper\Data
     */
    protected $_blockHelper;

    /**
    * @var \Magento\Store\Model\StoreManagerInterface
    */
    protected $_storeManager;

    /**
     * @var \Magento\Framework\Filesystem
     */
    protected $_filesystem;
     /**
     * @var \Magento\Framework\App\Http\Context
     */
    protected $httpContext;

    /**
     * @var string $_config
     * 
     * @access protected
     */
    protected $_listDesc = array();
    
    /**
     * @var string $_config
     * 
     * @access protected
     */
    protected $_show = 0;
    protected $_theme = "";

    protected $_banner = null;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context         
     * @param \Magento\Framework\Registry                      $registry 
     * @param \Magento\Framework\Filesystem                    $filesystem,
     * @param \Magento\Store\Model\StoreManagerInterface       $storeManager,       
     * @param \Field\PageBuilder\Helper\Data                    $blockHelper     
     * @param \Field\PageBuilder\Model\Block                    $blockCollection 
     * @param array                                            $data            
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Field\PageBuilder\Helper\Data $blockHelper,
        \Field\PageBuilder\Model\Block $blockCollection,
        \Magento\Framework\App\Http\Context $httpContext,
        \Field\PageBuilder\Helper\MobileDetect $mobileDetectHelper,
        array $data = []
        ) {
        $this->_blockCollection = $blockCollection;
        $this->_blockHelper = $blockHelper;
        $this->_coreRegistry = $registry;
        $this->_storeManager = $storeManager;
        $this->_filesystem = $filesystem;
        $this->httpContext = $httpContext;

        parent::__construct($context, $blockHelper, $mobileDetectHelper, $data);
    }

     /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        parent::_construct();
        $this->addData([
            'cache_lifetime' => 86400,
            'cache_tags' => [\Field\PageBuilder\Model\Block::CACHE_BLOCK_TAG,
            ], ]);
    }

    /**
     * Get key pieces for caching block content
     *
     * @return array
     */
    public function getCacheKeyInfo()
    {
        $block_id = $this->getConfig("block_id");
        $block_id = $block_id?$block_id:0;
        $code = $this->getConfig('code');

        $conditions = $code.".".$block_id;

        return [
        'FIELD_PAGEBUILDER_BUILDER_WIDGET',
        $this->_storeManager->getStore()->getId(),
        $this->_design->getDesignTheme()->getId(),
        $this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_GROUP),
        $conditions
        ];
    }
   
    public function _toHtml()
    {

        if(!$this->_blockHelper->getConfig('general/show')) return;
       
        $block_id = $this->getConfig("block_id");
        $block_id = $block_id?$block_id:0;
        $code = $this->getConfig('code');
        $this->_banner = null;
        if($block_id) {
            $this->_banner  = $this->_blockCollection->load( $block_id );
        }

        if(!$this->_banner && $code) {
            $this->_banner = $this->_blockCollection->getBlockByAlias($code);
        }

        if($this->_banner && !$this->_blockCollection->checkBlockProfileAvailable($this->_banner)) {
            $this->_banner = null;
        }

        if($this->_banner) {
            $params = $this->_banner->getParams();
            $params = \Zend_Json::decode($params);
            $this->assign("layouts", $params);
            $this->assign("is_container", $this->_banner->getContainer());
            $this->assign("class", $this->_banner->getPrefixClass());
            $this->assign("show_title", $this->getConfig("show_title"));
            $this->assign("disable_wrapper", $this->getConfig("disable_wrapper"));
            $this->assign("heading", $this->_banner->getTitle());

            return parent::_toHtml();
        }

        return;
        
    }

    public function renderWidgetShortcode( $shortcode = "") {
        if($shortcode) {
            return $this->_blockHelper->filter($shortcode);
        }
        return;
    }

    public function getBaseMediaUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

    public function getBaseMediaDir() {
        return $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath();
    }

    public function getImageUrl($image = "") {
        $base_media_url = $this->getBaseMediaUrl();
        $base_media_dir = $this->getBaseMediaDir();

        $_imageUrl = $base_media_dir.$image;
       
        if (file_exists($_imageUrl)){
            return $base_media_url.$image;
        }
        return false;
    }
}