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

<h1>Manage <span style="color:#B40431">Consumables</span></h1>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn buttonDesign')); ?>
<?php //echo CHtml::link('List All','index',array('class'=>'btn-danger btn buttonDesign')); ?>
<?php echo CHtml::link('Add Consumable','create',array('class'=>'btn-inverse btn buttonDesign')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

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

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'consumable-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered',
	'filter'=>$model,
	'template'=>'{summary}{items}{pager}',
	'columns'=>array(     
                //call the function 'renderButtons' from the current controller
		'name',
		array('name'=>'location.name','header'=>'Location'),
                array('name'=>'commodity.name','header'=>'Commodity'),
                array('name'=>'category.name','header'=>'Category'),
		array('name'=>'user.name','header'=>'Technical Incharge'),
		array('name'=>'status.status','header'=>'Status'),
		array('name'=>'manufacturer.name','header'=>'Manufacturer'),
		array('name'=>'consumabletype.name','header'=>'Consumable Type'),
		array('name'=>'managementtype.name','header'=>'Management Type'),
		//'model',
		'threshold',
                'image',
		//'imageFileName',
		//'documentFileName',
		'enable_financial',
		'available_on_loan',
		'semi_consumable',
                array('class'=>'bootstrap.widgets.TbButtonColumn'),
		array('value'=>array($this,'renderButtons')),
))); ?>