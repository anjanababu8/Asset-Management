<?php
/* @var $this StocknameController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Stocknames',
);

$this->menu=array(
	array('label'=>'Create Stockname','url'=>array('create')),
	array('label'=>'Manage Stockname','url'=>array('admin')),
);
?>

<h1>Stocknames</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>