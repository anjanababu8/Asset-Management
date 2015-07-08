<?php
/* @var $this FileStatusController */
/* @var $model FileStatus */
?>

<?php
$this->breadcrumbs=array(
	'File Statuses'=>array('index'),
	'Create',
);
?>

<h1>Create FileStatus</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>