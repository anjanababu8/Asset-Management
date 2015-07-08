<?php
/* @var $this UserdeptController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Userdepts',
);

$this->menu=array(
	array('label'=>'Create Userdept','url'=>array('create')),
	array('label'=>'Manage Userdept','url'=>array('admin')),
);
?>

<h1>Userdepts</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>