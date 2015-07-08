<?php
/* @var $this ReportController */
/* @var $model Report */


$this->breadcrumbs=array(
	'Reports'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Report', 'url'=>array('index')),
	array('label'=>'Create Report', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#report-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>View Reports</h1>
<br />
<br />


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'report-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
            
//            array(
//			'class'=>'bootstrap.widgets.TbButtonColumn',
//                    'template'=>'{delete}' //removed {update}
//		),
		'rid',
		'name',
		'timestamp',
		//'uid',
		//'description',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                    //'template'=>$template
		),
	),
)); ?>