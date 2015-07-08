<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this PaperTypeController */
/* @var $model PaperType */


$this->breadcrumbs=array(
	'Paper Types'=>array('admin'),
	'Manage',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#paper-type-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage <span style="color:#B40431">Paper Types</span></h1>
<?php echo CHtml::link('Add Paper Type','create',array('class'=>'btn-inverse btn buttonDesign')); ?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'paper-type-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'name',
		'width',
		'height',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>