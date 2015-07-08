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
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#currency-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage <span style="color:#B40431">Currencies</span></h1>
<?php echo CHtml::link('<i class="icon-plus"></i>','create',array('class'=>'btn-warning btn buttonDesign','title'=>'Add '.ucfirst($this->id))); ?>
<?php $this->widget('application.extensions.print.printWidget', array(
                   'cssFile' => 'print.css',
                   //'printedElement' => '.TbGridView',
				   'printedElement' => '#currency-grid',
				   'htmlOptions' => array(),
				   )); 
    ?>
<?php echo CHtml::link('<i class="icon-file"></i> <b>PDF</b>','generatePdf',array('class'=>'btn btn-danger buttonDesign','style'=>'height:16px;','title'=>'Save as PDF'));?>
<?php echo CHtml::link('<i class="icon-file"></i> <b>CSV</b>','#csv',array('class'=>'btn-success btn buttonDesign','style'=>'height:16px;','title'=>'Save as CSV')); ?>

<?php $gridWidget= $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'currency-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>'striped bordered',
	'columns'=>array(
		'name',
		//'filename',
                array(
                        'header' => 'Image',
                       'name' => 'symbol',
                        'type' => 'raw',
                        'value' => 'CHtml::image(
                            Yii::app()->controller->createUrl(\'currency/loadImage\', array(\'id\'=>$data->id)),
                            "",
                            array("style" => "cursor: pointer;width:50px;height:50px",
                                  "onclick" => "javascript: txt = \'$data->symbol\';
                                                $(\'#jobDialog\').text(txt);
                                                $(\'#jobDialog\').dialog(\'open\');
                                                $(\'#jobDialog\').click(function() { $(this).dialog(\'close\'); });"
                                  )
                                                                        )'
                ),
                array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
        
)); ?>
<?php $this->renderExportGridButton($gridWidget,'<i class="icon-file"></i> <b>CSV</b>',array('id'=>'csv','class'=>'btn-success btn buttonDesign pull-right','style'=>'height:16px;','title'=>'Save as CSV'));?>
