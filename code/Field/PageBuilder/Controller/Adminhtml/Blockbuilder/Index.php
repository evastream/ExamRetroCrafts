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
 * @package    Field_Brand
 * @copyright  Copyright (c) 2014 Fieldthemes (http://www.fieldthemes.com/)
 * @license    http://www.fieldthemes.com/LICENSE-1.0.html
 */
namespace Field\PageBuilder\Controller\Adminhtml\Blockbuilder;

class Index extends \Field\PageBuilder\Controller\Adminhtml\Blockbuilder
{

	/**
	 * Brand list action
	 *
	 * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Forward
	 */
	public function execute()
	{

		$resultPage = $this->resultPageFactory->create();

		/**
		 * Set active menu item
		 */
		$resultPage->setActiveMenu("Field_PageBuilder::pagebuilder");
		$resultPage->getConfig()->getTitle()->prepend(__('Block Builder'));

		/**
		 * Add breadcrumb item
		 */
		$resultPage->addBreadcrumb(__('Pages Builder'),__('Pages Builder'));
		$resultPage->addBreadcrumb(__('Manage Block Builder Profiles'),__('Manage Block Builder Profiles'));

		return $resultPage;
	}
	
}