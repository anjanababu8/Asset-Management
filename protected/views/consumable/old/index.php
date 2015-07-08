<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>

<?php
/* @var $this ConsumableController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Consumables',
);
?>

<h1>Consu<span style="color:#B40431">mables</span></h1>
<?php echo CHtml::link('Create','create',array('class'=>'btn-danger btn buttonDesign')); ?>
<?php echo CHtml::link('Manage','admin',array('class'=>'btn-inverse btn buttonDesign')); ?>
<?php echo "<br/><br/>"?>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>