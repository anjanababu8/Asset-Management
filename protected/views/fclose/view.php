<?php
/* @var $this FcloseController */
/* @var $model Fclose */
?>

<?php
$this->breadcrumbs=array(
	'Fcloses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Fclose', 'url'=>array('index')),
	array('label'=>'Create Fclose', 'url'=>array('create')),
	array('label'=>'Update Fclose', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Fclose', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Fclose', 'url'=>array('admin')),
);
?>

<h1>View Fclose #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'fid',
		'choice',
		'date',
		'remark',
	),
)); ?>