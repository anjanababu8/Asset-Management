<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this UserdeptController */
/* @var $model Userdept */


$this->breadcrumbs=array(
	'User-Departments'=>array('admin'),
	'Manage',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#userdept-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage <span style="color:#B40431">User Departments</span></h1>
<?php $this->widget('application.extensions.print.printWidget', array(
                   'cssFile' => 'print.css',
                   //'printedElement' => '.TbGridView',
				   'printedElement' => '#userdept-grid',
				   'htmlOptions' => array(),
				   )); 
    ?>
<?php echo CHtml::link('<i class="icon-file"></i> <b>PDF</b>','generatePdf',array('class'=>'btn btn-danger buttonDesign','style'=>'height:16px;','title'=>'Save as PDF'));?>
<?php echo CHtml::link('<i class="icon-file"></i> <b>CSV</b>','#csv',array('class'=>'btn-success btn buttonDesign','style'=>'height:16px;','title'=>'Save as CSV')); ?>



<?php $gridWidget=$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'userdept-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
                array('name'=>'user.name','header'=>'User'),
                array('name'=>'department.name','header'=>'Department'),
		/*array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),*/
	),
)); ?>
<?php //$this->renderExportGridButton($gridWidget,'<i class="icon-file"></i> <b>CSV</b>',array('id'=>'csv','class'=>'btn-success btn buttonDesign pull-right','style'=>'height:16px;','title'=>'Save as CSV'));?>