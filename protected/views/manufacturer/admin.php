<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this ManufacturerController */
/* @var $model Manufacturer */


$this->breadcrumbs=array(
	'Manufacturers'=>array('admin'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#manufacturer-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage <span style="color:#B40431">Manufacturers</span></h1>
<?php echo CHtml::link('<i class="icon-plus"></i>','create',array('class'=>'btn-warning btn buttonDesign','title'=>'Add '.ucfirst($this->id))); ?>
<?php $this->widget('application.extensions.print.printWidget', array(
                   'cssFile' => 'print.css',
                    'printedElement' => '#manufacturer-grid',
                    'htmlOptions' => array(),
                    )); 
    ?>
<?php echo CHtml::link('<i class="icon-file"></i> <b>PDF</b>','generatePdf',array('class'=>'btn btn-danger buttonDesign','style'=>'height:16px;','title'=>'Save as PDF'));?>
<?php echo CHtml::link('<i class="icon-file"></i> <b>CSV</b>','#csv',array('class'=>'btn-success btn buttonDesign','style'=>'height:16px;','title'=>'Save as CSV')); ?>

<?php echo '<br/><br/>';?> 
<?php $gridWidget=$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'manufacturer-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>'striped bordered',
	'columns'=>array(
		'name',
		'add1',
		'add2',
		'emailid',
		'mobile',
		'pan',
		'tin',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
<?php $this->renderExportGridButton($gridWidget,'<i class="icon-file"></i> <b>CSV</b>',array('id'=>'csv','class'=>'btn-success btn buttonDesign pull-right','style'=>'height:16px;','title'=>'Save as CSV'));?>