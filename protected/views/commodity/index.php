<?php
/* @var $this CommodityController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Commodities',
);

$this->menu=array(
	array('label'=>'Create Commodity','url'=>array('create')),
	array('label'=>'Manage Commodity','url'=>array('admin')),
);
?>

<h1>Commodities</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>