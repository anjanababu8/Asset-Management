<?php
/* @var $this FcloseController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Fcloses',
);

$this->menu=array(
	array('label'=>'Create Fclose','url'=>array('create')),
	array('label'=>'Manage Fclose','url'=>array('admin')),
);
?>

<h1>Fcloses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>