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
 * @package    Field_Blog
 * @copyright  Copyright (c) 2014 Fieldthemes (http://www.fieldthemes.com/)
 * @license    http://www.fieldthemes.com/LICENSE-1.0.html
 */
namespace Field\Blog\Block\Post\Comment;

class RssLink extends \Magento\Framework\View\Element\Template
{
	/**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $registry = null;

    /**
     * @var \Magento\Framework\App\Rss\UrlBuilderInterface
     */
    protected $rssUrlBuilder;

    /**
     * @var \Field\Blog\Helper\Data
     */
    protected $_bloghelper;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\App\Rss\UrlBuilderInterface $rssUrlBuilder
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Rss\UrlBuilderInterface $rssUrlBuilder,
        \Magento\Framework\Registry $registry,
        \Field\Blog\Helper\Data $blogHelper,
        array $data = []
    ) {
        $this->registry = $registry;
        $this->rssUrlBuilder = $rssUrlBuilder;
        $this->_bloghelper = $blogHelper;
        parent::__construct($context, $data);
    }

    public function _toHtml(){
        if(!$this->_bloghelper->getConfig("general_settings/commentrss")) return;
        return parent::_toHtml();
    }

    /**
     * @return string
     */
    public function isRssAllowed()
    {
        return true;
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getLabel()
    {
        return __('Subscribe to RSS Feed');
    }

    /**
     * @return string
     */
    protected function getLinkParams()
    {
        return [
            'type' => 'post_comment',
            'key' => $this->registry->registry('current_post')->getPostId()
        ];
    }  

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->getUrl("rss/feed/index",$this->getLinkParams());
    }
}