<?php
/* @var $this ManagementtypeController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Managementtypes',
);

$this->menu=array(
	array('label'=>'Create Managementtype','url'=>array('create')),
	array('label'=>'Manage Managementtype','url'=>array('admin')),
);
?>

<h1>Managementtypes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>