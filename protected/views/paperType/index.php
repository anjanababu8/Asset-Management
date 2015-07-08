<?php
/* @var $this PaperTypeController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Paper Types',
);

$this->menu=array(
	array('label'=>'Create PaperType','url'=>array('create')),
	array('label'=>'Manage PaperType','url'=>array('admin')),
);
?>

<h1>Paper Types</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>