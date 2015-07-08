<?php
/* @var $this FileStatusController */
/* @var $model FileStatus */
?>

<?php
$this->breadcrumbs=array(
	'File Statuses'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List FileStatus', 'url'=>array('index')),
	array('label'=>'Create FileStatus', 'url'=>array('create')),
	array('label'=>'Update FileStatus', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FileStatus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FileStatus', 'url'=>array('admin')),
);
?>

<h1>View FileStatus #<?php echo $model->id; ?></h1>

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