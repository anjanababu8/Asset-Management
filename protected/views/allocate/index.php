<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this AllocateController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Allocates',
);
?>

<h1>Allo<span style="color:#B40431">cates</span></h1>
<?php echo CHtml::link('Manage','admin',array('class'=>'btn-inverse btn buttonDesign')); ?>
<?php echo "<br/><br/>"?>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>