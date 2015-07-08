<?php
/* @var $this TransferConsController */
/* @var $model TransferCons */
?>

<?php
$this->breadcrumbs=array(
	'Transfer Cons'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TransferCons', 'url'=>array('index')),
	array('label'=>'Create TransferCons', 'url'=>array('create')),
	array('label'=>'View TransferCons', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TransferCons', 'url'=>array('admin')),
);
?>

    <h1>Update TransferCons <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>