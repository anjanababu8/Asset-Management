<?php
/* @var $this BlockeditemController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Blockeditems',
);

$this->menu=array(
	array('label'=>'Create Blockeditem','url'=>array('create')),
	array('label'=>'Manage Blockeditem','url'=>array('admin')),
);
?>

<h1>Blockeditems</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>