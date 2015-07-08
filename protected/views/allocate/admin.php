<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php $commodity = Commodity::model()->findByAttributes(array('id'=>$_GET['commodity_id'])); 
      $commodityName = $commodity['name'];
      $item = $commodityName::model()->findByAttributes(array('id'=>$_GET['itemId'])); 
      $itemName = $item['name'];
?>
<?php
/* @var $this AllocateController */
/* @var $model Allocate */


$this->breadcrumbs=array(
        ucfirst($commodityName)=>array("$commodityName/admin"),
        'Manage'=>array("$commodityName/admin"),
	'Allocate History of '.$itemName
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

<h1>Allocate History : <span style="color:#B40431"><?php echo $itemName;?> </span>
<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn buttonDesign')); ?>
<?php //echo CHtml::link('List All','index',array('class'=>'btn-danger btn buttonDesign')); ?>

<?php $this->widget('application.extensions.print.printWidget', array(
                   'cssFile' => 'print.css',
                   //'printedElement' => '.TbGridView',
				   'printedElement' => '#allocate-grid',
				   'htmlOptions' => array(),
				   )); 
    ?>
<?php //echo CHtml::link('PDF','generatePdf',array('class'=>'btn btn-warning buttonDesign','style'=>'height:16px;color:black','title'=>'Save as PDF'));?>
<?php echo CHtml::link('<i class="icon-file"></i> <b>CSV</b>','#csv',array('class'=>'btn-success btn buttonDesign','style'=>'height:16px;','title'=>'Save as CSV')); ?>
</h1>
<?php $pageSize=Yii::app()->user->getState('pageSize',5); ?>


<?php $gridWidget= $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'allocate-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'template'=>'{pager}{summary}{items}',
	'columns'=>array(
		
		array('value'=>"'$itemName'",'header'=>'Item'),
                array(
                    'name'=>'date_in',
                    'header'=>'Date In',
                    'value'=>'Yii::app()->dateFormatter->format(Yii::app()->locale->getDateFormat("long"),
                                        CDateTimeParser::parse($data->date_in, "yyyy-mm-dd"))',
                    ),
                array(
                    'name'=>'date_out',
                    'header'=>'Date Out',
                    'value'=>'Yii::app()->dateFormatter->format(Yii::app()->locale->getDateFormat("long"),
                                        CDateTimeParser::parse($data->date_out, "yyyy-mm-dd"))',
                    ),
                array(
                    'name'=>'return_on',
                    'header'=>'Return On',
                    'value'=>'Yii::app()->dateFormatter->format(Yii::app()->locale->getDateFormat("long"),
                                        CDateTimeParser::parse($data->return_on, "yyyy-mm-dd"))',
                    ),
                //'stockname',
                array('name'=>'user.name','header'=>'By'),
                array('header'=>'To','value'=>'($data->user_group == "U")?$data->userto->name:$data->group->name'),
                //'purpose',
		//'comments',		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'header'=>CHtml::dropDownList('pageSize',$pageSize,array(5=>5,10=>10,25=>25,50=>50),array(
                    'style'=>'width:50px',
                    'onchange'=>"$.fn.yiiGridView.update('allocate-grid',{ data:{pageSize: $(this).val() }})",
                    
                )),
		),
                array(
        	//call the function 'renderButtons' from the current controller
        	'value'=>array($this,'renderButtons')
                ),

	),
)); ?>
<?php Yii::app()->clientScript->registerScript('initPageSize',<<<EOD
    $('.change-pagesize').live('change', function() {
        $.fn.yiiGridView.update('allocate-grid',{ data:{ pageSize: $(this).val() }})
    });
EOD
,CClientScript::POS_READY); 
$this->renderExportGridButton($gridWidget,'<i class="icon-file"></i> <b>CSV</b>',array('id'=>'csv','class'=>'btn-success btn buttonDesign pull-right','style'=>'height:16px;','title'=>'Save as CSV'));?>