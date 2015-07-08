<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this UserController */
/* @var $model User */
?>

<?php
$this->breadcrumbs=array(
	'Users'=>array('admin'),
	'Manage'=>array('admin'),
	'Create',
);
?>

<h1>Create <span style="color:#B40431">User</span></h1>
<?php //echo CHtml::link('List All','index',array('class'=>'btn-danger btn buttonDesign')); ?>
<?php //echo CHtml::link('Manage All','admin',array('class'=>'btn-inverse btn buttonDesign')); ?>

<?php $this->renderPartial('_form', array('model'=>$model,'model1'=>$model1)); 