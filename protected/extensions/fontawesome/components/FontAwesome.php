<?php

/**
 * FontAwesome extension.
 * 
 * @author Tomasz Trejderowski -- http://www.yiiframework.com/user/7141/
 * @license CC BY 3.0 http://creativecommons.org/licenses/by/3.0/
 * 
 * Based on:
 * - Font Awesome -- http://fortawesome.github.com/Font-Awesome
 * - EFontAwesome extension -- http://www.yiiframework.com/extension/efontawesome
 */
class FontAwesome extends CApplicationComponent
{
	/**
	 * @var boolean whether to publish Font Awesome assets. Defaults to TRUE, if
     * running as normal application and to FALSE in console application.
     * 
     * Set this to false, to prevent publishing duplicate assets, if you're using 
     * any Twitter Bootstrap extension or have Font Awesome source CSS files published
     * in any other way.
	 */
	public $publishAwesome;
    
    protected $publishedAssetsPath;

    public function init()
    {
        if(Yii::getPathOfAlias('fontawesome') === false) Yii::setPathOfAlias('fontawesome', realpath(dirname(__FILE__) . '/..'));
        
        /**
         * Don't publish assets if running as console application (if user won't
         * force this -- see below).
         */
        if(!isset($this->publishAwesome)) $this->publishAwesome = (!Yii::app() instanceof CConsoleApplication);

        /**
         * Don't publish assets in case of console application or if user manually
         * block this extension from self-publishing Font Awesome assets.
         */
        if($this->publishAwesome) Yii::app()->getClientScript()->registerCssFile($this->getAssetsUrl().'/css/font-awesome.css');

        parent::init();
    }
    
    public function getAssetsUrl()
    {
        if(!isset($this->publishedAssetsPath))
        {
            $assetsSourcePath = Yii::getPathOfAlias('fontawesome.assets');
            
            $publishedAssetsPath = Yii::app()->assetManager->publish($assetsSourcePath, false, -1);
            
            return $this->publishedAssetsPath = $publishedAssetsPath;
        }
        else return $this->publishedAssetsPath;
    }
}
