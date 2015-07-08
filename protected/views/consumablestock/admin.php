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


$this->breadcrumbs=array(
	'Consumablestocks'=>array('admin'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#consumablestock-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage <span style="color:#B40431">Consumablestocks</span></h1>
<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn buttonDesign')); ?>
<?php //echo CHtml::link('List All','index',array('class'=>'btn-danger btn buttonDesign')); ?>
<?php //echo CHtml::link('Add Consumablestock','create',array('class'=>'btn-inverse btn buttonDesign')); ?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php $this->widget('application.extensions.print.printWidget', array(
                   'cssFile' => 'print.css',
                   //'printedElement' => '.TbGridView',
				   'printedElement' => '#consumablestock-grid',
				   'htmlOptions' => array(),
				   )); 
    ?>

<?php $gridWidget=$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'consumablestock-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
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
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
<?php	echo CHtml::link('save as pdf','generatePdf',array('class'=>'btn-inverse btn buttonDesign pull-right'));?>
	<?php $this->renderExportGridButton($gridWidget,'Export Grid Results',array('class'=>'btn btn-info pull-right'));?>