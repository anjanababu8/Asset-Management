<?php
/* @var $this FileMaintenanceScheduleController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'File Maintenance Schedules',
);

$this->menu=array(
	array('label'=>'Create FileMaintenanceSchedule','url'=>array('create')),
	array('label'=>'Manage FileMaintenanceSchedule','url'=>array('admin')),
);
?>

<h1>File Maintenance Schedules</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>