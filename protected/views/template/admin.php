<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this TemplateController */
/* @var $model Template */


$this->breadcrumbs=array(
	'Templates'=>array('admin'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#template-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $commodity = Commodity::model()->findByPk($_GET['commodityId']);
      $commodity->template = 'static';
      $commodity->update();

?>
<h1>Manage <span style="color:#B40431">Templates</span></h1>


 <?php $this->widget('application.extensions.print.printWidget', array(
                   'cssFile' => 'print.css',
                   //'printedElement' => '.TbGridView',
				   'printedElement' => '#template-grid',
				   'htmlOptions' => array(),
				   )); 
    ?>

<?php $gridWidget= $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'template-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array( 
                
                'name',
                array('name'=>'organisation.name','header'=>'Organisation'),
		'description',
		'date_created',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
                 array(
        	//call the function 'renderButtons' from the current controller
        	'value'=>array($this,'renderButtons')
                ),
                array(
                        'header' => 'Image',
                       'name' => 'path',
                        'type' => 'raw',
                        'value' => 'CHtml::image(
                            Yii::app()->request->baseUrl . "/images/templates/name.png",
                            "",
                            array("style" => "cursor: pointer;width:400px;height:200px",
                                  "onclick" => "javascript: txt = \'$data->path\';
                                                $(\'#jobDialog\').text(txt);
                                                $(\'#jobDialog\').dialog(\'open\');
                                                $(\'#jobDialog\').click(function() { $(this).dialog(\'close\'); });"
                                  )
                                                                        )'
                ),
	),
)); ?>
<?php	echo CHtml::link('save as pdf','generatePdf',array('class'=>'btn-inverse btn buttonDesign pull-right'));?>
	<?php $this->renderExportGridButton($gridWidget,'Export Grid Results',array('class'=>'btn btn-info pull-right'));?>