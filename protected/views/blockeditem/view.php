<?php
/* @var $this BlockeditemController */
/* @var $model Blockeditem */
?>

<?php
$this->breadcrumbs=array(
	'Blockeditems'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Blockeditem', 'url'=>array('index')),
	array('label'=>'Create Blockeditem', 'url'=>array('create')),
	array('label'=>'Update Blockeditem', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Blockeditem', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Blockeditem', 'url'=>array('admin')),
);
?>

<h1>View Blockeditem #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'commodity_id',
		'item_id',
		'blocked_by',
		'blocked_on',
		'blocked_from',
		'blocked_to',
		'unblock_by',
		'unblock_on',
		'blocked_for',
		'flag',
	),
)); ?>