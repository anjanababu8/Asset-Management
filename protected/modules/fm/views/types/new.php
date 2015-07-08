<?php
/* @var $this TypesController */
/* @var $model Type */

$this->breadcrumbs=array(
	'Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List All Types', 'url'=>array('index')),
	array('label'=>'Manage Forms', 'url'=>array('forms/index')),
);
?>

<h1>Add New Type</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>