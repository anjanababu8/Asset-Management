<?php
/* @var $this LabelController */
/* @var $model Label */
?>

<?php
$this->breadcrumbs=array(
	'Labels'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Label', 'url'=>array('index')),
	array('label'=>'Create Label', 'url'=>array('create')),
	array('label'=>'View Label', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Label', 'url'=>array('admin')),
);
?>

    <h1>Update Label <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>