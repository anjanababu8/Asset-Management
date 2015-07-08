<?php
/* @var $this PaperTypeController */
/* @var $model PaperType */
?>

<?php
$this->breadcrumbs=array(
	'Paper Types'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

?>

<h1>Update PaperType <span style="color:#B40431"><?php echo $model->name; ?></span></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>