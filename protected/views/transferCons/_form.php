<?php
/* @var $this TransferConsController */
/* @var $model TransferCons */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'transfer-cons-form',
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
          $consumable = $commodity['name']::model()->findByAttributes(array('id'=>$_GET['itemId']));?>
    <h3 style="color: #B40431"> <?php echo $consumable['name'];?> </h3> 
    
	<?php $temp=$_GET['commodity_id']; 
		$tempname=Commodity::model()->findByAttributes(array('id'=>$temp));
		//echo $tempname['name'];
	?>
	
	<?php /*$consumable = $tempname['name']::model()->findByAttributes(array('id'=>$_GET['itemId']));?>
    <h3 style="color: #B40431"> <?php echo $consumable['name']; */?> </h3>
    

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->hiddenField($model,'consumable_id',array('span'=>2,'readOnly'=>true,'value'=>$_GET['itemId']));?>

       <table>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'belongs_to',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textField($model,'belongs_to',array('span'=>2,'readonly'=>true,'value'=>$consumable['category_id']));?></div>
                    
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'transfer_to',array('class'=>'inline-labels'));?></div>                                                                               
                    <div class="span3"><?php echo $form->dropDownList($model,'transfer_to',CHtml::listData(CommodityCategory::model()->findAll('path!=:path AND commodity_id=:commodity_id',array('path'=>$consumable['category_id'],'commodity_id' =>$_GET['commodity_id'])),'path','path'),array('span'=>2,'prompt'=>'---'))?></div>
                </div>
            </div>
        </tr>
       </table>
    
            

        <div style="text-align: center;">
            <?php echo TbHtml::submitButton($model->isNewRecord ? 'Submit' : 'Update',array(
                'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
                'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
                'onclick'=>'js:document.location.href="http://localhost/asset_management/index.php/consumable/admin"'
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