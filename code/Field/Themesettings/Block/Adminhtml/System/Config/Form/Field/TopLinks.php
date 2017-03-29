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
namespace Field\Themesettings\Block\Adminhtml\System\Config\Form\Field;

class TopLinks extends \Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray
{
    /**
     * @var Customergroup
     */
    protected $_targets;

    protected function _getTargetTypeRenderer(){
        if (!$this->_targets) {
            $this->_targets = $this->getLayout()->createBlock(
                'Field\Themesettings\Block\Adminhtml\System\Config\Form\Field\Targets',
                '',
                ['data' => ['is_render_to_js_template' => true]]
                );
            $this->_targets->setClass('targets');
        }
        return $this->_targets;
    }

     /**
     * Prepare existing row data object
     *
     * @param \Magento\Framework\DataObject $row
     * @return void
     */
     protected function _prepareArrayRow(\Magento\Framework\DataObject $row)
     {
        $optionExtraAttr = [];
        $optionExtraAttr['option_' . $this->_getTargetTypeRenderer()->calcOptionHash($row->getData('target'))] =
        'selected="selected"';
        $row->setData(
            'option_extra_attrs',
            $optionExtraAttr
            );
    }

    /**
     * Prepare to render
     *
     * @return void
     */
    protected function _prepareToRender()
    {
        $this->addColumn('title', ['label' => __('Title')]);
        $this->addColumn('link', ['label' => __('Link')]);
        $this->addColumn('target', [
            'label' => __('Target'),
            'renderer' => $this->_getTargetTypeRenderer()
            ]);
        $this->addColumn('classes', ['label' => __('Class')]);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }

    /**
     * Retrieve HTML markup for given form element
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {

        $isCheckboxRequired = $this->_isInheritCheckboxRequired($element);

        // Disable element if value is inherited from other scope. Flag has to be set before the value is rendered.
        if ($element->getInherit() == 1 && $isCheckboxRequired) {
            $element->setDisabled(true);
        }

        $html = '';
        $value = $element->getValue();
        if(isset($value['__empty'])){
            unset($value['__empty']);
            $element->setValue($value);
        }
        $html .= $this->_renderValue($element);

        if ($isCheckboxRequired) {
            $html .= $this->_renderInheritCheckbox($element);
        }

        $html .= '<span' .$this->_renderScopeLabel($element) . '></span>';
        $html .= $this->_renderHint($element);

        return $this->_decorateRowHtml($element, $html);
    }

    /**
     * Render element value
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    protected function _renderValue(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        if ($element->getTooltip()) {
            $html = '<td class="value with-tooltip">';
            $html .= $this->_getElementHtml($element);
            $html .= '<div class="tooltip"><span class="help"><span></span></span>';
            $html .= '<div class="tooltip-content">' . $element->getTooltip() . '</div></div>';
        } else {
            $html = '<td class="value" style="width:100%" colspan="2">';
            $html .= '<div style="color: #303030;float: none;font-size: 14px;padding-bottom: 10px;font-weight: 600;">'.$element->getLabel().'</div>';
            $html .= $this->_getElementHtml($element);
        }
        if ($element->getComment()) {
            $html .= '<p class="note"><span>' . $element->getComment() . '</span></p>';
        }
        $html .= '</td>';
        return $html;
    }
}
