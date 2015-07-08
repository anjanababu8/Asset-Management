<?php
/* @var $this UserdeptController */
/* @var $model Userdept */
?>

<?php
$this->breadcrumbs=array(
	'Userdepts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Userdept', 'url'=>array('index')),
	array('label'=>'Create Userdept', 'url'=>array('create')),
	array('label'=>'Update Userdept', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Userdept', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Userdept', 'url'=>array('admin')),
);
?>

<h1>View Userdept #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'uid',
		'dept_id',
	),
)); ?>