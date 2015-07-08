<?php
/* @var $this FcloseController */
/* @var $model Fclose */
?>

<?php
$this->breadcrumbs=array(
	'Fcloses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Fclose', 'url'=>array('index')),
	array('label'=>'Manage Fclose', 'url'=>array('admin')),
);
?>

<h1>Create Fclose</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>