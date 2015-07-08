<?php
/* @var $this ReturntostockController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Returntostocks',
);

$this->menu=array(
	array('label'=>'Create Returntostock','url'=>array('create')),
	array('label'=>'Manage Returntostock','url'=>array('admin')),
);
?>

<h1>Returntostocks</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>