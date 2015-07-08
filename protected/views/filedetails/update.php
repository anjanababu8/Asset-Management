<?php
/* @var $this FiledetailsController */
/* @var $model Filedetails */
?>

<?php
$this->breadcrumbs=array(
	'Filedetails'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Filedetails', 'url'=>array('index')),
	array('label'=>'Create Filedetails', 'url'=>array('create')),
	array('label'=>'View Filedetails', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Filedetails', 'url'=>array('admin')),
);
?>

    <h1>Update Filedetails <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>