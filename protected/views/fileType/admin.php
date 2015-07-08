<?php
/* @var $this FileTypeController */
/* @var $model FileType */


$this->breadcrumbs=array(
	'File Types'=>array('admin'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#file-type-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage <span style="color:#B40431">File Types</span></h1>
<?php echo CHtml::link('Add File Type','create',array('class'=>'btn-inverse btn buttonDesign')); ?> 

<?php $this->widget('application.extensions.print.printWidget', array(
                   'cssFile' => 'print.css',
                   //'printedElement' => '.TbGridView',
				   'printedElement' => '#file-type-grid',
				   'htmlOptions' => array(),
				   )); 
    ?>
<?php $gridWidget= $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'file-type-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'name',
		'label_width',
		'label_height',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
<?php	echo CHtml::link('save as pdf','generatePdf',array('class'=>'btn-inverse btn buttonDesign pull-right'));?>
	<?php $this->renderExportGridButton($gridWidget,'Export Grid Results',array('class'=>'btn btn-info pull-right'));?>