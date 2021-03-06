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
namespace Field\PageBuilder\Controller\Adminhtml\Pagebuilder;

use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;
    
    /**
     * @var \Magento\Framework\Filesystem
     */
    protected $_fileSystem;

    /**
     * @var \Field\PageBuilder\Helper\Data
     */
    protected $_viewHelper;

    /**
     * @var PostDataProcessor
     */
    protected $dataProcessor;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param \Magento\Framework\Filesystem $filesystem
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context, 
        PostDataProcessor $dataProcessor,
        /*\Magento\Framework\ObjectManagerInterface $objectManager,*/
        \Field\PageBuilder\Helper\Data $dataHelper,
        \Magento\Framework\Filesystem $filesystem
        ) {
        //$this->_objectManager = $objectManager;
        $this->_fileSystem = $filesystem;
        $this->_viewHelper = $dataHelper;
        $this->dataProcessor = $dataProcessor;
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Field_PageBuilder::page_save');
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $post_data = $this->getRequest()->getPostValue();

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($post_data) {
            //Duplicate Block Builder Profile
            if ($this->getRequest()->getParam("duplicate")) {
                $model_from = $this->_objectManager->create('Field\PageBuilder\Model\Block');
                $model = $this->_objectManager->create('Field\PageBuilder\Model\Block');

                $id = $this->getRequest()->getParam('block_id');
                if ($id) {
                    $model_from->load($id);
                }
                
                $block_id = 0;
                $block_data = ['shortcode' => $model_from->getShortcode(),
                                 'params' => $model_from->getParams(),
                                 'layout_html' => $model_from->getLayoutHtml(),
                                 'page_layout' => $model_from->getPageLayout(),
                                 'layout_update_xml' => $model_from->getLayoutUpdateXml(),
                                 'title' => $model_from->getTitle()."-clone",
                                 'alias' => $model_from->getAlias()."-clone",
                                 'status' => $model_from->getStatus(),
                                 'block_type' => $model_from->getBlockType(),
                                 'container' => $model_from->getContainer(),
                                 'prefix_class' => $model_from->getPrefixClass(),
                                 'show_from' => $model_from->getShowFrom(),
                                 'show_to' => $model_from->getShowTo(),
                                 'settings' => $model_from->getSettings(),
                                 'customer_group' => $model_from->getCustomerGroup(),
                                 'created' => date( 'Y-m-d H:i:s' ),
                                 'position' => $model_from->getPosition()
                                ];

                $settings['template'] = isset($post_data['template'])?$post_data['template']:'';
                $settings['code'] = isset($block_data['alias'])?$block_data['alias']:'';
                $block_data['shortcode'] = $this->_viewHelper->getShortCode("Field\PageBuilder\Block\Widget\Page", $block_id, $settings);
                                
                $model->setData($block_data);

                $post_data = array_merge($post_data, $block_data);

            } else {
                $model = $this->_objectManager->create('Field\PageBuilder\Model\Block');

                $id = $this->getRequest()->getParam('block_id');
                if ($id) {
                    $model->load($id);
                }

                $settings = array();
                $post_data['settings'] = array();
                $post_data['settings']['custom_css'] = isset($post_data['custom_css'])?$post_data['custom_css']:'';
                $post_data['settings']['custom_js'] = isset($post_data['custom_js'])?$post_data['custom_js']:'';
                $post_data['settings']['enable_wrapper'] = isset($post_data['enable_wrapper'])?$post_data['enable_wrapper']:'2';
                $post_data['settings']['wrapper_class'] = isset($post_data['wrapper_class'])?$post_data['wrapper_class']:'';
                $post_data['settings']['select_wrapper_class'] = isset($post_data['select_wrapper_class'])?$post_data['select_wrapper_class']:'';
                $post_data['settings']['template'] = isset($post_data['template'])?$post_data['template']:'';

                $post_data['customer_group'] = isset($post_data['customer_group'])?$post_data['customer_group']:[];
                $post_data['settings'] = serialize($post_data['settings']);
                $post_data['block_type'] = isset($post_data['block_type'])?$post_data['block_type']:'page';
                $post_data['container'] = isset($post_data['container'])?$post_data['container']:'1';
                $post_data['customer_group'] = implode(',', $post_data['customer_group']);
                $post_data['params'] = str_replace(array("<p>","</p>"), "", $post_data['params'] );
                $post_data['params'] = trim($post_data['params']);
                
                $settings['template'] = isset($post_data['template'])?$post_data['template']:'';
                $settings['code'] = isset($post_data['alias'])?$post_data['alias']:'';
                $post_data['shortcode'] = $this->_viewHelper->getShortCode("Field\PageBuilder\Block\Widget\Page", $this->getRequest()->getParam("block_id"), $settings);


                if($this->getRequest()->getParam("block_id")) {
                    $post_data['modified'] = date( 'Y-m-d H:i:s' );
                } else {
                    $post_data['created'] = date( 'Y-m-d H:i:s' );
                }

                $model->setData($post_data);
            }

            try {
                $model->save();

                //If auto backup profile was enabled, then auto save current page builder profile to var/fieldpagebuilder/ folder
                if($this->_viewHelper->getConfig('general/auto_backup_profile')) {

                    $this->_viewHelper->autoBackupLayoutProfile( $post_data, "fieldpagebuilder" );
                }

                if ($this->getRequest()->getParam("duplicate")) {
                    $this->messageManager->addSuccess(__('Profile was successfully duplicated.'));
                } else {
                    $this->messageManager->addSuccess(__('You saved this page builder profile.'));
                }

                // Start Create Or Updated CMS Page
                $data = array();
                $page = $model->loadCMSPage($post_data['alias'], "identifier", $post_data['stores']);


                $data['page_id'] = $page->getPageId();
                $data['title'] = $post_data['title'];
                $data['identifier'] = $post_data['alias'];
                $data['is_active'] = $post_data['status'];
                $data['stores'] = $post_data['stores'];
                if(isset($post_data['content_heading'])) {
                    $data['content_heading'] = "";
                }
                $shortcode = $model->getShortcode();
                $shortcode = str_replace(array("<p>","</p>"), "", $shortcode);
                $data['content'] = $shortcode;
                $data['page_layout'] = $post_data['page_layout'];
                $data['layout_update_xml'] = $post_data['layout_update_xml'];
                $data['meta_keywords'] = $post_data['meta_keywords'];
                $data['meta_description'] = $post_data['meta_description'];
                if(isset($post_data['custom_theme_from'])) {
                    $data['custom_theme_from'] = $post_data['custom_theme_from'];
                }
                if(isset($post_data['custom_theme_to'])) {
                    $data['custom_theme_to'] = $post_data['custom_theme_to'];
                }
                if(isset($post_data['custom_theme'])) {
                    $data['custom_theme'] = $post_data['custom_theme'];
                }
                if(isset($post_data['custom_root_template'])) {
                    $data['custom_root_template'] = $post_data['custom_root_template'];
                }
                if(isset($post_data['custom_layout_update_xml'])) {
                    $data['custom_layout_update_xml'] = $post_data['custom_layout_update_xml'];
                }

                $data = $this->dataProcessor->filter($data);

                //init model and set data
                $page_model = $this->_objectManager->create('Magento\Cms\Model\Page');
                if ($id = $data['page_id']) {
                    $page_model->load($id);
                }

                $page_model->setData($data);

                $this->_eventManager->dispatch(
                    'cms_page_prepare_save',
                    ['page' => $page_model, 'request' => $this->getRequest()]
                );

                if (!$this->dataProcessor->validate($data)) {
                    return $resultRedirect->setPath('*/*/edit', ['block_id' => $model->getId(), '_current' => true]);
                }

                try {
                    $page_model->save();
                    $this->messageManager->addSuccess(__('You saved this page.'));
                    $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);

                } catch (\Magento\Framework\Exception\LocalizedException $e) {
                    $this->messageManager->addError($e->getMessage());
                } catch (\RuntimeException $e) {
                    $this->messageManager->addError($e->getMessage());
                } catch (\Exception $e) {
                    $this->messageManager->addException($e, __('Something went wrong while saving the page.'));
                }

                //End Create Or Updated CMS Page
                
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['block_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the page builder profile.'));
            }
            $this->_getSession()->setFormData($post_data);
            return $resultRedirect->setPath('*/*/edit', ['block_id' => $this->getRequest()->getParam('block_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

}