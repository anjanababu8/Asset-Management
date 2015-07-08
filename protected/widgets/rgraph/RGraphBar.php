<?php
/**
 * RGraph Bars class
 * @author Ricardo Obregón <ricardo@obregon.co>
 * @date 19/04/12 05:30 PM
 */
require_once('RGraphWidget.php');
class RGraphBar extends RGraphWidget
{
	public function init()
	{
		parent::init();
		$this->registerScriptFile('RGraph.bar.js');
	}

	public function run()
	{
		parent::run();
		$id = 'Bar' . $this->getId();
		$data = CJSON::encode($this->data);
		$script = "var $id = new RGraph.Bar('{$this->getId()}',{$data});";
		$script .= $this->getEncodedOptions($id);
		$script .= "{$id}.{$this->drawFunction};";

		$cs = Yii::app()->getClientScript();
		$cs->registerScript($id, $script);
	}
}
