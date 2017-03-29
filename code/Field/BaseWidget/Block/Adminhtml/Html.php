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
 * @package    Field_ImageSlider
 * @copyright  Copyright (c) 2014 Fieldthemes (http://www.fieldthemes.com/)
 * @license    http://www.fieldthemes.com/LICENSE-1.0.html
 */
namespace Field\BaseWidget\Block\Adminhtml;

class Html extends \Magento\Framework\View\Element\Template implements \Magento\Widget\Block\BlockInterface
{
	/**
     * @var \Magento\Framework\Data\Form\Element\CollectionFactory
     */
    protected $_factoryCollection;

    /**
     * @var \Magento\Framework\Data\Form\Element\Factory
     */
    protected $_factoryElement;

    /**
     * @var \Magento\Framework\Escaper
     */
    protected $_escaper;

    /**
     * @var \Magento\Framework\View\LayoutInterface
     */
    protected $_layout;

    /**
     * Adminhtml data
     *
     * @var \Magento\Backend\Helper\Data
     */
    protected $_backendData = null;

    protected $_storeManager;
    protected $_dataHelper;
    protected $_coreRegistry;
    protected $_widgetHelper;
	/**
     * @param \Magento\Backend\Block\Template\Context                $context           
     * @param \Magento\Framework\Data\Form\Element\Factory           $factoryElement    
     * @param \Magento\Framework\Data\Form\Element\CollectionFactory $factoryCollection 
     * @param Escaper                                                $escaper           
     * @param \Field\BaseWidget\Helper\Data                            $dataHelper     
     * @param \Magento\Framework\View\LayoutInterface                $layout            
     * @param \Magento\Backend\Helper\Data                           $backendData       
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Data\Form\Element\Factory $factoryElement,
        \Magento\Framework\Data\Form\Element\CollectionFactory $factoryCollection,
        \Field\BaseWidget\Helper\Data $dataHelper,
        \Field\BaseWidget\Helper\Widget $widgetHelper,
        //\Magento\Store\Model\StoreManagerInterface $storeManager,
        //\Magento\Framework\View\LayoutInterface $layout,
        \Magento\Framework\Registry $registry,
        \Magento\Backend\Helper\Data $backendData,
        array $data = []
        ){

        $this->_factoryElement = $factoryElement;
        $this->_factoryCollection = $factoryCollection;
        //$this->_layout = $layout;
        $this->_backendData = $backendData;
        $this->_dataHelper = $dataHelper;
        //$this->_storeManager = $storeManager;
        $this->_coreRegistry = $registry;
        $this->_widgetHelper = $widgetHelper;
        parent::__construct($context, $data);
    }

    public function getStoreManager() {
        return $this->_storeManager;
    }
    public function getBaseMediaUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

    public function getBaseSecureMediaUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA,['_secure' => true]);
    }

    public function getCurrentModuleUrl() {
        $base_url = $this->getStoreManager()->getStore()->getBaseUrl();
        $base_dir = $this->getWidgetHelper()->getRootDirPath();
        $base_dir = str_replace(DIRECTORY_SEPARATOR, "/", $base_dir);
        $module_view_path = $this->getWidgetHelper()->getViewDirPath();
        $module_view_path = str_replace($base_dir, "", $module_view_path);

        return "{$base_url}{$module_view_path}";
    }

    public function getWidgetHelper( ) {
      return $this->_widgetHelper;
    }
    public function getConnectorUrl($params = []) {
        return $this->getUrl(
            'fieldbasewidget/basewidget/connector',
            $params
        );
    }

    public function getWidgetFormUrl($target_id = "") {
      $params = array();
      if($target_id) {
          $params['widget_target_id'] = $target_id;
      }
      return $this->getUrl(
            'admin/widget/loadOptions',
            $params
        );
    }

    public function getListWidgetsUrl($target_id = "") {
      $params = array();
      if($target_id) {
          $params['widget_target_id'] = $target_id;
      }
      return $this->getUrl(
            'admin/widget/index',
            $params
        );
    }

    public function getWidgetDataUrl($params = []) {
      return $this->getUrl(
            'fieldbasewidget/basewidget/widgetdata',
            $params
        );
    }

    public function getImageUrl($secure = false) {
        if($secure) {
            return $this->getBaseSecureMediaUrl();
        } else {
            return $this->getBaseMediaUrl();
        }
        
    }
    public function getBlockData()
    {
        return $this->_coreRegistry->registry('field_pagebuilder');
    }

    public function isPageBuilder() {
       $is_pagebuilder = $this->_coreRegistry->registry('is_pagebuilder');
       $is_blockbuilder = $this->_coreRegistry->registry('is_blockbuilder');
       return ($is_pagebuilder || $is_blockbuilder)?true:false;
    }

}