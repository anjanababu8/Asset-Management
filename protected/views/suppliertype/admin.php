<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this SuppliertypeController */
/* @var $model Suppliertype */


$this->breadcrumbs=array(
	'Suppliertypes'=>array('admin'),
	'Manage',
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#suppliertype-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage <span style="color:#B40431">Suppliertypes</span></h1>
<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn buttonDesign')); ?>
<?php //echo CHtml::link('List All','index',array('class'=>'btn-danger btn buttonDesign')); ?>
<?php echo CHtml::link('Add Suppliertype','create',array('class'=>'btn-inverse btn buttonDesign')); ?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
 <?php $this->widget('application.extensions.print.printWidget', array(
                   'cssFile' => 'print.css',
                   //'printedElement' => '.TbGridView',
				   'printedElement' => '#suppliertype-grid',
				   'htmlOptions' => array(),
				   )); 
    ?>

<?php echo '<br/><br/>';?>
<?php $gridWidget= $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'suppliertype-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered',
	'filter'=>$model,
	'columns'=>array(
		'name',
		'comment',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
<?php	echo CHtml::link('save as pdf','generatePdf',array('class'=>'btn-inverse btn buttonDesign pull-right'));?>
	<?php $this->renderExportGridButton($gridWidget,'Export Grid Results',array('class'=>'btn btn-info pull-right'));?>