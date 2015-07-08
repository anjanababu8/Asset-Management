<html>
<style>
.inline-labels{
    display:inline-block;
    padding:10px;
}
</style>
</html>

<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<script>
    function loadorg(user)
    {
        document.getElementById(LoginForm_organisation_id).value=user;	
    }
    function chk(val)
    {
        jQuery.ajax({
            'url':'<?php echo Yii::app()->request->baseUrl; ?>/index.php/Sample/Getorg?name='+val,
            'cache':false,
            'success':function(html){
                $("#LoginForm_organisation_id").html(html);
            }
        });
        return false;
    }
</script>

<h1>Login</h1>

<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,    
)); ?>
  
<div>
<table>
    <tr>
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="span2"><?php echo $form->labelEx($model,'username',array('class'=>'inline-labels'));?></div>
            <div class="span3"><?php echo $form->textField($model, 'username', array('label' => 'Username', 'Placeholder' => 'Username', 'onblur' => 'chk(this.value)'));?></div>
        </div>
        </div>
    </tr>
    <tr>
    	<div class="row">
	    <div class="col-md-3 col-sm-6">
                <div class="span2"><?php echo $form->labelEx($model,'organisation_id',array('class'=>'inline-labels'));?></div>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select id="LoginForm_organisation_id" name="LoginForm[organisation_id]" required>
                    <option value="">--- Organisation ---</option>
                </select>
	    </div>
	</div>
    </tr>
    <tr>
    	<div class="row">
	    <div class="col-md-3 col-sm-6">
                <div class="span2"><?php echo $form->labelEx($model,'password',array('class'=>'inline-labels'));?></div>
                <div class="span3"><?php echo $form->passwordField($model, 'password', array('label' => 'Password', 'Placeholder' => 'Password'));?></div>
            </div>
        </div>
    </tr>
    <tr>
        <div class="row">
	    <div class="col-md-3 col-sm-6">
                <div class="span2"></div>
                <div class="span3">
                    <div class="row rememberMe">
                        <?php echo $form->checkBox($model, 'rememberMe'); ?>
                        <?php echo $form->label($model, 'rememberMe'); ?>
                        <?php echo $form->error($model, 'rememberMe'); ?>
                    </div>
                </div>
            </div>
        </div>
    </tr>                     
   <div class="buttons">
		<?php echo CHtml::submitButton('Login',array('class'=>'btn btn-success'));?>
	</div>
    
</table>
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
