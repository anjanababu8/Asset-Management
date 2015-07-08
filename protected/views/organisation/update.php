<?php
/* @var $this OrganisationController */
/* @var $model Organisation */
?>

<?php
$this->breadcrumbs=array(
	'Organisations'=>array('admin'),
	'Manage'=>array('admin'),
	'Update '.$model->name,
);

?>

<h1>Update Organisation <span style="color:#B40431"><?php echo $model->name; ?></span></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>