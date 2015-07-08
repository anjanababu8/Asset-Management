<?php
/* @var $this ReportController */
/* @var $model Report */
?>

<?php
$this->breadcrumbs=array(
	'Reports'=>array('index'),
	$model->name=>array('view','id'=>$model->rid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Report', 'url'=>array('index')),
	array('label'=>'Create Report', 'url'=>array('create')),
	array('label'=>'View Report', 'url'=>array('view', 'id'=>$model->rid)),
	array('label'=>'Manage Report', 'url'=>array('admin')),
);
?>

    <h1>Update Report <?php echo $model->rid; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>