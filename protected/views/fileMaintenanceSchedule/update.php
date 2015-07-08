<?php
/* @var $this FileMaintenanceScheduleController */
/* @var $model FileMaintenanceSchedule */
?>

<?php
$this->breadcrumbs=array(
	'File Maintenance Schedules'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FileMaintenanceSchedule', 'url'=>array('index')),
	array('label'=>'Create FileMaintenanceSchedule', 'url'=>array('create')),
	array('label'=>'View FileMaintenanceSchedule', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FileMaintenanceSchedule', 'url'=>array('admin')),
);
?>

    <h1>Update FileMaintenanceSchedule <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>