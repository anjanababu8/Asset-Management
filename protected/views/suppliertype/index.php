<?php
/* @var $this SuppliertypeController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Suppliertypes',
);

$this->menu=array(
	array('label'=>'Create Suppliertype','url'=>array('create')),
	array('label'=>'Manage Suppliertype','url'=>array('admin')),
);
?>

<h1>Suppliertypes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>