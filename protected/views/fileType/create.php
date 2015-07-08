<?php
/* @var $this FileTypeController */
/* @var $model FileType */
?>

<?php
$this->breadcrumbs=array(
	'File Types'=>array('index'),
	'Create',
);
?>
<h1>Create <span style="color:#B40431">FileType</span></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>