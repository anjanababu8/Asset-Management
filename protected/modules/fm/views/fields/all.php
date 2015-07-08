<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this FieldsController */
/* @var $model FormField */

$this->breadcrumbs=array(
	'Form Fields'=>array('index'),
	'Manage',				
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#form-field-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $formRow = Form::model()->findByAttributes(array('FORM_ID'=>$form_id));?>
<h1>Manage Fields of <span style="color:#B40431"><?php echo $formRow['FORM_NAME'];?></span></h1>
<?php echo CHtml::link('Add Field',array('fields/new', 'form'=>$form_id),array('class'=>'btn-inverse btn buttonDesign')); ?>
<?php echo CHtml::link('Add Entry',array('entry/new', 'form'=>$form_id),array('class'=>'btn-inverse btn buttonDesign')); ?>
<?php echo CHtml::link($formRow['FORM_NAME'].' Details',array('forms/view', 'form'=>$form_id),array('class'=>'btn-inverse btn buttonDesign')); ?>
<?php echo CHtml::link('Manage Dynamic Forms',array('forms/index'),array('class'=>'btn-inverse btn buttonDesign')); ?>
<?php echo CHtml::link('Manage Form Entries',array('entry/index','form'=>$form_id),array('class'=>'btn-inverse btn buttonDesign')); ?>


<br/><br/>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'form-field-grid',
	'dataProvider'=>$model->search($form_id),
	'filter'=>$model,
	'columns'=>array(
		//'FIELD_ID',
		//'FORM_ID',
		/*array(
			'name'=>'VARNAME',
			'type'=>'raw',
			'value'=>'$data->VARNAME',
		),*/
		array(
			'name'=>'TITLE',
			'value'=>'$data->TITLE',
		),
		array(
			'name'=>'FIELD_TYPE',
			'value'=>'$data->FIELD_TYPE',
			'filter'=>FormField::itemAlias("field_type"),
		),
		'FIELD_SIZE',
		'FIELD_SIZE_MIN',
		array(
			'name'=>'REQUIRED',
			'value'=>'FormField::itemAlias("required",$data->REQUIRED)',
			'filter'=>FormField::itemAlias("required"),
		),
		//'POSITION',
		array(
			'name'=>'VISIBLE',
			'value'=>'FormField::itemAlias("visible",$data->VISIBLE)',
			'filter'=>FormField::itemAlias("visible"),
		),
		//*/
		array(
			'class'=>'CButtonColumn',
			'buttons'=>array(
				'view'=>array(
					'url'=>'$this->grid->controller->createUrl("view", array("field"=>$data->primaryKey,"form"=>$data["FORM_ID"]))',
					'options'=>array('title'=>'View'),
				),
				'update'=>array(
					'url'=>'$this->grid->controller->createUrl("edit", array("field"=>$data->primaryKey,"form"=>$data["FORM_ID"]))',
					'options'=>array('title'=>'Edit'),
				),
				'delete'=>array(
					'url'=>'$this->grid->controller->createUrl("delete", array("field"=>$data->primaryKey,"form"=>$data["FORM_ID"]))',
					'options'=>array('title'=>'Delete'),
				)
			),
		),
	),
)); ?>
