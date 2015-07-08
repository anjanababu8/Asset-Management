<?php
/* @var $this ReturntostockController */
/* @var $model Returntostock */
?>

<?php
$this->breadcrumbs=array(
	'Returntostocks'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Returntostock', 'url'=>array('index')),
	array('label'=>'Create Returntostock', 'url'=>array('create')),
	array('label'=>'Update Returntostock', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Returntostock', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Returntostock', 'url'=>array('admin')),
);
?>

<h1>View Returntostock #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'description',
	),
)); ?>