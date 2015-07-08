<?php
/* @var $this EntryController */

$this->breadcrumbs=array(
	'Form',
	$form->FORM_NAME,
);
?>

<h1><?php echo $form->FORM_NAME.' (Entry #'.$model->ID.')'; ?></h1>

<?php if(Yii::app()->user->hasFlash('entryMessage')): ?>
<div class="success">
	<?php echo Yii::app()->user->getFlash('entryMessage'); ?>
</div>
<?php endif; ?>
<table class="dataGrid">
	<?php 
		if ($fields) {
			foreach($fields as $field) {
			?>
	<tr>
		<th class="label"><?php //echo CHtml::encode($field->TITLE); ?></th>
		<th class="label"><?php echo CHtml::checkBox($field->TITLE); ?></th>
    	<td>
			<?php //echo (($model->{$field->VARNAME})?$model->{$field->VARNAME}:''); ?>
		</td>
	</tr>
			<?php
			}
		}
	?>
	<tr>
		<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('CREATED_BY')); ?></th>
    	<td><?php //echo CHtml::encode($model->CREATED_BY); ?></td>
	</tr>
	<tr>
		<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('LAST_MODIFIED_BY')); ?></th>
    	<td><?php //echo CHtml::encode($model->LAST_MODIFIED_BY); ?></td>
	</tr>
	<tr>
		<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('CREATED_DATE')); ?></th>
    	<td><?php //echo CHtml::encode($model->CREATED_DATE); ?></td>
	</tr>
	<tr>
		<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('LAST_MODIFIED_DATE')); ?></th>
    	<td><?php //echo CHtml::encode($model->LAST_MODIFIED_DATE); ?></td>
	</tr>
</table>
