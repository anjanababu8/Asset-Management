<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this CurrencyController */
/* @var $model Currency */

$this->breadcrumbs=array(
	'Currencies'=>array('admin'),
	'Manage'=>array('admin'),
	'Create',
);
?>

<h1>Create <span style="color:#B40431">Currency</span></h1>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>