<?php
/* @var $this FormController */
/* @var $model Form */

$this->breadcrumbs=array(
	'Forms'=>array('index'),
	'Manage',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#form-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Dynamic <span style="color:#B40431">Forms</span></h1>
<?php echo CHtml::link('Create New Template','fm/forms/new',array('class'=>'btn-inverse btn buttonDesign')); ?>
<br/><br/>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'form-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'FORM_ID',
		//'TABLE_NAME',
		'FORM_NAME',
		//'BEGIN_DATE',
		//'END_DATE',
		array('name'=>'commodity.name','header'=>'Commodity'),
		/*
		'CREATED_BY',
		'LAST_MODIFIED_BY',
		'CREATED_DATE',
		'LAST_MODIFIED_DATE',
		*/
		array(
			'class'=>'CButtonColumn',
			'buttons'=>array(
				'view'=>array(
					'url'=>'$this->grid->controller->createUrl("view", array("form"=>$data->primaryKey))',
					'options'=>array('title'=>'View'),
				),
				'update'=>array(
					'url'=>'$this->grid->controller->createUrl("edit", array("form"=>$data->primaryKey))',
					'options'=>array('title'=>'Edit'),
				),
				'delete'=>array(
					'url'=>'$this->grid->controller->createUrl("delete", array("form"=>$data->primaryKey))',
					'options'=>array('title'=>'Delete'),
				)
			),
		),
             array(
        	//call the function 'renderButtons' from the current controller
        	'value'=>array($this,'manageButton')
                ),
                
))); ?>

