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
	($model->consumable->name),
);
?>

<h1>View Consumablestock <span style="color:#B40431"><?php echo $model->consumable->name; ?></span></h1>
<?php //echo CHtml::link('List All','index',array('class'=>'btn-danger btn buttonDesign')); ?>
<?php echo CHtml::link('Manage All','admin',array('class'=>'btn-inverse btn buttonDesign')); ?>
<?php //echo CHtml::link('Add Consumablestock','create',array('class'=>'btn-inverse btn buttonDesign')); ?>
<?php echo CHtml::link('Update',array('http://localhost/asset_management/index.php/consumablestock/update', 'id'=>$model->id),array('class'=>'btn-inverse btn buttonDesign')); ?>
<?php echo CHtml::link('Delete','#',array('class'=>'btn-danger btn buttonDesign','submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')); ?>
<?php echo "<br/><br/>";?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		array('name'=>'consumable.name','header'=>'Consumable'),		
		'po_number',
		'unit_cost',
		'quantity',
		array('name'=>'supplier.name','header'=>'Supplier'),		
		'warranty',
		'date_in',
		'expiry_date',
		'inventory_no',
		array('name'=>'status.status','header'=>'Status'),		
		'documentFileName',
	),
)); ?>