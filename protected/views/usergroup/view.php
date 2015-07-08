<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this UsergroupController */
/* @var $model Usergroup */
?>

<?php
$this->breadcrumbs=array(
	'Usergroups'=>array('admin'),
	$model->id,
);
?>

<h1>View Usergroup #<?php echo $model->id; ?></h1>


<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'uid',
		'gid',
	),
)); ?>