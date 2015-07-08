<?php
/* @var $this DamagelogController */
/* @var $model Damagelog */
?>

<?php
$this->breadcrumbs=array(
	'Damagelogs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Damagelog', 'url'=>array('index')),
	array('label'=>'Create Damagelog', 'url'=>array('create')),
	array('label'=>'Update Damagelog', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Damagelog', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Damagelog', 'url'=>array('admin')),
);
?>

<h1>View Damagelog #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'description',
	),
)); ?>