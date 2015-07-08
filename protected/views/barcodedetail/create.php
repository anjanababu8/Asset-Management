<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this BarcodedetailController */
/* @var $model Barcodedetail */
?>

<?php
$this->breadcrumbs=array(
	'Barcodedetails'=>array('admin'),
	'Create',
);

?>

<h1>Set <span style="color:#B40431">Barcode Details</span></h1>
<?php echo "<br/>";?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>