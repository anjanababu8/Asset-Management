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
/* @var $model Allocate */
?>

<?php
$this->breadcrumbs=array(
	'Allocates'=>array('admin'),
	$model->allocate_id,
);
?>

<h1>View Allocate <span style="color:#B40431"><?php echo $model->allocate_id; ?></span></h1>
<?php //echo CHtml::link('List All','index',array('class'=>'btn-danger btn buttonDesign')); ?>
<?php echo CHtml::link('Manage All','admin',array('class'=>'btn-inverse btn buttonDesign')); ?>
<?php echo CHtml::link('Update',array('update', 'id'=>$model->id),array('class'=>'btn-inverse btn buttonDesign')); ?>
<?php echo CHtml::link('Delete','#',array('class'=>'btn-danger btn buttonDesign','submit'=>array('delete','id'=>$model->allocate_id),'confirm'=>'Are you sure you want to delete this item?')); ?>
<?php echo "<br/><br/>";?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		array('name'=>'consumable.name','header'=>'Consumable'),		
		'date_in',
                'date_out',
                'return_on',
		'given_by',
                //array('name'=>($a == 'G')? 'groupto.name':(($a == 'U')? 'userto.name':''),'header'=>'Given To'),
		'given_to',
                'purpose',
		'comments',
	),
)); ?>