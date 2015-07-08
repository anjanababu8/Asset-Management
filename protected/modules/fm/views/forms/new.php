<?php
/* @var $this FormsController */
/* @var $model Form */

$this->breadcrumbs=array(
	'Forms'=>array(''),
	'New',
);

?>

<h1>Create <span style="color:#B40431">New Template</span></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>