<?php
/* @var $this ReportController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Reports',
);

$this->menu=array(
	array('label'=>'Create Report','url'=>array('create')),
	array('label'=>'Manage Report','url'=>array('admin')),
);
?>

<h1>Reports</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>