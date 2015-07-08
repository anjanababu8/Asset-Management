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
/* @var $this CartridgeController */
/* @var $model Cartridge */


$this->breadcrumbs=array(
	'Cartridges'=>array('admin'),
	'Manage',
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cartridge-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage <span style="color:#B40431">Cartridges</span></h1>

<?php $commodityId = Commodity::model()->find('name =:name',array('name'=>$this->id));?>
<?php echo CHtml::link('<i class="icon-ban-circle"></i>',Yii::app()->homeUrl.'/blockeditem/admin?commodityId='.$commodityId['id'],array('class'=>'btn-danger btn buttonDesign','title'=>'View Blocked '.ucfirst($this->id))); ?>
<?php echo CHtml::link('<i class="icon-plus"></i>',array('create','commodity_id'=>$commodityId['id']),array('class'=>'btn-warning btn buttonDesign','title'=>'Add '.ucfirst($this->id))); ?>
<?php echo CHtml::link('<i class="icon-barcode"></i>',Yii::app()->homeUrl.'/cartridge/admin2',array('class'=>'btn-warning btn buttonDesign','title'=>'Get Barcode')); ?>
<?php $this->widget('application.extensions.print.printWidget', array(
                   'cssFile' => 'print.css',
                    'printedElement' => '#cartridge-grid',
                    'htmlOptions' => array(),
                    )); 
    ?>
<?php echo CHtml::link('<i class="icon-file"></i> <b>PDF</b>','generatePdf',array('class'=>'btn btn-danger buttonDesign','style'=>'height:16px;','title'=>'Save as PDF'));?>
<?php echo CHtml::link('<i class="icon-file"></i> <b>CSV</b>','#csv',array('class'=>'btn-success btn buttonDesign','style'=>'height:16px;','title'=>'Save as CSV')); ?>
    
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

<?php $pageSize=Yii::app()->user->getState('pageSize',5); ?>
<?php $gridWidget=$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'cartridge-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered',
	'filter'=>$model,
	'template'=>'{summary}{items}{pager}',
	'columns'=>array(     
                //call the function 'renderButtons' from the current controller
array(
      'name' => 'name',
      'type' => 'raw',
      'value' => 'CHtml::link($data->name,array("/cartridge/view","id"=>$data->id))',
	  
    ),
		array(
                        'header' => 'Image',
                       'name' => 'image',
                        'type' => 'raw',
                        'value' => 'CHtml::image(
                            Yii::app()->controller->createUrl(\'cartridge/loadImage\', array(\'id\'=>$data->id)),
                            "",
                            array("style" => "cursor: pointer;width:75px;height:75px",
                                  "onclick" => "javascript: txt = \'$data->image\';
                                                $(\'#jobDialog\').text(txt);
                                                $(\'#jobDialog\').dialog(\'open\');
                                                $(\'#jobDialog\').click(function() { $(this).dialog(\'close\'); });"
                                  )
                                                                        )'
                ),
		array('name' => 'location_id',
				
            'filter' => CHtml::listData(Location::model()->findAll(), 'id', 'name'), 
            'value' => 'Location::Model()->FindByPk($data->location_id)->name',),
                //array('name'=>'commodity.name','header'=>'Commodity'),
                'category_id',
                //array('name'=>'category.name','header'=>'Category'),
		//array('name'=>'user.name','header'=>'Technical Incharge'),
		//array('name'=>'status.status','header'=>'Status'),
		//array('name'=>'manufacturer.name','header'=>'Manufacturer'),
		//array('name'=>'consumabletype.name','header'=>'Consumable Type'),
		//array('name'=>'managementtype.name','header'=>'Management Type'),
		//'model',
		//'threshold',
		//'imageFileName',
		//'documentFileName',
		//'enable_financial',
		//'available_on_loan',
		//'semi_consumable',
                array('header'=>'Available Quantity','value'=>array($this,'getAvailableQuantity')),
		array('value'=>array($this,'renderButtons')),
                array('class'=>'bootstrap.widgets.TbButtonColumn',
                    'header'=>'<code>Rows/Page</code>'.CHtml::dropDownList('pageSize',$pageSize,array(5=>5,10=>10,25=>25,50=>50),array(
                    'style'=>'width:50px',
                    'onchange'=>"$.fn.yiiGridView.update('cartridge-grid',{ data:{pageSize: $(this).val() }})",
                    
                )),),
))); ?>
<?php $this->renderExportGridButton($gridWidget,'<i class="icon-file"></i> <b>CSV</b>',array('id'=>'csv','class'=>'btn-success btn buttonDesign pull-right','style'=>'height:16px;','title'=>'Save as CSV'));?>