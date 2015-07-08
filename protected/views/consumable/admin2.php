<html>
    <style>
        .myFlash{
            color:#B40431;
            padding:10px;
            background:#F8E0E6;
            border-radius:15px;
            size: 13px;
        }
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>

<?php
/* @var $this ConsumableController */
/* @var $model Consumable */


$this->breadcrumbs=array(
	'Consumables'=>array('admin'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#consumable-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<h1><span style="color:#B40431"> Barcode</span> 
    
<?php     
$this->widget('application.extensions.print.printWidget', array(                   
                   'cssFile' => 'print.css',
                   'printedElement'=>'#barcode',
                   )
                 
               ); 
?>
</h1>

<div id="barcode">    
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'consumable-grid',
	'dataProvider'=>$model->search2(),
	'filter'=>$model,
	'columns'=>array(
                //array('value'=> '$data->stockname'),
                array('type' => 'raw', 
                    'value'=>'Common::getItemBarcode(array("itemId"=> $data->id, "barcode"=>"$data->id","commodity_id"=>$data->commodity_id))'),    
	))) ?>
</div>
