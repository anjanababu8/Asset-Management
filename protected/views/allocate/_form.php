<html>
<style>
.inline-labels{
    display:inline-block;
    padding:10px;
}
</style>
</html>

<?php
/* @var $this AllocateController */
/* @var $model Allocate */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'allocate-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
       
)); ?>

    
    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
    <?php $user = User::model()->findByAttributes(array('name'=>CHtml::encode(Yii::app()->user->getId()))); 
          $row = Allocate::model()->findByAttributes(array('allocate_id'=>$_GET['allocateId']));
          $consId = $row['cons_id'];
          $available_quantity = count(Allocate::model()->findAll('cons_id = :cons_id AND (date_out IS NULL OR date_out = :date_out)',array(':cons_id' => $consId,':date_out'=>'0000-00-00')));
          $t = 'Consumable';
          $item = $t::model()->findByAttributes(array('id'=>$consId));
          
          
    ?>
    
    <?php //echo $form->hiddenField($model,'stock_id',array('span'=>5)); ?>
    <?php //echo $form->hiddenField($model,'id',array('span'=>5)); ?>
    <?php //echo $form->hiddenField($model,'given_to',array('span'=>5)); ?>
    <?php //echo $form->hiddenField($model,'user_group',array('span'=>5,'maxlength'=>2)); ?>
    <?php echo $form->hiddenField($model,'given_by',array('span'=>5,'value'=>$user['id'])); ?>
    <?php echo $form->hiddenField($model,'available_quantity',array('value'=>$available_quantity));?>
    <?php echo $form->hiddenField($model,'cons_id',array('span'=>2));?>
    <?php echo $form->hiddenField($model,'commodity_id',array('value'=>$_GET['commodity_id']));?>
    
    <table>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'allocate_to',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->dropDownList($model,'allocate_to',array(1=>'Self',2=>'Group',3=>'Other User'),
                                        array(
                                            'ajax' => array(
                                            'type'=>'POST',
                                            'prompt'=>'---',
                                            'id'=>'drop_selection',
                                            'url'=>CController::createUrl('dynamicrows'), //url to call.
                                            'update'=>'#Allocate_allocate_to_extend', //selector to update
                                            'data'=>array('selection'=>'js:this.value'), 
                                        ))); ?></div>
                    <div class="hidden_drop">
                    <div class="span2"><?php echo $form->labelEx($model,'allocate_to_extend',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo CHtml::dropDownList('Allocate[allocate_to_extend]','', array(),array('prompt'=>'---','id'=>'Allocate_allocate_to_extend'));?></div>                   
                    </div> 
            </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'date_out',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                'attribute'=>'date_out',
                                'name'=>'date_out',
                                'htmlOptions'=>array('value'=>date('Y-m-d')),
                                'model'=>$model,
                                'options'=>array(
                                    'showAnim'=>'fold',
                                    'dateFormat'=>'yy-mm-dd'
                                ),
                        ));?></div>
                    <div class="span2"><?php echo CHtml::label('Quantity','',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textField($model,'quantity',array('span'=>2));
                                             echo " / $available_quantity";?></div>
            </div>
            </div>
        </tr>
         <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <?php if($item['semi_consumable'] == 'Yes'){
                        echo $form->hiddenField($model,'semiYes',array('value'=>'Yes'));
                        
                    echo 
                    "<div class='span2'>".$form->labelEx($model,'return_on',array('class'=>'inline-labels'));echo "</div>
                    <div class='span3'>";$this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                'attribute'=>'return_on',
                                'name'=>'return_on',
                                'value'=>$model->return_on,
                                'model'=>$model,
                                'options'=>array(
                                    'showAnim'=>'fold',
                                    'dateFormat'=>'yy-mm-dd'
                                ),
                    ));echo "</div>"; 
                            
                    }else $form->hiddenField($model,'semiYes',array('value'=>'No'));  ?>
                   
                        
            </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'purpose',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textArea($model,'purpose',array('rows'=>4,'span'=>3));?></div>
                    <div class="span2"><?php echo $form->labelEx($model,'comments',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textArea($model,'comments',array('rows'=>4,'span'=>3));?></div>   
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