<?php
/* @var $this FormController */
/* @var $model Form */

$this->breadcrumbs=array(
	'Forms'=>array('index'),
	$model->FORM_ID=>array('view','id'=>$model->FORM_ID),
	'Update',
);

$this->menu=array(
	
	array('label'=>'Manage Template #'.$model->FORM_ID."'s Fields", 'url'=>array('fields/index', 'form'=>$model->FORM_ID)),	
	
	
	
);
?>

<h1>Edit Form <span style="color:#B40431"><?php echo $model->FORM_NAME; ?></span></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>