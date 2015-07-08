<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this MonitorController */
/* @var $model Monitor */
?>

<?php
$this->breadcrumbs=array(
	'Devices'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);?>

<?php $commodityId = Commodity::model()->find('name =:name',array('name'=>$this->id));?>
<h1>Update Devices <span style="color:#B40431"><?php echo $model->name; ?></span></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>