<?php
/* @var $this FieldsController */
/* @var $model FormField */

$this->breadcrumbs=array(
	'Form Fields'=>array(),
	'Create',
);

?>

<?php $formRow = Form::model()->findByAttributes(array('FORM_ID'=>$form_id));?>
<h1>Add Field to <span style="color:#B40431"><?php echo $formRow['FORM_NAME'];?></span></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'form_id'=>$form_id)); ?>