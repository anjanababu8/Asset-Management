<?php
/* @var $this LabelController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Labels',
);

$this->menu=array(
	array('label'=>'Create Label','url'=>array('create')),
	array('label'=>'Manage Label','url'=>array('admin')),
);
?>

<h1>Labels</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>