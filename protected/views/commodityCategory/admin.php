<?php
/* @var $this CommodityCategoryController */
/* @var $model CommodityCategory */


$this->breadcrumbs=array(
	'Commodity Categories'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CommodityCategory', 'url'=>array('index')),
	array('label'=>'Create CommodityCategory', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#commodity-category-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Commodity Categories</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
        &lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php $this->widget('application.extensions.print.printWidget', array(
                   'cssFile' => 'print.css',
                   //'printedElement' => '.TbGridView',
				   'printedElement' => '#commodity-category-grid',
				   'htmlOptions' => array(),
				   )); 
    ?>

<?php $gridWidget= $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'commodity-category-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'commodity.name','header'=>'Commodity'),
		array('name'=>'category.name','header'=>'Category'),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
<?php	echo CHtml::link('save as pdf','generatePdf',array('class'=>'btn-inverse btn buttonDesign pull-right'));?>
	<?php $this->renderExportGridButton($gridWidget,'Export Grid Results',array('class'=>'btn btn-info pull-right'));?>