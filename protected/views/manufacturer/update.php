<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this ManufacturerController */
/* @var $model Manufacturer */
?>

<?php
$this->breadcrumbs=array(
	'Manufacturers'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

?>

<h1>Update Manufacturer <span style="color:#B40431"><?php echo $model->name; ?></span></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>