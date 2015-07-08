<?php
/* @var $this FileMaintenanceScheduleController */
/* @var $model FileMaintenanceSchedule */
?>

<?php
$this->breadcrumbs=array(
	'File Maintenance Schedules'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FileMaintenanceSchedule', 'url'=>array('index')),
	array('label'=>'Manage FileMaintenanceSchedule', 'url'=>array('admin')),
);
?>

<h1>Create FileMaintenanceSchedule</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>