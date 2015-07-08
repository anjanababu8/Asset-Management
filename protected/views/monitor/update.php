<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this MonitorController */
/* @var $model Monitor */
?>

<?php
$this->breadcrumbs=array(
        'Monitor'=>array('admin'),
        'Manage'=>array('admin'),
	'Update '.$model->name,
);
?>
<?php $commodityId = Commodity::model()->find('name =:name',array('name'=>$this->id));?>
<h1>Update Monitor <span style="color:#B40431"><?php echo $model->name; ?></span></h1>
<?php //echo CHtml::link('List All','http://localhost/asset_management/index.php/consumable/index',array('class'=>'btn-danger btn buttonDesign')); ?>
<?php //echo CHtml::link('Add Monitor','http://localhost/asset_management/index.php/Monitor/create?commodity_id='.$commodityId['id'],array('class'=>'btn-inverse btn buttonDesign')); ?>
<?php //echo CHtml::link('View '.$model->name,array('view', 'id'=>$model->id),array('class'=>'btn-danger btn buttonDesign')); ?>
<?php //echo CHtml::link('Manage All','http://localhost/asset_management/index.php/Monitor/admin',array('class'=>'btn-inverse btn buttonDesign')); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>