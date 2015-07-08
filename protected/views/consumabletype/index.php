<?php
/* @var $this ConsumabletypeController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Consumabletypes',
);

$this->menu=array(
	array('label'=>'Create Consumabletype','url'=>array('create')),
	array('label'=>'Manage Consumabletype','url'=>array('admin')),
);
?>

<h1>Consumabletypes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>