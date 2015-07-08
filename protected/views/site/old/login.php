<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Login</h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
        
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
                'validateOnChange'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<br/>

	
	<div>
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username')?>
                <?php //echo CHtml::activeTextField($form,'username',array('size'=>'5',
                    //'onblur'=> CHtml::ajax(array('data'=>array('username'=>'js:this.value'),
                    //'url'=>CController::createUrl('site/login'),'update'=>'#error'))));?>
                        
		<?php echo $form->error($model,'username');?>
            <div id ="error"></div>
                                        
	</div>

	<div>
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		
	</div>
        
        <div>
                <?php echo $form->labelEx($model,'organisation_id',array('class'=>'inline-labels'));?>
                <?php echo $form->dropDownList($model,'organisation_id',CHtml::listData(Organisation::model()->findAll(),'id','name'),array('span'=>2,'prompt'=>'---'));?>
                <?php echo $form->error($model,'organisation_id'); ?>
        </div>

	<div class="rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe',array('class'=>'form-label') ); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>
	

	<div class="buttons">
		<?php echo CHtml::submitButton('Login',array('class'=>'btn btn-success'));?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
