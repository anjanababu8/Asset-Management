<?php
/* @var $this TypesController */
/* @var $model Type */

$this->breadcrumbs=array(
	'Types'=>array('index'),
	$model->TYPE_ID,
);

$this->menu=array(
	array('label'=>'Edit Type #'.$model->TYPE_ID, 'url'=>array('edit', 'type'=>$model->TYPE_ID)),
	array('label'=>'Delete Type #'.$model->TYPE_ID, 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','type'=>$model->TYPE_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Add New Type', 'url'=>array('new')),
	array('label'=>'List All Types', 'url'=>array('index')),
	array('label'=>'Manage Forms', 'url'=>array('forms/index')),
);
?>

<h1>View Type #<?php echo $model->TYPE_ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'TYPE_ID',
		'TYPE_LABEL',
		'CREATED_BY',
		'LAST_MODIFIED_BY',
		'CREATED_DATE',
		'LAST_MODIFIED_DATE',
	),
)); ?>
