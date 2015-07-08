<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this CommodityController */
/* @var $model Commodity */
?>

<?php
$this->breadcrumbs=array(
	'Commodities'=>array('admin'),
	$model->name,
);
?>

<h1>View Commodity <span style="color:#B40431"><?php echo $model->name; ?></span>
<?php echo CHtml::link('<i class="icon-pencil"></i>',array('update', 'id'=>$model->id),array('class'=>'btn-warning btn buttonDesign')); ?>
<?php echo CHtml::link('<i class="icon-trash"></i>','#',array('class'=>'btn-warning btn buttonDesign','submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')); ?>
</h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'name',
		'description',
		array('name'=>'organisation.name','header'=>'Organisation'),
		'categories',
	),
)); ?>