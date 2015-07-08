<?php
/* @var $this ConsumablestockController */
/* @var $model Consumablestock */
/* @var $form TbActiveForm */
?>

<div class="form">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'consumablestock-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array(
           'enctype'=>'multipart/form-data'
       )
)); ?>

    <?php $commodity = Commodity::model()->findByAttributes(array('id'=>$_GET['commodity_id'])); 
      $commodityName = $commodity['name'];
      $consumable = $commodityName::model()->findByAttributes(array('id'=>$_GET['itemId']));?>
    <h3 style="color: #B40431"> <?php echo $consumable['name'];?> </h3> 
    
    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->hiddenField($model,'consumable_id',array('span'=>2,'readOnly'=>true,'value'=>$_GET['itemId']));?>

    
    <table>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'po_number',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textField($model,'po_number',array('span'=>2));?></div>
                    <div class="span2"><?php echo $form->labelEx($model,'unit_cost',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textField($model,'unit_cost',array('span'=>2));'<br/><br/>';?></div>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'quantity',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textField($model,'quantity',array('span'=>2)); ?></div>
                    <div class="span2"><?php echo $form->labelEx($model,'inventory_no',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textField($model,'inventory_no',array('span'=>2)); ?></div>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'supplier_id',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->dropDownList($model,'supplier_id',CHtml::listData(Supplier::model()->findAll(),'id','name'),array('span'=>2,'prompt'=>'---'));?>
                            <?php echo TbHtml::button('+',array(
                            'color' => TbHtml::BUTTON_COLOR_SUCCESS,
                            'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
                            'onclick' => 'js:document.location.href="/asset_management/index.php/supplier/create"'
                            ));?></div>
                    <div class="span2"><?php echo $form->labelEx($model,'status_id',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->dropDownList($model,'status_id',CHtml::listData(Status::model()->findAll(),'id','status'),array('span'=>2,'prompt'=>'---'));?>
                            <?php echo TbHtml::button('+',array(
                            'color' => TbHtml::BUTTON_COLOR_SUCCESS,
                            'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
                            'onclick' => 'js:document.location.href="/asset_management/index.php/status/create"'
                            ));?></div>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'date_in',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                'attribute'=>'date_in',
                                'name'=>'date_in',
                                'value'=>$model->date_in,
                                'model'=>$model,
                                'options'=>array(
                                'showAnim'=>'fold',
                                'dateFormat'=>'yy-mm-dd',
                                ),
                                'htmlOptions'=>array(
                                'style'=>'height:20px;'
                                ),
                        ));?></div>
      
                    <div class="span2"><?php echo $form->labelEx($model,'warranty',array('class'=>'inline-labels','span'=>3));?></div>
                    <div class="span3"><?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                'attribute'=>'warranty',
                                'name'=>'warranty',
                                'value'=>$model->warranty,
                                'model'=>$model,
                                'options'=>array(
                                'showAnim'=>'fold',
                                'dateFormat'=>'yy-mm-dd',
                                ),
                                'htmlOptions'=>array(
                                'style'=>'height:20px;'
                                ),
                        ));?></div>
                    
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'expiry_date',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                'attribute'=>'expiry_date',
                                'name'=>'expiry_date',
                                'value'=>$model->expiry_date,
                                'model'=>$model,
                                'options'=>array(
                                'showAnim'=>'fold',
                                'dateFormat'=>'yy-mm-dd',
                                ),
                                'htmlOptions'=>array(
                                'style'=>'height:20px;'
                                ),                           
                        ));?></div>
                    <div class="span2"><?php echo $form->labelEx($model,'document',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->fileField($model,'document');?></div>
                </div>
            </div>
        </tr>
    </table>
    
        <div style="text-align: center;">
            <?php echo TbHtml::submitButton($model->isNewRecord ? 'Submit' : 'Update',array(
                'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
                'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
				//'onclick' => 'history.go(-1)'
                //'onclick'=>'js:document.location.href="http://localhost/asset_management/index.php/allocate/create"'
            )); ?>
            <?php echo TbHtml::button('Cancel',array(
                'color' => TbHtml::BUTTON_COLOR_DANGER,
                'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
                'onclick' => 'history.go(-1)'
            ));?>
            </div>
        <br/>
    <?php $this->endWidget(); ?>

</div><!-- form -->