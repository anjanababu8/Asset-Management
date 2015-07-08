
<?php
/* @var $this CurrencyController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Currencies',
);

$this->menu=array(
	array('label'=>'Create Currency','url'=>array('create')),
	array('label'=>'Manage Currency','url'=>array('admin')),
);
?>

<h1>Currencies</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>