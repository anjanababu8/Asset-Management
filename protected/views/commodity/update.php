<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this CommodityController */
/* @var $model Commodity */
?>

<?php
$this->breadcrumbs=array(
	'Commodities'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Update Commodity <span style="color:#B40431"><?php echo $model->name; ?></span></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>