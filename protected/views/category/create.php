<?php
/* @var $this CategoryController */
/* @var $model Category */
?>

<?php
$this->breadcrumbs=array(
	'Categories'=>array('admin'),
	'Create',
);
?>

<h1>Create <span style="color:#B40431">Category</span></h1>
<?php //echo CHtml::link('List All','index',array('class'=>'btn-danger btn buttonDesign')); ?>
<?php //echo CHtml::link('Manage All','admin',array('class'=>'btn-inverse btn buttonDesign')); ?>
<?php echo "<br/>";?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>