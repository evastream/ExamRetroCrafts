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

class Targets extends \Magento\Framework\View\Element\Html\Select
{
    /**
     * @var \Field\Themesettings\Model\System\Config\Source\Header\LinkTarget
     */
	protected $_target;

    /**
     * @param \Magento\Framework\View\Element\Context                         $context 
     * @param \Field\Themesettings\Model\System\Config\Source\Header\LinkTarget $target  
     * @param array                                                           $data    
     */
	public function __construct(
        \Magento\Framework\View\Element\Context $context,
        \Field\Themesettings\Model\System\Config\Source\Header\LinkTarget $target,
        array $data = []
    ) {
    	parent::__construct($context, $data);
    	$this->_target = $target;
	}

     /**
     * @param string $value
     * @return $this
     */
    public function setInputName($value)
    {
        return $this->setName($value);
    }

	/**
     * Render block HTML
     *
     * @return string
     */
    public function _toHtml()
    {
        if (!$this->getOptions()) {
            foreach ($this->_target->toOptionArray() as $_type) {
                $this->addOption($_type['label'], addslashes($_type['value']));
            }
        }
        return parent::_toHtml();
    }

}