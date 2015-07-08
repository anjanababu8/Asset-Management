<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this CategoryController */
/* @var $model Category */
?>

<?php
$this->breadcrumbs=array(
	'Categories'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Update Category <span style="color:#B40431"><?php echo $model->name; ?></span></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>