<?php
/* @var $this FieldsController */
/* @var $model FormField */

$this->breadcrumbs=array(
	'Form Fields'=>array('index'),
	$model->TITLE,
);

$this->menu=array(
	array('label'=>'Edit Form #'.$model->FORM_ID.' Field #'.$model->FIELD_ID, 'url'=>array('edit', 'field'=>$model->FIELD_ID,'form'=>$model->FORM_ID)),
	array('label'=>'Delete Form #'.$model->FORM_ID.' Field #'.$model->FIELD_ID, 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','field'=>$model->FIELD_ID,'form'=>$model->FORM_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Add New Field for Form #'.$model->FORM_ID, 'url'=>array('new', 'form'=>$model->FORM_ID)),
	array('label'=>'List Form #'.$model->FORM_ID."'s Fields", 'url'=>array('index', 'form'=>$model->FORM_ID)),
	array('label'=>'Manage Forms', 'url'=>array('forms/index')),
	
);
?>

<h1>View Form #<?php echo $model->FORM_ID; ?> Field #<?php echo $model->FIELD_ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'FIELD_ID',
		'FORM_ID',
		'VARNAME',
		'TITLE',
		'FIELD_TYPE',
		'FIELD_SIZE',
		'FIELD_SIZE_MIN',
		'REQUIRED',
		
		'RANGE',
		'ERROR_MESSAGE',
		'OTHER_VALIDATOR',
		'DEFAULT',
		'WIDGET',
		'WIDGETPARAMS',
		'POSITION',
		'VISIBLE',
		'CREATED_BY',
		'LAST_MODIFIED_BY',
		'CREATED_DATE',
		'LAST_MODIFIED_DATE',
	),
)); ?>
