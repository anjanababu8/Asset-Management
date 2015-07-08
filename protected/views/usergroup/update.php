<?php
/* @var $this UsergroupController */
/* @var $model Usergroup */
?>

<?php
$this->breadcrumbs=array(
	'Usergroups'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
?>

    <h1>Update Usergroup <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>