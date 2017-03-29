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
namespace Field\Themesettings\Model\Cssgen;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Directory\Helper\Data;

class Generator{

	/**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
	protected $_storeManager;

	/**
     * @var \Magento\Framework\Message\ManagerInterface
     */
	private $messageManager;

	/**
     * @var \Magento\Framework\Registry
     */
	protected $_coreRegistry = null;

	/**
     * @var \Magento\Framework\View\Element\BlockFactory
     */
	protected $_blockFactory;

	/**
	 * @var \Magento\Theme\Model\Theme
	 */
	protected $_themeModel;

	/**
     * Core store config
     *
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
	protected $_scopeConfig;

	/**
     * @var \Field\Themesettings\Helper\Data
     */
	protected $_fieldHelper;

	public function __construct(
		\Magento\Store\Model\StoreManagerInterface $storeManager,
		\Magento\Framework\View\Element\BlockFactory $blockFactory,
		\Magento\Framework\Registry $registry,
		\Magento\Framework\Filesystem $filesystem,
		\Magento\Framework\Message\ManagerInterface $messageManager,
		\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
		\Magento\Theme\Model\Theme $themeModel,
		\Field\Themesettings\Helper\Data $fieldHelper
		)
	{
		$this->_storeManager = $storeManager;
		$this->_blockFactory = $blockFactory;
		$this->_coreRegistry = $registry;
		$this->_filesystem = $filesystem;
		$this->messageManager = $messageManager;
		$this->_themeModel = $themeModel;
		$this->_fieldHelper = $fieldHelper;
		$this->_scopeConfig = $scopeConfig;
	}

	public function generateCss($websiteCode, $storeCode){
		if($websiteCode){
			$website = $this->_storeManager->getWebsite($websiteCode);
			$this->_generateWebsiteCss($website);
		}
		if($storeCode){
			$this->_generateStoreCss($storeCode);
		}
		if(!$websiteCode && !$storeCode){
			$websites = $this->_storeManager->getWebsites();
			foreach ($websites as $website) {
				$this->_generateWebsiteCss($website); 
			}
		}
	}

	protected function _generateWebsiteCss($website){
		foreach ($website->getStoreCodes() as $storeCode){
			$this->_generateStoreCss($storeCode);
		}
	}

	protected function _generateStoreCss($storeCode){
		$store = $this->_storeManager->getStore($storeCode);
		$storeId = $store->getId();

		if(!empty($this->_fieldHelper->getFieldTheme($storeId))){
			$this->_coreRegistry->register('field_store', $store);
			$cssBlockHtml = $this->_blockFactory->createBlock('Field\Themesettings\Block\ThemesettingsDesign')->setTemplate("Field_Themesettings::themesettings_styles.phtml")->toHtml();
			$cssBlockHtml = $this->_compressCssCode($cssBlockHtml);

			$themeId =  $this->_scopeConfig->getValue(
				\Magento\Framework\View\DesignInterface::XML_PATH_THEME_ID,
				\Magento\Store\Model\ScopeInterface::SCOPE_STORE,
				$store);
			$theme = $this->_themeModel->load($themeId);
			try{
				if (empty($cssBlockHtml)) {
					throw new Exception( __("The system has an issue when create css file") ); 
				}
				$localeCode = $this->_scopeConfig->getValue(
					Data::XML_PATH_DEFAULT_LOCALE,
					\Magento\Store\Model\ScopeInterface::SCOPE_STORE,
					$store
					);

				// pub/static/frontend
				$dir = $this->_filesystem->getDirectoryWrite(DirectoryList::STATIC_VIEW);
				$fileName = $theme->getFullPath() . DIRECTORY_SEPARATOR . $localeCode . DIRECTORY_SEPARATOR . 'Field_Themesettings/css/style-'.$store->getCode().'.css';
				$dir->writeFile($fileName, $cssBlockHtml);
				$this->messageManager->addSuccess(__('The %1 file updated successfully.', $dir->getAbsolutePath($fileName)));

				// app/design/frontend
				$themeDir = $this->_filesystem->getDirectoryWrite(DirectoryList::APP);
				$fileName = 'design' . DIRECTORY_SEPARATOR . $theme->getFullPath() . DIRECTORY_SEPARATOR . 'Field_Themesettings/web/css/style-'.$store->getCode().'.css';
				$themeDir->writeFile($fileName, $cssBlockHtml);

			}catch (\Exception $e){
				$this->messageManager->addError(__('The system has an issue when create css file'). '<br/>Message: ' . $e->getMessage());
			}
			$this->_coreRegistry->unregister('field_store');
		}
	}

	private function _compressCssCode( $input_text = "") {
        $output = str_replace(array("\r\n", "\r"), "\n", $input_text);
        $lines = explode("\n", $input_text);
        $new_lines = array();

        foreach ($lines as $i => $line) {
            if(!empty($line))
                $new_lines[] = trim($line);
        }
        return implode($new_lines);
    }
}