<?php
class Field_Base_Block_Widget_Twitter extends Mage_Core_Block_Template implements Mage_Widget_Block_Interface{

	/**
	 * Contructor
	 */
	public function __construct($attributes = array())
	{

		$this->setTemplate( "field/base/twitter.phtml" );
		parent::__construct( $attributes );

	}
	protected function _toHtml(){

		$this->assign('id',$this->getConfig('id'));
		$this->assign('title',$this->getConfig('title'));
		$this->assign('username',$this->getConfig('username'));
		$this->assign('width',$this->getConfig('width'));
		$this->assign('height',$this->getConfig('height'));
		$this->assign('theme',$this->getConfig('theme'));

		$scrollbar = $this->getConfig('enable_scrollbar');
		$scrollbar = !$scrollbar?'noscrollbar':'';
		$this->assign('scrollbar', $scrollbar);

		$enable_header = $this->getConfig('enable_header');
		$enable_header = !$enable_header?'noheader':'';
		$this->assign('header',$enable_header);

		$enable_footer = $this->getConfig('enable_footer');
		$enable_footer = !$enable_footer?'nofooter':'';
		$this->assign('footer',$enable_footer);
		
		$enable_border = $this->getConfig('enable_border');
		$enable_border = !$enable_border?'noborders':'';
		$this->assign('border',$enable_border);
		
		$this->assign('borderColor',$this->getConfig('border_color'));
		$this->assign('limit',$this->getConfig('limit'));
		$this->assign('linkColor',$this->getConfig('link_color'));
		return parent::_toHtml();
	}
	/**
	 * get value of the extension's configuration
	 *
	 * @return string
	 */
	public function getConfig( $key, $default = ""){
	    $value = $this->getData($key);
	    //Check if has widget config data
	    if($this->hasData($key) && $value !== null) {

	      if($value == "true") {
	        return 1;
	      } elseif($value == "false") {
	        return 0;
	      }
	      
	      return $value;
	      
	    }
	    return $default;
	}
}