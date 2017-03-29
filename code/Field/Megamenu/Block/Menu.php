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
namespace Field\Megamenu\Block;

class Menu extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Field\Megamenu\Helper\Data
     */
    protected $_helper;

    /**
     * @var \Field\Megamenu\Model\Menu
     */
    protected $_menu;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context      
     * @param \Field\Megamenu\Helper\Data                        $helper       
     * @param \Field\Megamenu\Model\Menu                         $menu         
     * @param array                                            $data         
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Field\Megamenu\Helper\Data $helper,
        \Field\Megamenu\Model\Menu $menu,
        array $data = []
        ) {
        parent::__construct($context, $data);
        $this->_helper = $helper;
        $this->_menu = $menu;

    }

    public function _toHtml(){
        if(!$this->getTemplate()){
            $this->setTemplate("Field_Megamenu::widget/menu.phtml");
        }
        $html = $menu = '';
        if ($menuId = $this->getData('id')) {
            $menu = $this->_menu->load((int)$menuId);
        }elseif($menuId = $this->getData('alias')){
            $storeId = $this->_storeManager->getStore()->getId();
            $menu = $this->_menu->setStore($storeId)->load($menuId);
        }
        if($menu && $menu->getStatus()){
            $this->setData("menu", $menu);
        }
        return parent::_toHtml();
    }
}