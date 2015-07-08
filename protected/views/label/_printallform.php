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

    <h1>Print <span style="color:#B40431">Label</span></h1>
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
    <table>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'paper',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->dropDownList($model,'paper',CHtml::listData(PaperType::model()->findAll(),'id','name'));?></div>    
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'fileType',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->dropDownList($model,'fileType',CHtml::listData(FileType::model()->findAll(),'id','name'),array(
                                            'prompt'=>'---',    
                                            'ajax' => array(
                                            'type'=>'POST',
                                            'id'=>'drop_selection',
                                            'url'=>CController::createUrl('dynamicrows2'), //url to call.
                                            'update'=>'#details', //selector to update
                                            'data'=>array('selection'=>'js:this.value'), 
                                        )));?></div>  
                    <div class="span2" id="details"><span class="label label-info"> Default : Label Size:100px X 50px</span></div>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'depts',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->dropDownList($model,'depts',CHtml::listData(Dept::model()->findAllByAttributes(array('orgid'=>Yii::app()->user->getState("org_id"))),'id','name'),
                                        array(
                                            'prompt'=>'--- Select Department ---',
                                            'ajax' => array(
                                                'type'=>'POST',
                                                'id'=>'drop_selection',
                                                'url'=>CController::createUrl('dynamicrows'), //url to call.
                                                'update'=>'#Label_fileNames', //selector to update
                                                'data'=>array('selection'=>'js:this.value'), 
                                                )));?> </div>
                    <div class="span2"><span class="label label-info"> Default : All Departments Selected</span></div>
                </div>
            </div>
        </tr>
        <br/>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'fileNames',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo Select2::activeMultiSelect($model, 'fileNames', array(), array(
				        //'required' => 'required',
				        'select2Options' => array(
                                          'width'=>'85%',
				          'placeholder' => '--- Select File Names ---',
                                            )));?></div>
                    <div class="span2"><span class="label label-info"> Default : All Files Selected</span></div>
                </div>
            </div>
        </tr>
        <br/>
    </table>
    
    
	
    <div style="text-align: center;">
    <?php echo CHtml::submitButton('Print',array('submit' => array('label/showLabel')),array(
                'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
                'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
            )); ?>
    </div>
    
    <?php $this->endWidget(); ?>

</div><!-- form -->