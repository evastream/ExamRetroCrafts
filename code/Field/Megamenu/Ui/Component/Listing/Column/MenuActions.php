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
namespace Field\Megamenu\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Field\Megamenu\Block\Adminhtml\Menu\Grid\Renderer\Action\UrlBuilder;
use Magento\Framework\UrlInterface;

/**
 * Class PageActions
 */
class MenuActions extends Column
{
    /** Url path */
    const MENU_URL_PATH_EDIT = 'fieldmegamenu/menu/edit';
    const MENU_URL_PATH_DELETE = 'fieldmegamenu/menu/delete';

    /** @var UrlBuilder */
    protected $actionUrlBuilder;

    /** @var UrlInterface */
    protected $urlBuilder;

    /**
     * @var string
     */
    private $editUrl;

    /**
     * @param ContextInterface   $context            
     * @param UiComponentFactory $uiComponentFactory 
     * @param UrlBuilder         $actionUrlBuilder   
     * @param UrlInterface       $urlBuilder         
     * @param array              $components         
     * @param array              $data               
     * @param [type]             $editUrl            
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlBuilder $actionUrlBuilder,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
        $editUrl = self::MENU_URL_PATH_EDIT
        ) {
        $this->urlBuilder = $urlBuilder;
        $this->actionUrlBuilder = $actionUrlBuilder;
        $this->editUrl = $editUrl;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                if (isset($item['menu_id'])) {
                    $item[$name]['edit'] = [
                    'href' => $this->urlBuilder->getUrl($this->editUrl, ['menu_id' => $item['menu_id']]),
                    'label' => __('Edit')
                    ];
                    /*$item[$name]['delete'] = [
                    'href' => $this->urlBuilder->getUrl(self::MENU_URL_PATH_DELETE, ['menu_id' => $item['menu_id']]),
                    'label' => __('Delete'),
                    'confirm' => [
                    'title' => __('Delete ${ $.$data.title }'),
                    'message' => __('Are you sure you wan\'t to delete a ${ $.$data.title } record?')
                    ]
                    ];*/
                }
            }
        }

        return $dataSource;
    }
}
