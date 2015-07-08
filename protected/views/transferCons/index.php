<?php
/* @var $this TransferConsController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Transfer Cons',
);

$this->menu=array(
	//array('label'=>'Create TransferCons','url'=>array('create')),
	//array('label'=>'Manage TransferCons','url'=>array('admin')),
);
?>

<h1>Transfer Cons</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>