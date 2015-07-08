<?php
/* @var $this FieldsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Form Fields',
);

$this->menu=array(
	array('label'=>'Create FormField', 'url'=>array('create')),
	array('label'=>'Manage FormField', 'url'=>array('admin')),
);
?>

<h1>Form Fields</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
