<?php
/* @var $this LabelController */
/* @var $model Label */
?>

<?php
$this->breadcrumbs=array(
	'Labels'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Label', 'url'=>array('index')),
	array('label'=>'Create Label', 'url'=>array('create')),
	array('label'=>'Update Label', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Label', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Label', 'url'=>array('admin')),
);
?>

<h1>View Label #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'fields',
		'fid',
		'size',
	),
)); ?>