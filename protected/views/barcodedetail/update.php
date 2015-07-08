<?php
/* @var $this BarcodedetailController */
/* @var $model Barcodedetail */
?>

<?php
$this->breadcrumbs=array(
	'Barcodedetails'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Barcodedetail', 'url'=>array('index')),
	array('label'=>'Create Barcodedetail', 'url'=>array('create')),
	array('label'=>'View Barcodedetail', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Barcodedetail', 'url'=>array('admin')),
);
?>

    <h1>Update Barcodedetail <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>