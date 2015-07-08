<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this CategoryController */
/* @var $model Category */


$this->breadcrumbs=array(
	'Categories'=>array('admin'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#category-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage <span style="color:#B40431">Categories</span></h1>
<?php echo CHtml::link('<i class="icon-plus"></i>','create',array('class'=>'btn-warning btn buttonDesign','title'=>'Add '.ucfirst($this->id))); ?>
<?php $this->widget('application.extensions.print.printWidget', array(
                   'cssFile' => 'print.css',
                   //'printedElement' => '.TbGridView',
				   'printedElement' => '#category-grid',
				   'htmlOptions' => array(),
				   )); 
    ?>
<?php echo CHtml::link('<i class="icon-file"></i> <b>PDF</b>','generatePdf',array('class'=>'btn btn-danger buttonDesign','style'=>'height:16px;','title'=>'Save as PDF'));?>
<?php echo CHtml::link('<i class="icon-file"></i> <b>CSV</b>','#csv',array('class'=>'btn-success btn buttonDesign','style'=>'height:16px;','title'=>'Save as CSV')); ?> 
  
<?php $gridWidget=$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'category-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
		'descr',
		//'pid',
                array('name'=>'getparent.name','header'=>'Parent Category'),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
<?php $this->renderExportGridButton($gridWidget,'<i class="icon-file"></i> <b>CSV</b>',array('id'=>'csv','class'=>'btn-success btn buttonDesign pull-right','style'=>'height:16px;','title'=>'Save as CSV'));?>