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
namespace Field\PageBuilder\Block\Html;
class Assets extends \Magento\Framework\View\Element\Template
{
	/**
     * @var \Magento\Cms\Model\Template\FilterProvider
     */
    protected $_filterProvider;

    /**
     * @var \Magento\Cms\Model\Page
     */
    protected $_page;

    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * Page factory
     *
     * @var \Magento\Cms\Model\PageFactory
     */
    protected $_pageFactory;

    /**
     * @var \Magento\Framework\View\Page\Config
     */
    protected $pageConfig;

	/**
     * @var \Magento\Framework\View\Page\Config
     */
	protected $_dataHelper;

	/**
     * @var \Magento\Framework\View\Page\Config
     */
	protected $_blockModel;

	/**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

	protected $_pageId;

	/**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Context $context
     * @param \Magento\Cms\Model\Page $page
     * @param \Magento\Cms\Model\Template\FilterProvider $filterProvider
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Cms\Model\PageFactory $pageFactory
     * @param \Magento\Framework\View\Page\Config $pageConfig
     * @param array $data
     */

	/**
	 * @param \Magento\Framework\View\Element\Template\Context                   $context          
	 * @param \Field\Themesettings\Model\System\Config\Source\Css\Font\GoogleFonts $_googleFontModel 
	 * @param \Field\Themesettings\Helper\Theme                                    $field              
	 * @param array                                                              $data             
	 */
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
        \Magento\Cms\Model\Page $page,
        \Magento\Cms\Model\Template\FilterProvider $filterProvider,
        /*\Magento\Store\Model\StoreManagerInterface $storeManager,*/
        \Magento\Cms\Model\PageFactory $pageFactory,
        /*\Magento\Framework\View\Page\Config $pageConfig,*/
		\Field\PageBuilder\Helper\Data $dataHelper,
		\Field\PageBuilder\Model\Block $blockModel,
		\Magento\Framework\Registry $registry,
		array $data = []
		){
		parent::__construct($context, $data);

		$this->_dataHelper = $dataHelper;
		$this->_page = $page;
        $this->_filterProvider = $filterProvider;
        /*$this->_storeManager = $storeManager;*/
        $this->_pageFactory = $pageFactory;
        /*$this->pageConfig = $pageConfig;*/
        $this->_coreRegistry = $registry;
        $this->_blockModel = $blockModel;
		
	}

	public function getPageId() {
		if(!$this->_pageId) {
			$this->_pageId = $this->getRequest()->getParam('page_id', $this->getRequest()->getParam('id', false));
		}
		return $this->_pageId;
	}
	/**
     * Retrieve Page instance
     *
     * @return \Magento\Cms\Model\Page
     */
    public function getPage()
    {
        if (!$this->hasData('page')) {
            if ($this->getPageId()) {
            	$page = $this->_coreRegistry->registry('current_cms_page');
            	if(!$page) {
            		/** @var \Magento\Cms\Model\Page $page */
	                $page = $this->_pageFactory->create();
	                $page->setStoreId($this->_storeManager->getStore()->getId())->load($this->getPageId());
	                $this->_coreRegistry->register('current_cms_page', $page);
            	}
                
            } else {
                $page = $this->_page;
            }
            $this->setData('page', $page);
        }
        return $this->getData('page');
    }

	public function _prepareLayout()
    {
    	$page = $this->getPage();
    	$page_url_key = $page->getIdentifier();

    	$this->_page_settings = $this->_coreRegistry->registry('field_pagebuilder_settings');
        $page_profile = $this->_coreRegistry->registry('product_builder_profile');

        if($page_url_key && !$this->_page_settings ) {
            $page_builder = $this->_blockModel->getBlockByAlias($page_url_key, true);
            
            if($page_builder) {
                $this->_page_settings = $page_builder->getSettings();
                $this->_page_settings = unserialize($this->_page_settings);
                $this->_coreRegistry->unregister('field_pagebuilder_settings');
                $this->_coreRegistry->register('field_pagebuilder_settings', $this->_page_settings);
            }
        } elseif($page_profile) {
        	$current_product = $this->_coreRegistry->registry('current_product');
        	$current_category = $this->_coreRegistry->registry('current_category');
            if ($current_product || $current_category) {
                $this->_page_settings = $page_profile->getSettings();
                $this->_page_settings = unserialize($this->_page_settings);
                $this->_coreRegistry->unregister('field_pagebuilder_settings');
                $this->_coreRegistry->register('field_pagebuilder_settings', $this->_page_settings);
            }
        }

        if($this->_page_settings) {
            $custom_js = isset($this->_page_settings['custom_js'])?$this->_page_settings['custom_js']:"";
            $custom_css = isset($this->_page_settings['custom_css'])?$this->_page_settings['custom_css']:"";

            $this->assign("custom_js", $custom_js);
            $this->assign("custom_css", $custom_css);
        }

        return parent::_prepareLayout();
    }

    public function generatePageStyles() {

    	$css_code = "";

    	return $css_code;
    }
}