<?php
/* @var $this FiledetailsController */
/* @var $model Filedetails */
?>

<?php
$this->breadcrumbs=array(
	'Filedetails'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Filedetails', 'url'=>array('index')),
	array('label'=>'Create Filedetails', 'url'=>array('create')),
	array('label'=>'Update Filedetails', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Filedetails', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Filedetails', 'url'=>array('admin')),
);
?>

<h1>View Filedetails #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'fid',
		'content',
		'updatedon',
		'updatedby',
		'remark',
	),
)); ?>