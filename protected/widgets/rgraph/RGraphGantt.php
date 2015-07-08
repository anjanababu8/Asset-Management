<?php
/**
 * RGraph Gantt class
 * @author Ricardo Obregón <ricardo@obregon.co>
 * @date 19/04/12 05:30 PM
 */
require_once('RGraphWidget.php');
class RGraphGantt extends RGraphWidget
{
	public function init()
	{
		parent::init();
		$this->registerScriptFile('RGraph.gantt.js');
	}

	public function run()
	{
		parent::run();
		$id = 'Gantt' . $this->getId();
		//$data = CJSON::encode($this->data);
		$script = "var $id = new RGraph.Gantt('{$this->getId()}');";
		$script .= $this->getEncodedOptions($id);
		$script .= "{$id}.{$this->drawFunction};";

		$cs = Yii::app()->getClientScript();
		$cs->registerScript($id, $script);
	}
}
