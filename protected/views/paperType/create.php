<?php
/* @var $this PaperTypeController */
/* @var $model PaperType */
?>

<?php
$this->breadcrumbs=array(
	'Paper Types'=>array('admin'),
	'Create',
);

?>

<h1>Add <span style="color:#B40431">PaperType</span></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>