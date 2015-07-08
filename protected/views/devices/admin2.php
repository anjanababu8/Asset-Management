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
/* @var $this DevicesController */
/* @var $model Devices */


$this->breadcrumbs=array(
	'Devices'=>array('admin'),
	'Manage',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#devices-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage <span style="color:#B40431">Devices</span></h1>
<?php
$this->widget('application.extensions.print.printWidget', array(                   
                   'cssFile' => 'print.css',
                   'printedElement'=>'#barcode',
                   )
                 
               ); 
?>

<?php 
echo "<br/><br/>";
/** Flash Messages with allocated ID's**/
foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div height:15px><span class="flash-' . $key . ' myFlash">' . $message . "</span></div>";    
}
Yii::app()->clientScript->registerScript(
    'myHideEffect',
    '$(".flash-success").animate({opacity: 1.0}, 4000).fadeOut("fast");',
    CClientScript::POS_READY
);
?>
<div id="barcode">    
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'devices-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                //array('value'=> '$data->stockname'),
                array('type' => 'raw', 
                    'value'=>'Common::getItemBarcode(array("itemId"=> $data->id, "barcode"=>$data->id,"commodity_id"=>10))'),    
	))) ?>
</div>

