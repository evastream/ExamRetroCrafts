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
namespace Field\Themesettings\Model\System\Config\Source\General;

class Skins implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_request;
    
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * Scope config
     *
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * @var \Magento\Theme\Model\Theme
     */
    protected $_themeModel;

    /**
     * @var \Magento\Framework\View\Design\Theme\Customization\Path
     */
    protected $_path;

    /**
     * @param \Magento\Cms\Model\Block $blockModel
     */

    public function __construct(
        \Field\Themesettings\Helper\Data $fieldHelper,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Theme\Model\Theme $themeModel,
        \Magento\Framework\View\Design\Theme\Customization\Path $path
        ) {
        $this->_request = $request;
        $this->_storeManager = $storeManager;
        $this->_scopeConfig = $scopeConfig;
        $this->_themeModel = $themeModel;
        $this->_path = $path;
        $this->_fieldHelper = $fieldHelper;
    }

    public function toOptionArray()
    {
        $output = [];
        $theme = '';
        $storeId = $this->_request->getParam('store');
        $websiteId = $this->_request->getParam('website');
        $website = $this->_storeManager->getWebsite($websiteId);
        if(!$storeId && $website){
            $storeId = $website->getDefaultStore()->getId();
        }
        $store = $this->_storeManager->getStore($storeId);
        $themeId =  $this->_scopeConfig->getValue(
            \Magento\Framework\View\DesignInterface::XML_PATH_THEME_ID,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store);
        if(!empty($this->_fieldHelper->getFieldTheme($storeId))){
            $theme = $this->_themeModel->load($themeId);
            $themePath = $this->_path->getThemeFilesPath($theme);
            $skinDir = $themePath.'/Field_Themesettings/web/css/skins/';

            $skins = glob($skinDir . '*.css');
            $output[] = [
                'label' => __('Default'),
                'value' => ''
            ];
            $replaceLabelPattern = [$skinDir => '','.css'=>''];
            $replaceValuePattern = [$skinDir => ''];
            foreach ($skins as $k => $v) {
                $output[] = [
                'label' => ucfirst(str_replace(array_keys($replaceLabelPattern),array_values($replaceLabelPattern),$v)),
                'value' => str_replace(array_keys($replaceValuePattern),array_values($replaceValuePattern),$v)
                ];
            }
        }
        return $output;
    }
}