<?php
/* @var $this FiledetailsController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Filedetails',
);

$this->menu=array(
	array('label'=>'Create Filedetails','url'=>array('create')),
	array('label'=>'Manage Filedetails','url'=>array('admin')),
);
?>

<h1>Filedetails</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>