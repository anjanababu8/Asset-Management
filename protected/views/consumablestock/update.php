<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this ConsumablestockController */
/* @var $model Consumablestock */
?>

<?php
$this->breadcrumbs=array(
	'Consumablestocks'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Update Consumablestock <span style="color:#B40431"><?php echo $model->consumable->name.' : '.$model->id; ?></span></h1>
<?php echo CHtml::link('View '.$model->consumable->name.' : '.$model->id,array('view', 'id'=>$model->id),array('class'=>'btn-danger btn buttonDesign')); ?>
<?php echo CHtml::link('Manage All',Yii::app()->homeUrl.'/consumablestock/admin',array('class'=>'btn-inverse btn buttonDesign')); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>