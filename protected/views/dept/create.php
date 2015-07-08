<?php
/* @var $this DeptController */
/* @var $model Dept */
?>

<?php
$this->breadcrumbs=array(
	'Department'=>array('admin'),
        'Manage'=>array('admin'),
	'Create',
);

?>

<h1>Create <span style="color:#B40431">Department</span></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>