
<?php 

$page_refresh_time = 5000;

Yii::app()->clientScript->registerScript('refresh_page',"
timedRefresh($page_refresh_time);

function timedRefresh(timeoutPeriod) {
	setTimeout(function(){refreshGrid()}, timeoutPeriod);
}
 
function refreshGrid() {
	$.fn.yiiGridView.update(\"usage-grid\");
	timedRefresh($page_refresh_time);
}
");
?>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'usage-grid',
	'dataProvider' => $dataProvider,
	'template'=> '{items}',
	'htmlOptions'=>array('style'=>'table-align: top'),
	'columns' => array(
		array(
			'name' => 'Event',
			'type' => 'raw',
			'value' => 'CHtml::encode($data["event"])',
			'htmlOptions'=>array('width'=>'100px')
		),
		array(
			'name' => 'Channels',
			'type' => 'raw',
			'value' => 'CHtml::encode($data["channels"])',
			'htmlOptions'=>array('width'=>'75px')
		),
	),
)); 
?>	 