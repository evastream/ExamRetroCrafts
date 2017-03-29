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
namespace Field\Themesettings\Observer;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class FieldThemesettingsObserver implements ObserverInterface
{
	protected $_generator;

	public function __construct(\Field\Themesettings\Model\Cssgen\Generator $generator)
	{
		$this->_generator = $generator;
	}
	/**
     * Add coupon's rule name to order data
     *
     * @param EventObserver $observer
     * @return $this
     */
	public function execute(EventObserver $observer)
	{
		$website = $observer->getEvent()->getWebsite();
		$store = $observer->getEvent()->getStore();
		$this->_generator->generateCss($website, $store);
	}
}