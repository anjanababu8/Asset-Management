<?php
/* @var $this FiledetailsController */
/* @var $model Filedetails */


$this->breadcrumbs=array(
	'Filedetails'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Filedetails', 'url'=>array('index')),
	array('label'=>'Create Filedetails', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#filedetails-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Filedetails</h1>
<h3>File name :  </h3>
<?php 
$temp=$_GET['itemId'];
$connection=Yii::app()->db;
			$sql = "
			select * 
			from fopen 
			where id =$temp";
			$command = $connection->createCommand($sql);
			$dataReader = $command->query();

			$row=$dataReader->read();	
			echo $row['TITLE'];
?>
<br>
<h3>File code :  </h3>
<?php
echo $row['CODE'];
?>



</div><!-- search-form -->
<?php $this->widget('application.extensions.print.printWidget', array(
                   'cssFile' => 'print.css',
                   //'printedElement' => '.TbGridView',
				   'printedElement' => '#filedetails-grid',
				   'htmlOptions' => array(),
				   )); 
    ?>

<?php $gridWidget=$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'filedetails-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'fid',
		'content',
		'updatedon',
		'updatedby',
		'remark',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<?php //$fId = Filedetails::model()->find('id =:id',array('name'=>$this->id));?>
<?php echo CHtml::link('Close/Seal File',Yii::app()->homeUrl.'/fclose/create?itemId='.$_GET['itemId'],array('class'=>'btn-danger btn buttonDesign')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
<?php	echo CHtml::link('save as pdf','generatePdf',array('class'=>'btn-inverse btn buttonDesign pull-right'));?>
	<?php $this->renderExportGridButton($gridWidget,'Export Grid Results',array('class'=>'btn btn-info pull-right'));?>