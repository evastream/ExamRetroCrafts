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
namespace Field\BaseWidget\Model\Source;
class ListRuleGroup implements \Magento\Framework\Option\ArrayInterface
{
    protected  $_groupModel;

    /**
     * @param \Magento\Cms\Model\Block $ruleModel
     */
    public function __construct(
        \Magento\SalesRule\Model\Rule $ruleModel
        ) {
        $this->_groupModel = $ruleModel;
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $collection = $this->_groupModel->getCollection();
        $blocks = array();
        $blocks[] = ['value' => '',
                    'label' => __("--Select a Cart Price Rule--")];

        foreach ($collection as $_block) {
            $blocks[] = [
                'value' => $_block->getId(),
                'label' => $_block->getName()
            ];
        }
        return $blocks;
    }
}