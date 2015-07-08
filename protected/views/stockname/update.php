<?php
/* @var $this StocknameController */
/* @var $model Stockname */
?>

<?php
$this->breadcrumbs=array(
	'Stocknames'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Stockname', 'url'=>array('index')),
	array('label'=>'Create Stockname', 'url'=>array('create')),
	array('label'=>'View Stockname', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Stockname', 'url'=>array('admin')),
);
?>

    <h1>Update Stockname <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>