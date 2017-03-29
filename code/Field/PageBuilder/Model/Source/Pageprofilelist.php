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
 * @package    Field_PageBuilder
 * @copyright  Copyright (c) 2016 Fieldthemes (http://www.fieldthemes.com/)
 * @license    http://www.fieldthemes.com/LICENSE-1.0.html
 */
namespace Field\PageBuilder\Model\Source;

class Pageprofilelist implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var \Field\PageBuilder\Model\Block
     */
    protected  $_block_model;
    
    /**
     * 
     * @param \Field\PageBuilder\Model\Block $group
     */
    public function __construct(
        \Field\PageBuilder\Model\Block $block_model
        ) {
        $this->_block_model = $block_model;
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {	
        $blocks = $this->_block_model->getCollection()
        				->addFieldToFilter('status', '1')
        				->addFieldToFilter("block_type", "page");

        $blocksList = array();

        $blocksList = [
        				["value"=>"0", "label"=> __("-- Select A Profile --")]
        			  ];

        foreach ($blocks as $block) {
            $blocksList[] = array('label' => $block->getTitle(),
                'value' => $block->getId());
        }
        return $blocksList;
    }
}
