<?php
/* @var $this UsergroupController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Usergroups',
);

$this->menu=array(
	array('label'=>'Create Usergroup','url'=>array('create')),
	array('label'=>'Manage Usergroup','url'=>array('admin')),
);
?>

<h1>Usergroups</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>