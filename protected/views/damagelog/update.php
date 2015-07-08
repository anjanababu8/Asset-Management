<?php
/* @var $this DamagelogController */
/* @var $model Damagelog */
?>

<?php
$this->breadcrumbs=array(
	'Damagelogs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Damagelog', 'url'=>array('index')),
	array('label'=>'Create Damagelog', 'url'=>array('create')),
	array('label'=>'View Damagelog', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Damagelog', 'url'=>array('admin')),
);
?>

    <h1>Update Damagelog <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>