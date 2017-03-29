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
 * @package    Field_Baseconnector
 * @copyright  Copyright (c) 2014 Fieldthemes (http://www.fieldthemes.com/)
 * @license    http://www.fieldthemes.com/LICENSE-1.0.html
 */
namespace Field\BaseWidget\Controller\Adminhtml\Basewidget;
use Magento\Framework\App\Filesystem\DirectoryList;

class Imagemanager extends \Field\BaseWidget\Controller\Adminhtml\Basewidget {

    /**
     * index action
     */ 
    public function execute() {
        $resultPage = $this->resultPageFactory->create();

        /**
         * Set active menu item
         */
        $resultPage->setActiveMenu("Field_BaseWidget::basewidget");
        $resultPage->getConfig()->getTitle()->prepend(__('Images Manager - Field Base Widget'));

        /**
         * Add breadcrumb item
         */
        $resultPage->addBreadcrumb(__('Field Base Widget'),__('Field Base Widget'));
        $resultPage->addBreadcrumb(__('Images Manager'),__('Images Manager'));

        return $resultPage;
    }
    /**
     * Check the permission to run it
     *
     * @return boolean
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Field_BaseWidget::manage_media');
    }
    
}
?>