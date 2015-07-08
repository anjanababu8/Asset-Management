<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this StatusController */
/* @var $model Status */
?>

<?php
$this->breadcrumbs=array(
	'Statuses'=>array('admin'),
	'Manage'=>array('admin'),
	'Update '.$model->status,
);
?>

<h1>Update Status <span style="color:#B40431"><?php echo $model->status; ?></span></h1>
<?php //echo CHtml::link('List All','http://localhost/asset_management/index.php/supplier/index',array('class'=>'btn-danger btn buttonDesign')); ?>
<?php //echo CHtml::link('Add Status','http://localhost/asset_management/index.php/status/create',array('class'=>'btn-inverse btn buttonDesign')); ?>
<?php //echo CHtml::link('View '.$model->status,array('view', 'id'=>$model->id),array('class'=>'btn-danger btn buttonDesign')); ?>
<?php //echo CHtml::link('Manage All','http://localhost/asset_management/index.php/status/admin',array('class'=>'btn-inverse btn buttonDesign')); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>