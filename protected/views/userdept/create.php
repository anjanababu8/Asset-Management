<?php
/* @var $this UserdeptController */
/* @var $model Userdept */
?>

<?php
$this->breadcrumbs=array(
	'Userdepts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Userdept', 'url'=>array('index')),
	array('label'=>'Manage Userdept', 'url'=>array('admin')),
);
?>

<h1>Create Userdept</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>