<?php
/* @var $this ConsumablestockController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Consumablestocks',
);

$this->menu=array(
	array('label'=>'Create Consumablestock','url'=>array('create')),
	array('label'=>'Manage Consumablestock','url'=>array('admin')),
);
?>

<h1>Consumablestocks</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>