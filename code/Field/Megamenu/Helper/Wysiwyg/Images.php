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
 * @package    Field_Megamenu
 * @copyright  Copyright (c) 2014 Fieldthemes (http://www.fieldthemes.com/)
 * @license    http://www.fieldthemes.com/LICENSE-1.0.html
 */
namespace Field\Megamenu\Helper\Wysiwyg;
use Magento\Framework\App\Filesystem\DirectoryList;

class Images extends \Magento\Cms\Helper\Wysiwyg\Images
{
	public function getImageHtmlDeclaration($filename, $renderAsTag = false)
	{
		if($renderAsTag == 'fieldthemes'){
			$fileurl = $this->getCurrentUrl() . $filename;
			$mediaUrl = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
			$mediaPath = str_replace($mediaUrl, '', $fileurl);
			return $fileurl;
		}else{
			return parent::getImageHtmlDeclaration($filename, $renderAsTag);
		}
	}

}