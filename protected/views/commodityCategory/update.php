<?php
/* @var $this CommodityCategoryController */
/* @var $model CommodityCategory */
?>

<?php
$this->breadcrumbs=array(
	'Commodity Categories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CommodityCategory', 'url'=>array('index')),
	array('label'=>'Create CommodityCategory', 'url'=>array('create')),
	array('label'=>'View CommodityCategory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CommodityCategory', 'url'=>array('admin')),
);
?>

    <h1>Update CommodityCategory <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>