<?php
/* @var $this ReportController */
/* @var $model Report */
?>

<?php
$this->breadcrumbs=array(
	'Reports'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Report', 'url'=>array('index')),
	array('label'=>'Manage Report', 'url'=>array('admin')),
);
?>

<h1>Create Report</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>