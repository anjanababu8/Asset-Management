<?php
/* @var $this DamagelogController */
/* @var $model Damagelog */
?>

<?php
$this->breadcrumbs=array(
	'Damagelogs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Damagelog', 'url'=>array('index')),
	array('label'=>'Manage Damagelog', 'url'=>array('admin')),
);
?>

<h1>Create Damagelog</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>