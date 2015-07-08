<html>
<style>
.inline-labels{
    display:inline-block;
    padding:10px;
}
</style>
</html>

<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
    <?php echo $form->hiddenField($model,'active',array('span'=>2));?>

    <table>
        <tr>
    	<div class="row">
	    	<div class="col-md-3 col-sm-6">
	            <div class="span2"><?php echo $form->labelEx($model,'fn',array('class'=>'inline-labels'));?></div>
	            <div class="span3"><?php echo $form->textField($model,'fn',array('span'=>2,'placeHolder'=>'First Name'));?></div>
                    <div class="span2"><?php echo $form->labelEx($model,'ln',array('class'=>'inline-labels'));?></div>
	            <div class="span3"><?php echo $form->textField($model,'ln',array('span'=>2,'placeHolder'=>'Last Name'));?></div>
	        </div>
	    </div>
	</tr>
        <tr>
    	<div class="row">
	    	<div class="col-md-3 col-sm-6">
	            <div class="span2"><?php echo $form->labelEx($model,'name',array('class'=>'inline-labels'));?></div>
	            <div class="span3"><?php echo $form->textField($model,'name',array('span'=>2,'maxlength'=>50,'placeHolder'=>'Username'));?></div>
	            <div class="span2"><?php echo $form->labelEx($model,'password',array('class'=>'inline-labels'));?></div>
	            <div class="span3"><?php echo $form->passwordField($model,'password',array('span'=>2,'maxlength'=>50,'placeHolder'=>'Password'));?></div>
	        </div>
	    </div>
	    </tr>
	    <tr>
    	<div class="row">
	    	<div class="col-md-3 col-sm-6">
	            <div class="span2"><?php echo $form->labelEx($model,'email',array('class'=>'inline-labels'));?></div>
	            <div class="span3"><?php echo $form->textField($model,'email',array('span'=>2,'maxlength'=>50,'placeHolder'=>'Email'));?></div>
                    <div class="span2"><?php echo $form->labelEx($model,'mobile',array('class'=>'inline-labels'));?></div>
	            <div class="span3"><?php echo $form->textField($model,'mobile',array('span'=>2,'maxlength'=>10,'placeHolder'=>'Mobile No.'));?></div>
	            
                </div>
	    </div>
	    </tr>
	    <tr>
    	<div class="row">
	    	<div class="col-md-3 col-sm-6">
	            <div class="span2"><?php echo $form->labelEx($model,'phone',array('class'=>'inline-labels'));?></div>
	            <div class="span3"><?php echo $form->textField($model,'phone',array('span'=>2,'maxlength'=>10,'placeHolder'=>'Phone No. 1'));?></div>
	            <div class="span2"><?php echo $form->labelEx($model,'phones',array('class'=>'inline-labels'));?></div>
	            <div class="span3"><?php echo $form->textField($model,'phones',array('span'=>2,'maxlength'=>10,'placeHolder'=>'Phone No. 2'));?></div>
	        </div>
	    </div>
	    </tr>
           <!-- <tr>
    	<div class="row">
	    	<div class="col-md-3 col-sm-6">
                    <div class="span2"><?php //echo $form->labelEx($model,'auth_method',array('class'=>'inline-labels'));?></div>
	            <div class="span3"><?php //echo $form->textField($model,'auth_method',array('span'=>2,'maxlength'=>50,'placeHolder'=>'Authentication Method'));?></div>     
	            <div class="span2"><?php //echo $form->labelEx($model,'id_auth',array('class'=>'inline-labels'));?></div>
	            <div class="span3"><?php //echo $form->textField($model,'id_auth',array('span'=>2,'maxlength'=>50,'placeHolder'=>'Authentication ID'));?></div>
	        </div>
	    </div>
	    </tr>-->
	 
	    
	    <tr>
    	<div class="row">
	    	<div class="col-md-3 col-sm-6">
                    <?php //if(isset($model->dept_id)) $array = $model->dept_id;
                          //else $array = array();?>
                    <div class="span2"><?php echo $form->labelEx($model,'dept_id',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo Select2::activeMultiSelect($model, 'dept_id', CHtml::listData( Dept::model()->findAllByAttributes(array('orgid'=>Yii::app()->user->getState("org_id"))), 'id', 'name' ), array(
				        //'required' => 'required',
				        'select2Options' => array(
                                          'width'=>'65%',
				          'placeholder' => '--- Select Departments ---',
				        )));?></div>
                    <div class="span2"><?php echo $form->labelEx($model,'groups',array('class'=>'inline-labels'));?></div>
	            <div class="span3"><?php echo Select2::activeMultiSelect($model, 'g_id', CHtml::listData( group::model()->findAll(), 'id', 'name' ), array(
				        //'required' => 'required',
				        'select2Options' => array(
                                          'width'=>'65%',
				          'placeholder' => '--- Select Groups ---',
				        )));?></div>
                    
                    
	        </div>
	</div>
	    </tr>
            <tr>
            <div class="row">
	    	<div class="col-md-3 col-sm-6">
	            <?php echo $form->hiddenField($model,'organisation_id',array('class'=>'inline-labels','value'=>Yii::app()->user->getState("org_id")));?>
                       
                    <div class="span2"><?php echo $form->labelEx($model,'designation',array('class'=>'inline-labels'));?></div>
	            <div class="span3"><?php echo $form->textField($model,'designation',array('span'=>2,'maxlength'=>50,'placeHolder'=>'Designation'));?></div>
                </div>
	    </div>
	    </tr>  
    </table>
    

    
        <div style="text-align: center;">
            <?php echo TbHtml::submitButton($model->isNewRecord ? 'Submit' : 'Update',array(
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