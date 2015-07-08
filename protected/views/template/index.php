<?php
/* @var $this TemplateController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Templates',
);

$this->menu=array(
	array('label'=>'Create Template','url'=>array('create')),
	array('label'=>'Manage Template','url'=>array('admin')),
);
?>

<h1>Templates</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>