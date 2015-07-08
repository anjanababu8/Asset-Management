<?php
/* @var $this TransferFileController */
/* @var $model TransferFile */
?>

<?php
$this->breadcrumbs=array(
	'Transfer Files'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TransferFile', 'url'=>array('index')),
	array('label'=>'Create TransferFile', 'url'=>array('create')),
	array('label'=>'Update TransferFile', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TransferFile', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TransferFile', 'url'=>array('admin')),
);
?>

<h1>View TransferFile #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'fid',
		'ownedby',
		'transfer_to',
		'previous_location',
		'transfer_location',
		'Remark',
		'timestamp',
		'uid',
		'transfer_date',
	),
)); ?>