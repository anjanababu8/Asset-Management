<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this ConsumabletypeController */
/* @var $model Consumabletype */
?>

<?php
$this->breadcrumbs=array(
	'Consumabletypes'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Update Consumabletype <span style="color:#B40431"><?php echo $model->name; ?></span></h1>
<?php echo CHtml::link('Add Consumabletype',Yii::app()->homeUrl.'/consumabletype/create',array('class'=>'btn-inverse btn buttonDesign')); ?>
<?php echo CHtml::link('View '.$model->name,array('view', 'id'=>$model->id),array('class'=>'btn-danger btn buttonDesign')); ?>
<?php echo CHtml::link('Manage All',Yii::app()->homeUrl.'/consumabletype/admin',array('class'=>'btn-inverse btn buttonDesign')); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>