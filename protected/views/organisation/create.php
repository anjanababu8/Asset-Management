<?php
/* @var $this OrganisationController */
/* @var $model Organisation */
?>

<?php
$this->breadcrumbs=array(
	'Organisations'=>array('index'),
	'Create',
);
?>

<h1>Create <span style="color:#B40431">Organisation</span></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>