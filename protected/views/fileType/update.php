<?php
/* @var $this FileTypeController */
/* @var $model FileType */
?>

<?php
$this->breadcrumbs=array(
	'File Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Update FileType <span style="color:#B40431"><?php echo $model->name; ?></span></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>