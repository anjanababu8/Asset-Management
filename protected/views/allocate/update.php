<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this AllocateController */
/* @var $model Allocate */
?>

<?php $commodity = Commodity::model()->findByAttributes(array('id'=>$_GET['commodity_id'])); 
      $commodityName = $commodity['name'];
      $row = $commodityName::model()->findByAttributes(array('id'=>$model->cons_id));
?>
<?php
$this->breadcrumbs=array(
        ucfirst($commodityName)=>array("$commodityName/admin"),
        'Manage'=>array("$commodityName/admin"),
	'Allocate'
);

?>


<h1>Allocate <span style="color:#B40431"><?php echo $row['name']; ?></span></h1>
<?php //echo CHtml::link('List All','http://localhost/asset_management/index.php/allocate/index',array('class'=>'btn-danger btn buttonDesign')); ?>
<?php //echo CHtml::link('View '.$model->name,array('view', 'id'=>$model->id),array('class'=>'btn-danger btn buttonDesign')); ?>
<?php //echo CHtml::link('Manage All','http://localhost/asset_management/index.php/allocate/admin',array('class'=>'btn-inverse btn buttonDesign')); ?>
<?php //echo "<br/><br/>";?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>