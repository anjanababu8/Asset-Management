<?php
/**
 * RGraph Pie class
 * @author Ricardo Obregón <ricardo@obregon.co>
 * @date 19/04/12 05:30 PM
 */
require_once('RGraphWidget.php');
class RGraphPie extends RGraphWidget
{
	public function init()
	{
		parent::init();
		$this->registerScriptFile('RGraph.pie.js');
	}

	public function run()
	{
		parent::run();
		$id = 'Pie' . $this->getId();
		$data = CJSON::encode($this->data);
		$script = "var $id = new RGraph.Pie('{$this->getId()}',{$data});";
		$script .= $this->getEncodedOptions($id);
		$script .= "{$id}.{$this->drawFunction};";

		$cs = Yii::app()->getClientScript();
		$cs->registerScript($id, $script);
	}
}
