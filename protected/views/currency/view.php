<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this CurrencyController */
/* @var $model Currency */

$this->breadcrumbs=array(
	'Currencies'=>array('admin'),
	'Manage'=>array('admin'),
	'View '.$model->name,
);
?>

<h1>View Currency <span style="color:#B40431"><?php echo $model->name; ?></span>
<?php echo CHtml::link('<i class="icon-pencil"></i>',array('update', 'id'=>$model->id),array('class'=>'btn-warning btn buttonDesign','title'=>'Update')); ?>
<?php echo CHtml::link('<i class="icon-trash"></i>','#',array('class'=>'btn-warning btn buttonDesign','title'=>'Delete','submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')); ?>
</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
        'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
	'data'=>$model,
	'attributes'=>array(
		'name',
		'filename',
	),
)); ?>
