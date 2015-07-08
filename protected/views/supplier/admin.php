<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this SupplierController */
/* @var $model Supplier */


$this->breadcrumbs=array(
	'Suppliers'=>array('admin'),
	'Manage',
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#supplier-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage <span style="color:#B40431">Suppliers</span></h1>
<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn buttonDesign')); ?>
<?php //echo CHtml::link('List All','index',array('class'=>'btn-danger btn buttonDesign')); ?>
<?php echo CHtml::link('<i class="icon-plus"></i>','create',array('class'=>'btn-warning btn buttonDesign','title'=>'Add '.ucfirst($this->id))); ?>
<?php $this->widget('application.extensions.print.printWidget', array(
                   'cssFile' => 'print.css',
                    'printedElement' => '#supplier-grid',
                    'htmlOptions' => array(),
                    )); 
    ?>
<?php echo CHtml::link('<i class="icon-file"></i> <b>PDF</b>','generatePdf',array('class'=>'btn btn-danger buttonDesign','style'=>'height:16px;','title'=>'Save as PDF'));?>
<?php echo CHtml::link('<i class="icon-file"></i> <b>CSV</b>','#csv',array('class'=>'btn-success btn buttonDesign','style'=>'height:16px;','title'=>'Save as CSV')); ?>

<?php $gridWidget=$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'supplier-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered',
	'filter'=>$model,
	'columns'=>array(
		'name',
                array('name'=>'suppliertype.name','header'=>'SupplierType'),
		'add1',
		'add2',
		'pincode',
		'city',
		'state',
		'country',
		'website',
		'phone_no',
		'comment',
		//'is_deleted',
		'tax',
		'email',
		//'document',
		//'documentFileName',
		//'documentFileType',
		//'visiting_card',
		//'vcardFileName',
		//'vcardFileType',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
<?php $this->renderExportGridButton($gridWidget,'<i class="icon-file"></i> <b>CSV</b>',array('id'=>'csv','class'=>'btn-success btn buttonDesign pull-right','style'=>'height:16px;','title'=>'Save as CSV'));?>