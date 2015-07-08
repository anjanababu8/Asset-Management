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
/* @var $model Consumable */
?>

<?php
$this->breadcrumbs=array(
	'Consumables'=>array('admin'),
	$model->name,
);
?>

<h1>View Consumable <span style="color:#B40431"><?php echo $model->name; ?></span></h1>
<?php //echo CHtml::link('List All','index',array('class'=>'btn-danger btn buttonDesign')); ?>
<?php echo CHtml::link('Manage','admin',array('class'=>'btn-inverse btn buttonDesign')); ?>
<?php echo CHtml::link('Add Consumable','create',array('class'=>'btn-inverse btn buttonDesign')); ?>
<?php echo CHtml::link('Update',array('update', 'id'=>$model->id),array('class'=>'btn-inverse btn buttonDesign')); ?>
<?php echo CHtml::link('Delete','#',array('class'=>'btn-danger btn buttonDesign','submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')); ?>
<?php echo "<br/><br/>";?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'name',
                array('name'=>'commodity.name','header'=>'Commodity'),
                array('name'=>'category.name','header'=>'Category'),
                array('name'=>'location.name','label'=>'Location'),
		array('name'=>'user.name','label'=>'Technical Incharge'),
		array('name'=>'status.status','label'=>'Status'),
		array('name'=>'manufacturer.name','label'=>'Manufacturer'),
		array('name'=>'consumabletype.name','label'=>'Consumable Type'),
		array('name'=>'managementtype.name','label'=>'Management Type'),
                array('name'=>'status.status','label'=>'Status'),
		'model',
		'threshold',
		'imageFileName',
		'documentFileName',
		'enable_financial',
		'available_on_loan',
		'semi_consumable',
	),
)); ?>