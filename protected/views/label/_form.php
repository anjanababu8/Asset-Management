<html>
<style>
.inline-labels{
    display:inline-block;
    padding:10px;
}
</style>
</html>
<?php
/* @var $this LabelController */
/* @var $model Label */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'label-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
	
	<?php
	$temp=$_GET['formId'];
	$connection=Yii::app()->db;
			$sql = "
			select TITLE 
			from form_fields 
			where FORM_ID =$temp";
			$command = $connection->createCommand($sql);
			$dataReader = $command->queryAll();
			//$row=$dataReader->read();
	
			//print_r($dataReader);die;
			$newArray = array();
			
			foreach($dataReader as $row) { 
				$newArray[$row['TITLE']] = $row['TITLE']; 
			}
			//print_r($newArray);die;
			
	?>

            <?php echo $form->checkBoxList($model,'fields',$newArray); ?>
	
           

         <table>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'size',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->dropDownList($model,'size',array(1=>'A3',2=>'A4'));?>
                                                       
                    </div> 
            </div>
            </div>
        </tr>
 </table>

    <div style="text-align: center;">
    <?php echo TbHtml::submitButton($model->isNewRecord ? 'Submit' : 'Allocate',array(
        'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
        'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
        )); ?>
    <?php echo TbHtml::button('Cancel',array(
            'color' => TbHtml::BUTTON_COLOR_DANGER,
            'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
            'onclick' => 'history.go(-1)'
    ));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->