<?php
/* @var $this BarcodedetailController */
/* @var $model Barcodedetail */
?>

<?php
$this->breadcrumbs=array(
	'Barcodedetails'=>array('index'),
	$model->id,
);

?>

<h1>View Barcodedetail #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'organisation_id',
		'bar_width',
		'bar_height',
		'type',
		'format',
	),
)); ?>