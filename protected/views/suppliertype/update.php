<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this SuppliertypeController */
/* @var $model Suppliertype */
?>

<?php
$this->breadcrumbs=array(
	'Suppliertypes'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Update Suppliertype <span style="color:#B40431"><?php echo $model->name; ?></span></h1>
<?php //echo CHtml::link('List All','http://localhost/asset_management/index.php/manufacturer/index',array('class'=>'btn-danger btn buttonDesign')); ?>
<?php echo CHtml::link('Add Suppliertype','http://localhost/asset_management/index.php/suppliertype/create',array('class'=>'btn-inverse btn buttonDesign')); ?>
<?php echo CHtml::link('View '.$model->name,array('view', 'id'=>$model->id),array('class'=>'btn-danger btn buttonDesign')); ?>
<?php echo CHtml::link('Manage All','http://localhost/asset_management/index.php/suppliertype/admin',array('class'=>'btn-inverse btn buttonDesign')); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>