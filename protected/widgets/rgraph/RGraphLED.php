<?php
/**
 * RGraph LED class
 * @author Ricardo Obregón <ricardo@obregon.co>
 * @date 19/04/12 05:30 PM
 */
require_once('RGraphWidget.php');
class RGraphLED extends RGraphWidget
{
	public function init()
	{
		parent::init();
		$this->registerScriptFile('RGraph.led.js');
	}

	public function run()
	{
		parent::run();
		$id = 'LED' . $this->getId();
		$data = CJSON::encode($this->data);
		$script = "var $id = new RGraph.LED('{$this->getId()}',{$data});";
		$script .= $this->getEncodedOptions($id);
		$script .= "{$id}.{$this->drawFunction};";

		$cs = Yii::app()->getClientScript();
		$cs->registerScript($id, $script);
	}
}
