<?php
/**
 * @author Ricardo Obregón <ricardo@obregon.co>
 */
abstract class RGraphWidget extends CWidget
{
	/**
	 * RGraph path where css,images,libraries and scripts directory are present.
	 * @var string
	 */
	public $rGraphPath = 'application.vendors.RGraph';
	protected $rGraphUrl;

	public $allowAdjusting = false;
	public $allowAnnotate = false;
	public $allowContext = false;
	public $allowEffects = false;
	public $allowResizing = false;
	public $allowTooltips = false;
	public $allowZoom = false;

	public $drawFunction = 'Draw()';

	/**
	 * @var array
	 */
	public $data = array();

	/**
	 * @var array
	 */
	public $labels = array();

	/**
	 * @var array the initial JavaScript options that should be passed to the RGraph plugin.
	 */
	public $options = array();

	/**
	 * @var array the HTML attributes that should be rendered in the CANVAS tag.
	 */
	public $htmlOptions = array();

	/**
	 * Initializes the widget.
	 * This method will publish the needed assets.
	 */
	public function init()
	{
		$id = $this->getId();
		if (isset($this->htmlOptions['id']))
			$id = $this->htmlOptions['id'];
		else
			$this->htmlOptions['id'] = $id;

		$this->registerScripts();
		parent::init();
	}

	/**
	 * @param array|string $options
	 */
	protected function encodeOptions($options, $parent = null)
	{
		$result = array();
		if (is_array($options)) {
			$tmpResult = array();
			foreach ($options as $object => $value) {
				if (empty($object) or is_numeric($object)) {
					$tmpResult[] = $value;
				} else {
					if ($parent === null) {
						$newParent = $object;
					} else {
						$newParent = $parent . '.' . $object;
					}
					$childrenValues = $this->encodeOptions($value, $newParent);
					$result = array_merge($result, $childrenValues);
				}
			}
			if (!empty($tmpResult)) {
				$result[$parent] = CJSON::encode($tmpResult);
			}
		} else {
			if ($parent === null) {
				$result[] = CJSON::encode($options);
			} else {
				$result[$parent] = CJSON::encode($options);
			}
		}
		return $result;
	}

	/**
	 * @param string $varId
	 * @return string
	 */
	protected function getEncodedOptions($varId)
	{
		$result = array();
		$options = $this->encodeOptions($this->options);
		if (is_array($options)) {
			foreach ($options as $index => $value) {
				$result[] = "{$varId}.Set('$index',$value);";
			}
		}
		return implode("\n", $result);
	}

	/**
	 * Registers the base script files.
	 * This method registers the minimal JavaScript files and CSS files.
	 */
	protected function registerScripts()
	{
		$commonCss = Yii::app()->assetManager->publish(Yii::getPathOfAlias($this->rGraphPath) . DIRECTORY_SEPARATOR . 'css');
		Yii::app()->getClientScript()->registerCssFile($commonCss . '/common.css');

		$scriptUrl = Yii::getPathOfAlias($this->rGraphPath) . DIRECTORY_SEPARATOR . 'libraries' . DIRECTORY_SEPARATOR;
		$this->rGraphUrl = Yii::app()->assetManager->publish($scriptUrl);
		$this->registerScriptFile('RGraph.common.core.js');
		if ($this->allowAdjusting)
			$this->registerScriptFile('RGraph.common.adjusting.js');
		if ($this->allowAnnotate)
			$this->registerScriptFile('RGraph.common.annotate.js');
		if ($this->allowContext)
			$this->registerScriptFile('RGraph.common.context.js');
		if ($this->allowEffects)
			$this->registerScriptFile('RGraph.common.effects.js');
		if ($this->allowResizing)
			$this->registerScriptFile('RGraph.common.resizing.js');
		if ($this->allowTooltips)
			$this->registerScriptFile('RGraph.common.tooltips.js');
		if ($this->allowZoom)
			$this->registerScriptFile('RGraph.common.zoom.js');
	}

	/**
	 * Registers a JavaScript file under {@link rGraphPath}.
	 * Note that by default, the script file will be rendered at the end of a page to improve page loading speed.
	 * @param string $fileName JavaScript file name
	 * @param integer $position the position of the JavaScript file. Valid values include the following:
	 * <ul>
	 * <li>CClientScript::POS_HEAD : the script is inserted in the head section right before the title element.</li>
	 * <li>CClientScript::POS_BEGIN : the script is inserted at the beginning of the body section.</li>
	 * <li>CClientScript::POS_END : the script is inserted at the end of the body section.</li>
	 * </ul>
	 */
	protected function registerScriptFile($fileName, $position = CClientScript::POS_END)
	{
		Yii::app()->getClientScript()->registerScriptFile($this->rGraphUrl . '/' . $fileName, $position);
	}

	public function run()
	{
		echo CHtml::tag('canvas', $this->htmlOptions, '[No canvas support]') . "\n";
	}
}
