<?php
/* @var $this GroupController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Groups',
);

$this->menu=array(
	array('label'=>'Create Group','url'=>array('create')),
	array('label'=>'Manage Group','url'=>array('admin')),
);
?>

<h1>Groups</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>