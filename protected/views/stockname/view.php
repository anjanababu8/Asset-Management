<?php
/* @var $this StocknameController */
/* @var $model Stockname */
?>

<?php
$this->breadcrumbs=array(
	'Stocknames'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Stockname', 'url'=>array('index')),
	array('label'=>'Create Stockname', 'url'=>array('create')),
	array('label'=>'Update Stockname', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Stockname', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Stockname', 'url'=>array('admin')),
);
?>

<h1>View Stockname #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'organisation_id',
		'commodity_id',
		'prefix',
	),
)); ?>