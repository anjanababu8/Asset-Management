<?php
/* @var $this FileTypeController */
/* @var $model FileType */
?>

<?php
$this->breadcrumbs=array(
	'File Types'=>array('admin'),
	$model->name,
);
?>

<h1>View FileType <span style="color:#B40431"><?php echo $model->name; ?></span></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'name',
		'label_width',
		'label_height',
	),
)); ?>