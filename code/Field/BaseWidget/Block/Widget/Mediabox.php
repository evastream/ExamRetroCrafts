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
 * @package    Field_BaseWidget
 * @copyright  Copyright (c) 2014 Fieldthemes (http://www.fieldthemes.com/)
 * @license    http://www.fieldthemes.com/LICENSE-1.0.html
 */
namespace Field\BaseWidget\Block\Widget;
use Field\BaseWidget\Block\AbstractWidget;

class Mediabox extends AbstractWidget
{
    protected $_blockModel;
    protected $_dataFilterHelper;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Cms\Model\Block $blockModel,
        \Field\BaseWidget\Helper\Data $dataHelper,
        array $data = []
        ) {
        parent::__construct($context, $blockModel, $dataHelper, $data);
        $this->_blockModel = $blockModel;
        $this->_dataFilterHelper = $dataHelper;
    }

    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $editor = new Varien_Data_Form_Element_Editor($element->getData());

        // Prevent foreach error
        $editor->getConfig()->setPlugins(array());

        $editor->setId($element->getId());
        $editor->setForm($element->getForm());
        $editor->setValue(base64_decode($editor->getValue()));

        return parent::render($editor);
    }
}