<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this ConsumablestockController */
/* @var $model Consumablestock */
?>

<?php $commodity = Commodity::model()->findByAttributes(array('id'=>$_GET['commodity_id'])); 
      $commodityName = $commodity['name'];
?>
<?php
$this->breadcrumbs=array(
        ucfirst($commodityName)=>array("$commodityName/admin"),
        'Manage'=>array("$commodityName/admin"),
	'Add to Stock',
);
?>

<h1>Add to <span style="color:#B40431">Stock</span></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>