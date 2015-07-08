<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this ConsumabletypeController */
/* @var $model Consumabletype */
?>

<?php
$this->breadcrumbs=array(
	'Consumabletypes'=>array('admin'),
	'Create',
);
?>

<h1>Create <span style="color:#B40431">Consumabletype</span></h1>
<?php echo "<br/>";?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>