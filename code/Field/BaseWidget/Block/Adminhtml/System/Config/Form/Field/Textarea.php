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
 * @package    Field_ImageSlider
 * @copyright  Copyright (c) 2014 Fieldthemes (http://www.fieldthemes.com/)
 * @license    http://www.fieldthemes.com/LICENSE-1.0.html
 */
namespace Field\BaseWidget\Block\Adminhtml\System\Config\Form\Field;
use Magento\Backend\Block\Template;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Data\Form\Element\Renderer\RendererInterface;
use Magento\Framework\Escaper;

class Textarea extends Template implements RendererInterface
{

    /**
     * @var \Magento\Framework\Data\Form\Element\CollectionFactory
     */
    protected $_factoryCollection;

    /**
     * @var \Magento\Framework\Data\Form\Element\Factory
     */
    protected $_factoryElement;

    /**
     * @var \Magento\Framework\Escaper
     */
    protected $_escaper;

    /**
     * @var \Magento\Framework\View\LayoutInterface
     */
    protected $_layout;

    /**
     * Adminhtml data
     *
     * @var \Magento\Backend\Helper\Data
     */
    protected $_backendData = null;

    /**
     * Default number of rows
     */
    const DEFAULT_ROWS = 2;

    /**
     * Default number of columns
     */
    const DEFAULT_COLS = 15;

    /**
     * @param \Magento\Backend\Block\Template\Context                $context           
     * @param \Magento\Framework\Data\Form\Element\Factory           $factoryElement    
     * @param \Magento\Framework\Data\Form\Element\CollectionFactory $factoryCollection 
     * @param Escaper                                                $escaper
     * @param \Magento\Framework\View\LayoutInterface                $layout            
     * @param \Magento\Backend\Helper\Data                           $backendData       
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Data\Form\Element\Factory $factoryElement,
        \Magento\Framework\Data\Form\Element\CollectionFactory $factoryCollection,
        /*Escaper $escaper,*/
        /*\Magento\Framework\View\LayoutInterface $layout,*/
        \Magento\Backend\Helper\Data $backendData
        ){
        $this->_factoryElement = $factoryElement;
        $this->_factoryCollection = $factoryCollection;
        /*$this->_escaper = $escaper;
        $this->_layout = $layout;*/
        $this->_backendData = $backendData;
        parent::__construct($context);
    }

    public function isBase64Encoded($data) {
        if(base64_encode(base64_decode($data)) === $data){
            return true;
        }
        return false;
    }
    /**
     * Retrieve HTML markup for given form element
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    public function render(AbstractElement $element)
    {
        $html = '';

        $description = $element->getNote();
        $value = $element->getValue();
        if(!is_array($value)){
            $value = str_replace(" ","+", $value);
            if($this->isBase64Encoded($value)){
                $value = base64_decode($value);
                if($this->isBase64Encoded($value)){
                    $value = base64_decode($value);
                }
            }
        }

        $class = '';
        if($element->getRequired()){
            $class = 'required-entry';
        }

        $html .= '<div class="admin__field field field-options_'.$element->getId().'  with-note">';
        $html .= $element->getLabelHtml();

        $html .= '<div class="admin__field-control control">';
        $html .= '<textarea id="' . $element->getHtmlId() . '" name="' . $element->getName() . '" class="textarea admin__control-textarea ' . $class . '" rows="5" cols="15" data-ui-id="product-tabs-attributes-tab-fieldset-element-textarea-' . $element->getName() . '">'.$value.'</textarea>';

        if($description) {
            $html .= '<div class="note" id="' . $element->getHtmlId() . '-note">'.$description.'</div>';
        }
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

}