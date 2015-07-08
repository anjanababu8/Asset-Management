<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this TransferConsController */
/* @var $model TransferCons */
?>

<?php $commodity = Commodity::model()->findByAttributes(array('id'=>$_GET['commodity_id'])); 
      $commodityName = $commodity['name'];
?>
<?php
$this->breadcrumbs=array(
	ucfirst($commodityName)=>array("$commodityName/admin"),
        'Manage'=>array("$commodityName/admin"),
	'Tranfer Item'
);

?>

<h1>Transfer <span style="color:#B40431"><?php echo ucfirst($commodityName);?></span></h1>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>