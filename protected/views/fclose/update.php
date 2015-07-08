<?php
/* @var $this FcloseController */
/* @var $model Fclose */
?>

<?php
$this->breadcrumbs=array(
	'Fcloses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Fclose', 'url'=>array('index')),
	array('label'=>'Create Fclose', 'url'=>array('create')),
	array('label'=>'View Fclose', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Fclose', 'url'=>array('admin')),
);
?>

    <h1>Update Fclose <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>