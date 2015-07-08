<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this ConsumableController */
/* @var $model Consumable */
?>

<?php
$this->breadcrumbs=array(
        'Consumable'=>array('admin'),
        'Manage'=>array('admin'),
	'Update '.$model->name,
);
?>
<?php $commodityId = Commodity::model()->find('name =:name',array('name'=>$this->id));?>
<h1>Update Consumable <span style="color:#B40431"><?php echo $model->name; ?></span></h1>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>