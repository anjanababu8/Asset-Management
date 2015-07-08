<?php
/* @var $this TransferFileController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Transfer Files',
);

$this->menu=array(
	array('label'=>'Create TransferFile','url'=>array('create')),
	array('label'=>'Manage TransferFile','url'=>array('admin')),
);
?>

<h1>Transfer Files</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>