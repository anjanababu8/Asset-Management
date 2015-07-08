<?php
/* @var $this BarcodedetailController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Barcodedetails',
);

$this->menu=array(
	array('label'=>'Create Barcodedetail','url'=>array('create')),
	array('label'=>'Manage Barcodedetail','url'=>array('admin')),
);
?>

<h1>Barcodedetails</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>