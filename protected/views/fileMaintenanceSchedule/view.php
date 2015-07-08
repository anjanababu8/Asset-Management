<?php
/* @var $this FileMaintenanceScheduleController */
/* @var $model FileMaintenanceSchedule */
?>

<?php
$this->breadcrumbs=array(
	'File Maintenance Schedules'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List FileMaintenanceSchedule', 'url'=>array('index')),
	array('label'=>'Create FileMaintenanceSchedule', 'url'=>array('create')),
	array('label'=>'Update FileMaintenanceSchedule', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FileMaintenanceSchedule', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FileMaintenanceSchedule', 'url'=>array('admin')),
);
?>

<h1>View FileMaintenanceSchedule #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'name',
	),
)); ?>