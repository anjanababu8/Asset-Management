<?php
/* @var $this ReturntostockController */
/* @var $model Returntostock */
?>

<?php
$this->breadcrumbs=array(
	'Returntostocks'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Returntostock', 'url'=>array('index')),
	array('label'=>'Create Returntostock', 'url'=>array('create')),
	array('label'=>'View Returntostock', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Returntostock', 'url'=>array('admin')),
);
?>

    <h1>Update Returntostock <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>