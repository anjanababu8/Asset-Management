<?php
/* @var $this DeptController */
/* @var $model Dept */
?>

<?php
$this->breadcrumbs=array(
	'Department'=>array('index'),
	'Manage'=>array('admin'),
	'Update '.$model->name,
);

?>

<h1>Update Department <span style="color:#B40431"><?php echo $model->name; ?></span></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>