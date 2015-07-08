<?php
/* @var $this UserdeptController */
/* @var $model Userdept */
?>

<?php
$this->breadcrumbs=array(
	'Userdepts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Userdept', 'url'=>array('index')),
	array('label'=>'Create Userdept', 'url'=>array('create')),
	array('label'=>'View Userdept', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Userdept', 'url'=>array('admin')),
);
?>

    <h1>Update Userdept <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>