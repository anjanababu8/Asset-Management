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


$this->breadcrumbs=array(
	'Allocates'=>array('admin'),
	'Manage',
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#allocate-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $row = Consumable::model()->findByAttributes(array('id'=>$_GET['itemId']));?>
<h1> Stock <span style="color:#B40431"> <?php echo $row['name']?></span> Barcode <?php 
    $this->widget('application.extensions.print.printWidget', array(                   
                   'cssFile' => 'print.css',
                   'printedElement'=>'#barcode',
                   )
                 
               ); 
?>
</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<div id="barcode"
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'allocate-grid',
	'dataProvider'=>$model->searchPrintBarcode(),
	'filter'=>$model,
	'columns'=>array(
                //array('value'=> '$data->stockname'),
                array('type' => 'raw', 
                    'value'=>'Common::getItemBarcode(array("itemId"=> $data->allocate_id, "barcode"=>$data->stockname))'),
               
	),
)); ?>
</div>
