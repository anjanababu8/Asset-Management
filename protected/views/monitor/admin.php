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
/* @var $this MonitorController */
/* @var $model Monitor */


$this->breadcrumbs=array(
	'Monitors'=>array('admin'),
	'Manage',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#monitor-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage <span style="color:#B40431">Monitors</span></h1>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn buttonDesign')); ?>
<?php //echo CHtml::link('List All','index',array('class'=>'btn-danger btn buttonDesign')); ?>
<?php $commodityId = Commodity::model()->find('name =:name',array('name'=>$this->id));?>
<?php echo CHtml::link('<i class="icon-ban-circle"></i>',Yii::app()->homeUrl.'/blockeditem/admin?commodityId='.$commodityId['id'],array('class'=>'btn-danger btn buttonDesign','title'=>'View Blocked '.ucfirst($this->id))); ?>
<?php echo CHtml::link('<i class="icon-plus"></i>',array('create','commodity_id'=>$commodityId['id']),array('class'=>'btn-warning btn buttonDesign','title'=>'Add '.ucfirst($this->id))); ?>
<?php echo CHtml::link('<i class="icon-barcode"></i>',Yii::app()->homeUrl.'/monitor/admin2',array('class'=>'btn-warning btn buttonDesign','title'=>'Get Barcode')); ?>
<?php $this->widget('application.extensions.print.printWidget', array(
                   'cssFile' => 'print.css',
                    'printedElement' => '#monitor-grid',
                    'htmlOptions' => array(),
                    )); 
    ?> 
<?php echo CHtml::link('<i class="icon-file"></i> <b>PDF</b>','generatePdf',array('class'=>'btn btn-danger buttonDesign','style'=>'height:16px;','title'=>'Save as PDF'));?>
<?php echo CHtml::link('<i class="icon-file"></i> <b>CSV</b>','#csv',array('class'=>'btn-success btn buttonDesign','style'=>'height:16px;','title'=>'Save as CSV')); 
 
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
	'id'=>'monitor-grid',
	'type'=>'striped bordered',
	//'template'=>'{summary}{items}{pager}',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		
		//'name',
		array(
      'name' => 'name',
      'type' => 'raw',
      'value' => 'CHtml::link($data->name,array("/monitor/view","id"=>$data->id))',
	  
    ),
		array(
                        'header' => 'Image',
                       'name' => 'image',
                        'type' => 'raw',
                        'value' => 'CHtml::image(
                            Yii::app()->controller->createUrl(\'monitor/loadImage\', array(\'id\'=>$data->id)),
                            "",
                            array("style" => "cursor: pointer;width:75px;height:75px",
                                  "onclick" => "javascript: txt = \'$data->image\';
                                                $(\'#jobDialog\').text(txt);
                                                $(\'#jobDialog\').dialog(\'open\');
                                                $(\'#jobDialog\').click(function() { $(this).dialog(\'close\'); });"
                                  )
                                                                        )'
                ),
		//'location_id',
		'category_id',
		//array('name'=>'location.name','header'=>'Location'),
		array('name' => 'location_id',
            'filter' => CHtml::listData(Location::model()->findAll(), 'id', 'name'), // fields from country table
            'value' => 'Location::Model()->FindByPk($data->location_id)->name',),
        //array('name'=>'commodity.name','header'=>'Commodity'),
		//array('name'=>'user.name','header'=>'Technical Incharge'),
		//array('name'=>'status.status','header'=>'Status'),
		//array('name'=>'manufacturer.name','header'=>'Manufacturer'),
		//array('name'=>'monitortype.name','header'=>'Monitor Type'),
		//array('name'=>'managementtype.name','header'=>'Management Type'),
		//'technical_incharge_id',
		//'size',
		//'status_id',
		
		//'monitor_type_id',
		//'manufacturer_id',
		//'serial_number',
		//'management_type_id',
		//'comments',
		//'document',
		//'documentFileName',
		//'documentFileType',
		//'image',
		//'imageFileName',
		//'imageFileType',
		//'enable_financial',
		//'available_on_loan',
		array('header'=>'Available Quantity','value'=>array($this,'getAvailableQuantity')),
                array('value'=>array($this,'renderButtons')),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'header'=>'<code>Rows/Page</code>'.CHtml::dropDownList('pageSize',$pageSize,array(5=>5,10=>10,25=>25,50=>50),array(
                    'style'=>'width:50px',
                    'onchange'=>"$.fn.yiiGridView.update('monitor-grid',{ data:{pageSize: $(this).val() }})",
                    
                ))),
		
	))); ?>

	
<?php $this->renderExportGridButton($gridWidget,'<i class="icon-file"></i> <b>CSV</b>',array('id'=>'csv','class'=>'btn-success btn buttonDesign pull-right','style'=>'height:16px;','title'=>'Save as CSV'));?>	
	