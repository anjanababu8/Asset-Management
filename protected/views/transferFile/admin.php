<?php
/* @var $this TransferFileController */
/* @var $model TransferFile */


$this->breadcrumbs=array(
	'Transfer Files'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TransferFile', 'url'=>array('index')),
	array('label'=>'Create TransferFile', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#transfer-file-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Transfer Files</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
        &lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
 <?php $this->widget('application.extensions.print.printWidget', array(
                   'cssFile' => 'print.css',
                   //'printedElement' => '.TbGridView',
				   'printedElement' => '#transfer-file-grid',
				   'htmlOptions' => array(),
				   )); 
    ?>

<?php $gridWidget= $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'transfer-file-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'fid',
		'ownedby',
		'transfer_to',
		'previous_location',
		'transfer_location',
		/*
		'Remark',
		'timestamp',
		'uid',
		'transfer_date',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
<?php	echo CHtml::link('save as pdf','generatePdf',array('class'=>'btn-inverse btn buttonDesign pull-right'));?>
	<?php $this->renderExportGridButton($gridWidget,'Export Grid Results',array('class'=>'btn btn-info pull-right'));?>