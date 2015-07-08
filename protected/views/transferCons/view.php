<?php
/* @var $this TransferConsController */
/* @var $model TransferCons */
?>

<?php
$this->breadcrumbs=array(
	'Transfer Cons'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TransferCons', 'url'=>array('index')),
	array('label'=>'Create TransferCons', 'url'=>array('create')),
	array('label'=>'Update TransferCons', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TransferCons', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TransferCons', 'url'=>array('admin')),
);
?>

<h1>View TransferCons #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		//'id',
		array('name'=>'consumable.name','header'=>'Consumable'),
		'belongs_to',
		'transfer_to',
	),
)); ?>