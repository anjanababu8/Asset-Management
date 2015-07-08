<?php
/* @var $this FieldsController */
/* @var $model FormField */

$this->breadcrumbs=array(
	'Form Fields'=>array('index'),
	$model->TITLE=>array('view','id'=>$model->FIELD_ID),
	'Update',
);

$this->menu=array(
	array('label'=>'View Form #'.$model->FORM_ID.' Field #'.$model->FIELD_ID, 'url'=>array('view', 'field'=>$model->FIELD_ID,'form'=>$model->FORM_ID)),
	array('label'=>'Delete Form #'.$model->FORM_ID.' Field #'.$model->FIELD_ID, 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','field'=>$model->FIELD_ID,'form'=>$model->FORM_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Add New Field for Form #'.$model->FORM_ID, 'url'=>array('new', 'form'=>$model->FORM_ID)),
	array('label'=>'List Form #'.$model->FORM_ID."'s Fields", 'url'=>array('index', 'form'=>$model->FORM_ID)),
	array('label'=>'Manage Forms', 'url'=>array('forms/all')),
	
);
?>

<h1>Edit Field #<?php echo $model->FIELD_ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>