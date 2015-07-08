<?php
/* @var $this CommodityCategoryController */
/* @var $model CommodityCategory */
?>

<?php
$this->breadcrumbs=array(
	'Commodity Categories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CommodityCategory', 'url'=>array('index')),
	array('label'=>'Create CommodityCategory', 'url'=>array('create')),
	array('label'=>'Update CommodityCategory', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CommodityCategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CommodityCategory', 'url'=>array('admin')),
);
?>

<h1>View CommodityCategory #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		array('name'=>'commodity.name','header'=>'Commodity'),
		array('name'=>'category.name','header'=>'Category'),
	),
)); ?>