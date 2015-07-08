
<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this CartridgeController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Cartridges',
);
?>
<h1>Cartr<span style="color:#B40431">idges</span></h1>
<?php echo CHtml::link('Create','create',array('class'=>'btn-danger btn buttonDesign')); ?>
<?php echo CHtml::link('Manage','admin',array('class'=>'btn-inverse btn buttonDesign')); ?>
<?php echo "<br/><br/>"?>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>