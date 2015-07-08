<?php
/* @var $this CommodityCategoryController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Commodity Categories',
);

$this->menu=array(
	array('label'=>'Create CommodityCategory','url'=>array('create')),
	array('label'=>'Manage CommodityCategory','url'=>array('admin')),
);
?>

<h1>Commodity Categories</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>