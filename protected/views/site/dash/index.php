<?php $this->pageTitle=Yii::app()->name; ?>

<?php
$basePath = Yii::app()->basePath . DIRECTORY_SEPARATOR . 'extensions' . DIRECTORY_SEPARATOR . 'jqplot';
$baseUrl = Yii::app()->getAssetManager()->publish($basePath, false, 1, YII_DEBUG);

$cs = Yii::app()->clientScript;
$cs->registerScriptFile($baseUrl . '/jquery.jqplot.min.js');
$cs->registerCssFile($baseUrl . '/jquery.jqplot.min.css');
$cs->registerScriptFile($baseUrl . '/plugins/jqplot.barRenderer.min.js');
$cs->registerScriptFile($baseUrl . '/plugins/jqplot.categoryAxisRenderer.min.js');
$cs->registerScriptFile($baseUrl . '/plugins/jqplot.canvasAxisTickRenderer.min.js');
$cs->registerScriptFile($baseUrl . '/plugins/jqplot.canvasAxisLabelRenderer.min.js');
$cs->registerScriptFile($baseUrl . '/plugins/jqplot.canvasTextRenderer.min.js');
$cs->registerScriptFile($baseUrl . '/plugins/jqplot.meterGaugeRenderer.min.js');
$cs->registerScriptFile($baseUrl . '/plugins/jqplot.pointLabels.min.js');
?>

<?php 
	$obj = $this->widget('application.extensions.dashboard.dashboard', array(
    	'divColumns' => array('column1', 'column2', 'column3', 'dash-sing-col-content'),
    	'dashHeader' => array('show'=>true, 'title'=>'Dashboard')
	)); 
?>


<div class="column1">      
	<?php //$obj->addPortlet('feeds', 'Feeds', 'FEEDS PORTAL');?>
	<?php //$obj->addPortlet('news', 'News', $this->renderPartial('_news',false,true));?>
</div>
<div class="column2">
	<?php //$obj->addPortlet('shopping', 'Shopping', $this->renderPartial('_chart',false,true));?> 
	<?php //$obj->addPortlet('hits', 'Hits', $this->renderPartial('_grid_view',array('dataProvider'=>$usageDataProvider1),true));?> 
</div>
<div class="column3">
	<?php //$obj->addPortlet('weather', 'Weather', '28 C Colombo');?>
	<?php //$obj->addPortlet('traffic', 'Traffic', $this->renderPartial('_meter',false,true));?>
</div>


<div class="dash-sing-col-content">
	<?php $obj->addPortlet('big_chart', 'Consumables In Stock ', $this->renderPartial('_chart_big',false,true));?>
</div>

<div class="dash-sing-col-content">
	<?php $obj->addPortlet('big_chart', 'Number of mouse allocated ', $this->renderPartial('_chart_big_item',false,true));?>
</div>

<?php $obj->end()?>