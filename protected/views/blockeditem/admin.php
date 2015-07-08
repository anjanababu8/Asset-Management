<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this BlockeditemController */
/* @var $model Blockeditem */


$commodity = Commodity::model()->findByPk($_GET['commodityId']);
$commodityName = $commodity['name'];
$this->breadcrumbs=array(
        ucfirst($commodityName)=>array("$commodityName/admin"),
	'Manage'=>array("$commodityName/admin"),
	'Blocked Items',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#blockeditem-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage <span style="color:#B40431">Blockeditems</span></h1>

 <?php  $this->widget('application.extensions.print.printWidget', array(
                   'cssFile' => 'print.css',
                   //'printedElement' => '.TbGridView',
				   'printedElement' => '#blockeditem-grid',
				   'htmlOptions' => array(),
				   )); 
  ?>
 <?php echo CHtml::link('<i class="icon-file"></i> <b>PDF</b>','generatePdf',array('class'=>'btn btn-danger buttonDesign','style'=>'height:16px;','title'=>'Save as PDF'));?>
<?php echo CHtml::link('<i class="icon-file"></i> <b>CSV</b>','#csv',array('class'=>'btn-success btn buttonDesign','style'=>'height:16px;','title'=>'Save as CSV')); ?>
   
<?php $gridWidget=$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'blockeditem-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//array('name'=>'commodity.name','header'=>'Commodity'),
		'item_name',
		array('name'=>'userby.name','header'=>'Blocked By'),
                array(
                    'name'=>'blocked_on',
                    'header'=>'Blocked On',
                    'value'=>'Yii::app()->dateFormatter->format(Yii::app()->locale->getDateFormat("long"),
                                        CDateTimeParser::parse($data->blocked_on, "yyyy-mm-dd"))',
                    ),
                array(
                    'name'=>'blocked_from',
                    'header'=>'Blocked From',
                    'value'=>'Yii::app()->dateFormatter->format(Yii::app()->locale->getDateFormat("long"),
                                        CDateTimeParser::parse($data->blocked_from, "yyyy-mm-dd"))',
                    ),
                array(
                    'name'=>'blocked_to',
                    'header'=>'Blocked To',
                    'value'=>'Yii::app()->dateFormatter->format(Yii::app()->locale->getDateFormat("long"),
                                        CDateTimeParser::parse($data->blocked_to, "yyyy-mm-dd"))',
                    ),    
		//'unblock_by',
		//'unblock_on',
                array('header'=>'Blocked For','value'=>'($data->flag == "U")?$data->user->name:($data->flag == "G"?$data->group->name:"FOR ALL")'),
		
		//'flag',
		
                array(
        	//call the function 'renderButtons' from the current controller
        	'value'=>array($this,'renderButtonModify')
                ), 
                array(
        	//call the function 'renderButtons' from the current controller
        	'value'=>array($this,'renderButtonUnBlock')
                ),
	),
)); ?>
<?php $this->renderExportGridButton($gridWidget,'<i class="icon-file"></i> <b>CSV</b>',array('id'=>'csv','class'=>'btn-success btn buttonDesign pull-right','style'=>'height:16px;','title'=>'Save as CSV'));?>