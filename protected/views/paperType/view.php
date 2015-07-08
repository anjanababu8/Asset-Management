<?php
/* @var $this PaperTypeController */
/* @var $model PaperType */
?>

<?php
$this->breadcrumbs=array(
	'Paper Types'=>array('admin'),
	$model->name,
);

?>

<h1>View <span style="color:#B40431"><?php echo $model->name; ?></span></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'name',
		'width',
		'height',
	),
)); ?>