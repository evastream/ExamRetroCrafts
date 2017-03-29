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
namespace Field\Themesettings\Model\System\Config\Source\Header;

class LanguageSwitcher implements \Magento\Framework\Option\ArrayInterface
{
	public function toOptionArray()
    {
        $blocks = [];
        $blocks[] = [
	        'value' => 'Magento_Store::switch/languages.phtml',
	        'label' => 'Select Box'];
        $blocks[] = [
	        'value' => 'Magento_Store::switch/flags.phtml',
	        'label' => 'Flags'];
        return $blocks;
    }
}