<?php
/* @var $this FormController */
/* @var $model Form */

$this->breadcrumbs=array(
	'Forms'=>array('index'),
	$model->FORM_NAME,
);


?>

<h1><span style="color:#B40431"><?php echo $model->FORM_NAME; ?></span> Details</h1>

<?php //echo $this->renderPartial('_view', array('data'=>$model)); ?>
<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'FORM_ID',
		'TABLE_NAME',
		'FORM_NAME',
		'BEGIN_DATE',
                'END_DATE',
                array('name'=>'commodity.name','label'=>'Commodity'),
                'CREATED_BY',
                'LAST_MODIFIED_BY',
                'CREATED_DATE',
                'LAST_MODIFIED_DATE',
	),
)); ?>