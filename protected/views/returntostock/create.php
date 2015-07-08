<?php
/* @var $this ReturntostockController */
/* @var $model Returntostock */
?>

<?php
$this->breadcrumbs=array(
	'Returntostocks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Returntostock', 'url'=>array('index')),
	array('label'=>'Manage Returntostock', 'url'=>array('admin')),
);
?>

<h1>Create Returntostock</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>