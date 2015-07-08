<?php
/* @var $this BlockeditemController */
/* @var $model Blockeditem */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'blockeditem-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
    

    <?php echo $form->errorSummary($model); ?>
    <?php $chosenId = $_GET['id'];
          $itemId = isset($_GET['itemId'])?$_GET['itemId']:'';
          $commodityId = isset($_GET['commodity_id'])?$_GET['commodity_id']:'';
          $item = Consumable::model()->findByAttributes(array('id'=>$itemId));?>
    <?php //$a = $item['name'];echo "<script>alert($a)</script>";die;?>
    <?php //<h2><span style="color:#B40431">dsad<?php $item['name']?>
    
    <p class="help-block">Fields with <span class="required">*</span> are required.</p>
    <?php echo $form->hiddenField($model,'commodity_id',array('span'=>5,'value'=>$commodityId)); ?>
    <?php echo $form->hiddenField($model,'item_id',array('span'=>5,'value'=>$itemId)); ?>
    <?php echo $form->hiddenField($model,'blocked_by',array('span'=>5,'value'=>Yii::app()->user->getState("user_id"))); ?>
    <?php echo $form->hiddenField($model,'blocked_on',array('span'=>5,'value'=>date('Y-m-d'))); ?>
    <?php echo $form->hiddenField($model,'unblock_by',array('span'=>5)); ?>
    <?php echo $form->hiddenField($model,'unblock_on',array('span'=>5)); ?>   
    <?php echo $form->hiddenField($model,'blocked_for',array('span'=>5)); ?>
    <?php echo $form->hiddenField($model,'flag',array('span'=>5,'maxlength'=>1)); ?>

    
    <table>
    <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'blocked_from',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                'attribute'=>'blocked_from',
                                'name'=>'blocked_from',
                                'model'=>$model,
                                'options'=>array(
                                    'showAnim'=>'fold',
                                    'dateFormat'=>'yy-mm-dd',    
                                )
                        ));?></div>
                 </div>
            </div>
     </tr>
     <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'blocked_to',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                'attribute'=>'blocked_to',
                                'name'=>'blocked_to',
                                'model'=>$model,
                                'options'=>array(
                                    'showAnim'=>'fold',
                                    'dateFormat'=>'yy-mm-dd',    
                                )
                        ));?></div>
                 </div>
            </div>
     </tr>
     <?php if($chosenId == 1); 
           else if($chosenId == 2){
               echo "<tr>
            <div class='row'>
                <div class='col-md-3 col-sm-6'>
                    <div class='span2'>";echo $form->labelEx($model,'block_group',array('class'=>'inline-labels')); echo"</div>
                    <div class='span3'>";echo Select2::activeMultiSelect($model, 'block_group', CHtml::listData(Group::model()->findAll(), 'id', 'name' ), array(
				        
				        'select2Options' => array(
				          'placeholder' => 'Select Groups',
                                          'width'=>'85%'
				        )));echo "</div>
                 </div>
            </div>
     </tr>
     <tr>
            <div class='row'>
                <div class='col-md-3 col-sm-6'>
                    <div class='span2'>";echo $form->labelEx($model,'block_user',array('class'=>'inline-labels'));echo "</div>
                    <div class='span3'>";echo Select2::activeMultiSelect($model, 'block_user', CHtml::listData(User::model()->findAll(), 'id', 'name' ), array(
				        
				        'select2Options' => array(
				          'placeholder' => 'Select Users',
                                           'width'=>'85%'
				        )));echo "</div>
                 </div>
            </div>
           </tr>";}?>
     </table>
    
          <div style="text-align: center;">
            <?php echo "<br/>";?>
            <?php echo TbHtml::submitButton($model->isNewRecord ? 'Submit' : 'Update',array(
                    'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
                    'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
                    //'onclick'=>'js:document.location.href="http://localhost/asset_management/index.php/new"'
                )); ?>
            <?php echo TbHtml::button('Cancel',array(
                    'color' => TbHtml::BUTTON_COLOR_DANGER,
                    'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
                    'onclick' => 'history.go(-1)'
            ));?>
            </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->