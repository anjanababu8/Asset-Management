<?php
/* @var $this StocknameController */
/* @var $model Stockname */
?>

<?php
$this->breadcrumbs=array(
	'Stocknames'=>array('admin'),
	'Create',
);
?>

<h1>Set <span style="color:#B40431">Stock Name</span></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>