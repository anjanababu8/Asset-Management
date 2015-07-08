<?php
/* @var $this LinkController */
/* @var $model Link */


$this->breadcrumbs=array(
	'Links'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Link', 'url'=>array('index')),
	array('label'=>'Create Link', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#link-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Links</h1>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'link-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
                array('name'=>'commodity_from.name','header'=>'Link From'),
                array('name'=>'commodity_to.name','header'=>'Link To'),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>