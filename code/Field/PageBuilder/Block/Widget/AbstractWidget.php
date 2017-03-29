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
namespace Field\PageBuilder\Block\Widget;

class AbstractWidget extends \Magento\Framework\View\Element\Template implements \Magento\Widget\Block\BlockInterface
{
	/**
	 * @var \Field\PageBuilder\Helper\Data
	 */
	protected $_blockHelper;
    /**
     * @var \Field\PageBuilder\Helper\MobileDetect
     */
    protected $_mobileDetect;

	/**
     * @param \Magento\Framework\View\Element\Template\Context $context     
     * @param \Field\PageBuilder\Helper\Data                    $_blockHelper 
     * @param array                                            $data        
     */
	public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Field\PageBuilder\Helper\Data $blockHelper,
        \Field\PageBuilder\Helper\MobileDetect $mobileDetectHelper,
        array $data = []
        ) {
        $this->_blockHelper = $blockHelper;
        $this->_mobileDetect = $mobileDetectHelper;

        parent::__construct($context, $data);

        $block_type = $this->getConfig("block_type", "block");
        
        $my_template = "";

        if($this->hasData("template")) {
            $my_template = $this->getData("template");
        }elseif($block_type == "page") {
            $my_template = "pagebuilder/default.phtml";
        } elseif($block_type == "block") {
            $my_template = "blockbuilder/default.phtml";
        }
        if($my_template) {
            $this->setTemplate($my_template);
        }
        
    }

    public function getDataFilter() {
        return $this->_blockHelper;
    }

    public function getMobileDetect() {
        return $this->_mobileDetect;
    }

    public function detectDeviceToShow($widget = array()){
        $display = true;
        $show_on_desktop = isset($widget['desktop'])?$widget['desktop']: true;
        $show_on_tablet = isset($widget['tablet'])?$widget['tablet']: true;
        $show_on_mobile = isset($widget['mobile'])?$widget['mobile']: true;

        if($this->getMobileDetect()->isMobile() && !$this->getMobileDetect()->isTablet()) { //If current are mobile devices
            if(!$show_on_mobile) {
                $display = false;
            }
        } elseif($this->getMobileDetect()->isTablet()) { //If current are mobile devices
            if(!$show_on_tablet) {
                $display = false;
            }
        } elseif(!$show_on_desktop) {
            $display = false;
        }

        return $display;
    }

    public function getConfig($key, $default = '')
    {
        if($this->hasData($key))
        {
            return $this->getData($key);
        }
        return $default;
    }

    public function getRowStyle($row = array()) {
        $custom_css = array();
        
        if(isset($row['bgcolor']) && $row['bgcolor']) {
            $custom_css[] = 'background-color:'.$row['bgcolor'];
        }
        if(isset($row['bgimage']) && $row['bgimage']) {
            $row['bgimage'] = $this->getImageUrl( $row['bgimage'] );
            $custom_css[] = ($row['bgimage'])?'background-image:url('.$row['bgimage'].')':'';
        }
        if(isset($row['bgrepeat']) && $row['bgrepeat']) {
            $custom_css[] = 'background-repeat:'.$row['bgrepeat'];
        }
        if(isset($row['bgposition']) && $row['bgposition']) {
            $custom_css[] = 'background-position:'.$row['bgposition'];
        }
        if(isset($row['bgattachment']) && $row['bgattachment']) {
            $custom_css[] = 'background-attachment:'.$row['bgattachment'];
        }
        if(isset($row['padding']) && $row['padding']) {
            $custom_css[] = 'padding:'.$row['padding'];
        }
        if(isset($row['margin']) && $row['margin']) {
            $custom_css[] = 'margin:'.$row['margin'];
        }

        return $custom_css;
    }

    public function getRowInnerStyle($row = array()) {
        $custom_css = array();
        
        if(isset($row['inbgcolor']) && $row['inbgcolor']) {
            $custom_css[] = 'background-color:'.$row['inbgcolor'];
        }
        if(isset($row['inbgimage']) && $row['inbgimage']) {
            $row['inbgimage'] = $this->getImageUrl( $row['inbgimage'] );
            $custom_css[] = ($row['inbgimage'])?'background-image:url('.$row['inbgimage'].')':'';
        }
        if(isset($row['inbgrepeat']) && $row['inbgrepeat']) {
            $custom_css[] = 'background-repeat:'.$row['inbgrepeat'];
        }
        if(isset($row['inbgposition']) && $row['inbgposition']) {
            $custom_css[] = 'background-position:'.$row['inbgposition'];
        }
        if(isset($row['inbgattachment']) && $row['inbgattachment']) {
            $custom_css[] = 'background-attachment:'.$row['inbgattachment'];
        }

        return $custom_css;
    }

    public function getColStyle($col = array()) {
        $custom_col_css = array();

        if(isset($col['bgcolor']) && $col['bgcolor']) {
            $custom_col_css[] = 'background-color:'.$col['bgcolor'];
        }
        if(isset($col['bgimage']) && $col['bgimage']) {
            $col['bgimage'] = $this->getImageUrl( $col['bgimage'] );
            $custom_col_css[]= $col['bgimage']?'background-image:url('.$col['bgimage'].')':'';
        }
        if(isset($col['bgrepeat']) && $col['bgrepeat']) {
            $custom_col_css[] = 'background-repeat:'.$col['bgrepeat'];
        }
        if(isset($col['bgposition']) && $col['bgposition']) {
            $custom_col_css[] = 'background-position:'.$col['bgposition'];
        }
        if(isset($col['bgattachment']) && $col['bgattachment']) {
            $custom_col_css[] = 'background-attachment:'.$col['bgattachment'];
        }
        if(isset($col['padding']) && $col['padding']) {
            $custom_col_css[] = 'padding:'.$col['padding'];
        }
        if(isset($col['margin']) && $col['margin']) {
            $custom_col_css[] = 'margin:'.$col['margin'];
        }

        return $custom_col_css;
    }

    public function getWidgetStyle($col = array()) {
        $custom_widget_css = array();

        if(isset($col['bgcolor']) && $col['bgcolor']) {
            $custom_widget_css[] = 'background-color:'.$col['bgcolor'];
        }
        if(isset($col['bgimage']) && $col['bgimage']) {
            $col['bgimage'] = $this->getImageUrl( $col['bgimage'] );
            $custom_widget_css[]= $col['bgimage']?'background-image:url('.$col['bgimage'].')':'';
        }
        if(isset($col['bgrepeat']) && $col['bgrepeat']) {
            $custom_widget_css[] = 'background-repeat:'.$col['bgrepeat'];
        }
        if(isset($col['bgposition']) && $col['bgposition']) {
            $custom_widget_css[] = 'background-position:'.$col['bgposition'];
        }
        if(isset($col['bgattachment']) && $col['bgattachment']) {
            $custom_widget_css[] = 'background-attachment:'.$col['bgattachment'];
        }
        if(isset($col['padding']) && $col['padding']) {
            $custom_widget_css[] = 'padding:'.$col['padding'];
        }
        if(isset($col['margin']) && $col['margin']) {
            $custom_widget_css[] = 'margin:'.$col['margin'];
        }
        
        return $custom_widget_css;
    }
}