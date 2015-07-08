<?php
/* @var $this TransferFileController */
/* @var $model TransferFile */
?>

<?php
$this->breadcrumbs=array(
	'Transfer Files'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TransferFile', 'url'=>array('index')),
	array('label'=>'Manage TransferFile', 'url'=>array('admin')),
);
?>

<h1>Create TransferFile</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>