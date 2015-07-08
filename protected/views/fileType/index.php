<?php
/* @var $this FileTypeController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'File Types',
);

$this->menu=array(
	array('label'=>'Create FileType','url'=>array('create')),
	array('label'=>'Manage FileType','url'=>array('admin')),
);
?>

<h1>File Types</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>