<?php
/* @var $this DamagelogController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Damagelogs',
);

$this->menu=array(
	array('label'=>'Create Damagelog','url'=>array('create')),
	array('label'=>'Manage Damagelog','url'=>array('admin')),
);
?>

<h1>Damagelogs</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>