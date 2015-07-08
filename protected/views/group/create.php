<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this GroupController */
/* @var $model Group */
?>

<?php
$this->breadcrumbs=array(
	'Groups'=>array('admin'),
        'Manage'=>array('admin'),
	'Create',
);
?>

<h1>Create <span style="color:#B40431">Group</span></h1>
<?php //echo CHtml::link('List All','index',array('class'=>'btn-danger btn buttonDesign')); ?>
<?php //echo CHtml::link('Manage All','admin',array('class'=>'btn-inverse btn buttonDesign')); ?>
<?php echo "<br/>";?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>