<?php
/* @var $this FileStatusController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'File Statuses',
);

$this->menu=array(
	array('label'=>'Create FileStatus','url'=>array('create')),
	array('label'=>'Manage FileStatus','url'=>array('admin')),
);
?>

<h1>File Statuses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>