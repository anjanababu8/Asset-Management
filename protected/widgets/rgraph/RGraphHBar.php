<?php
/**
 * RGraph Horizontal Bars class
 * @author Ricardo Obregón <ricardo@obregon.co>
 * @date 19/04/12 05:30 PM
 */
require_once('RGraphWidget.php');
class RGraphHBar extends RGraphWidget
{
	public function init()
	{
		parent::init();
		$this->registerScriptFile('RGraph.hbar.js');
	}

	public function run()
	{
		parent::run();
		$id = 'HBar' . $this->getId();
		$data = CJSON::encode($this->data);
		$script = "var $id = new RGraph.HBar('{$this->getId()}',{$data});";
		$script .= $this->getEncodedOptions($id);
		$script .= "{$id}.{$this->drawFunction};";

		$cs = Yii::app()->getClientScript();
		$cs->registerScript($id, $script);
	}
}
