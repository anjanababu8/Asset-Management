<?php
/* @var $this TypesController */
/* @var $model Type */

$this->breadcrumbs=array(
	'Types'=>array('index'),
	$model->TYPE_ID=>array('view','id'=>$model->TYPE_ID),
	'Update',
);

$this->menu=array(
	array('label'=>'View Type #'.$model->TYPE_ID, 'url'=>array('view', 'type'=>$model->TYPE_ID)),
	array('label'=>'Add New Type', 'url'=>array('new')),
	array('label'=>'List All Types', 'url'=>array('index')),
	array('label'=>'Manage Forms', 'url'=>array('forms/index')),
);
?>

<h1>Edit Type #<?php echo $model->TYPE_ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>