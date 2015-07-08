<?php
/* @var $this DeptController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Depts',
);

$this->menu=array(
	array('label'=>'Create Dept','url'=>array('create')),
	array('label'=>'Manage Dept','url'=>array('admin')),
);
?>

<h1>Depts</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>