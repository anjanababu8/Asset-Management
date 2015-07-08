<?php
/* @var $this TransferFileController */
/* @var $model TransferFile */
?>

<?php
$this->breadcrumbs=array(
	'Transfer Files'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TransferFile', 'url'=>array('index')),
	array('label'=>'Create TransferFile', 'url'=>array('create')),
	array('label'=>'View TransferFile', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TransferFile', 'url'=>array('admin')),
);
?>

    <h1>Update TransferFile <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>