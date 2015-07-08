<?php
/* @var $this TypesController */
/* @var $model Type */

$this->breadcrumbs=array(
	'Types'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Type', 'url'=>array('index')),
	array('label'=>'Add New Type', 'url'=>array('new')),
	array('label'=>'Manage Forms', 'url'=>array('forms/index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#type-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>All Types</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'type-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'TYPE_ID',
		'TYPE_LABEL',
		/*
		'CREATED_BY',
		'LAST_MODIFIED_BY',
		'CREATED_DATE',
		'LAST_MODIFIED_DATE',
		*/
		array(
			'class'=>'CButtonColumn',
			'buttons'=>array(
				'view'=>array(
					'url'=>'$this->grid->controller->createUrl("view", array("type"=>$data->primaryKey))',
					'options'=>array('title'=>'View'),
				),
				'update'=>array(
					'url'=>'$this->grid->controller->createUrl("edit", array("type"=>$data->primaryKey))',
					'options'=>array('title'=>'Edit'),
				),
				'delete'=>array(
					'url'=>'$this->grid->controller->createUrl("delete", array("type"=>$data->primaryKey))',
					'options'=>array('title'=>'Delete'),
				)
			),
		),
	),
)); ?>
