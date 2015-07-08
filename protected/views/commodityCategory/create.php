<?php
/* @var $this CommodityCategoryController */
/* @var $model CommodityCategory */
?>

<?php
$this->breadcrumbs=array(
	'Commodity Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CommodityCategory', 'url'=>array('index')),
	array('label'=>'Manage CommodityCategory', 'url'=>array('admin')),
);
?>

<h1>Create CommodityCategory</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>