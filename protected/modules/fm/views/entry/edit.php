<?php
/* @var $this EntryController */

$this->breadcrumbs=array(
	'Form',
	$form->FORM_NAME,
	'Create'
);

?>

<h1>Update <span style="color:#B40431"><?php echo $model->TITLE; ?></span></h1>

<?php if(Yii::app()->user->hasFlash('entryMessage')): ?>
<div class="success">
	<?php echo Yii::app()->user->getFlash('entryMessage'); ?>
</div>
<?php endif; ?>

<?php echo $this->renderPartial('_form', array('model'=>$model,'form_id'=>$form->FORM_ID)); ?>