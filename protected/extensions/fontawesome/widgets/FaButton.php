<?php
/**
 * FaButton class file.
 * 
 * Extended version of TbButton from Yii-Boostrap / Twitter Boostrap, that allows
 * using more customized icons in the buttons.
 * 
 * @author Tomasz Trejderowski -- http://www.yiiframework.com/user/7141/
 * @license CC BY 3.0 http://creativecommons.org/licenses/by/3.0/
 * 
 * Based on: * 
 * - TbButton by Christoffer Niska: http://www.cniska.net/yii-bootstrap/
 * - Bootstrap button widget: http://twitter.github.com/bootstrap/base-css.html#buttons
 */
class FaButton extends TbButton
{
	//Icon types
	const TYPE_TOP    = 'icon-top';
	const TYPE_LEFT   = 'icon-left';
    const TYPE_RIGHT  = 'icon-right';
    const TYPE_BOTTOM = 'icon-bottom';
    
	//Icon sizes
	const SIZE_NORMAL    = '';
	const SIZE_LARGE   = 'icon-large';
    const SIZE_2X  = 'icon-2x';
    const SIZE_3X  = 'icon-3x';
    const SIZE_4X  = 'icon-4x';
    
	/**
	 * @var string Icon type, that is -- icon and label placement
	 */
	public $iconType = self::TYPE_LEFT;
    
	/**
	 * @var string Icon size
	 */
	public $iconSize = self::SIZE_NORMAL;
    
	/**
	 * @var boolean Whether icon should be animated (spinning). Uses CSS3 animations,
     * which aren't supported in IE7-IE9.
	 */
	public $iconSpin = FALSE;
    
    private $_icon = '';
    
	public function init()
	{
		if(isset($this->icon))
		{
            $this->_icon = $this->icon;
            $this->icon = '';
            
            parent::init();
            
            $this->icon = $this->_icon;
            
			if(strpos($this->icon, 'icon') === false) $this->icon = 'icon-'.implode(' icon-', explode(' ', $this->icon));

			$this->label = $this->createIcon();
        }
	}
    
	protected function createIcon()
	{
        $iconClasses = (isset($this->icon)) ? array($this->icon) : array();
        
        /**
         * Icon size
         */        
		$validSizes = array(self::SIZE_NORMAL, self::SIZE_LARGE, self::SIZE_2X, self::SIZE_3X, self::SIZE_4X);
		if(isset($this->iconSize) && in_array($this->iconSize , $validSizes)) $iconClasses[] = $this->iconSize;
        
        /**
         * Icon spin
         */
        $iconClasses[] = (isset($this->iconSpin) && $this->iconSpin == TRUE) ? 'icon-spin' : '';
        
		$classes = (!empty($iconClasses)) ? $iconClasses = implode(' ', $iconClasses) : '';
        
        /**
         * Icon type, with fix for to small padding, when iconSize == SIZE_LARGE.
         */
        $paddingSize = ($this->iconSize == self::SIZE_LARGE) ? '7px' : '3px';
        
		switch($this->iconType)
		{
			case self::TYPE_TOP:
				return '<i class="'.$classes.'" style="padding-bottom: '.$paddingSize.'"></i><br />'.$this->label;

			case self::TYPE_RIGHT:
				return $this->label.' <i class="'.$classes.'"></i>';

			case self::TYPE_BOTTOM:
				return $this->label.'<br /><i class="'.$classes.'" style="padding-top: '.$paddingSize.'"></i>';

			default:
			case self::TYPE_LEFT:
				return '<i class="'.$classes.'"></i> '.$this->label;
		}
	}
}
