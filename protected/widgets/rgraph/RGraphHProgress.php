<?php
/**
 * RGraph Horizontal Progress Bar class
 * @author Ricardo Obregón <ricardo@obregon.co>
 * @date 19/04/12 05:30 PM
 */
require_once('RGraphWidget.php');
class RGraphHProgress extends RGraphWidget
{
	public $maxValue = 100;

	public function init()
	{
		parent::init();
		$this->registerScriptFile('RGraph.hprogress.js');
	}

	public function run()
	{
		parent::run();
		$id = 'HProgress' . $this->getId();
		$data = CJSON::encode($this->data);
		$script = "var $id = new RGraph.HProgress('{$this->getId()}',{$data},{$this->maxValue});";
		$script .= $this->getEncodedOptions($id);
		$script .= "{$id}.{$this->drawFunction};";

		$cs = Yii::app()->getClientScript();
		$cs->registerScript($id, $script);
	}
}