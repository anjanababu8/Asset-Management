<html>
<style>
.inline-labels{
    display:inline-block;
    //padding:10px;
}
</style>
</html>

<div class="devices-form">
 
     <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'devices-form',
	
	 'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,

	'htmlOptions' => array('enctype' => 'multipart/form-data'),

)); ?>
<p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
 
    
    <?php 
        if(isset($_GET['commodity_id']))
           $value=$_GET['commodity_id'];
        else
            $value=$model->commodity_id;
            
        
    echo $form->hiddenField($model,'commodity_id',array('span'=>2,'value'=>3));?></div>
 
    <table>
        <tr>
    	<div class="row">
	    	<div class="col-md-3 col-sm-6">
	            <div class="span2"><?php echo $form->labelEx($model,'name',array('class'=>'inline-labels'));?></div>
	            <div class="span3"><?php echo $form->textField($model,'name',array('span'=>3,'maxlength'=>50));?></div>
                    <div class="span2"><?php echo $form->labelEx($model,'category_id',array('class'=>'inline-labels'));?></div>
                    <?php // GET ONLY NOT DELETED CATEGORIES 
                        $notDeletedCategories = MyUtility::getNotDeleted('category');
                        $ccRow = CommodityCategory::model()->findAllByAttributes(array('commodity_id'=>$value,'category_id'=>$notDeletedCategories));                        
                    ?>
                    <div class="span3"><?php echo $form->dropDownList($model,'category_id',CHtml::listData($ccRow,'path','path'),array('span'=>2,'prompt'=>'---'))?></div>
                </div>
	    </div>
	    </tr>
        <tr>
	    	<div class="row">
		    	<div class="col-md-3 col-sm-6">
		            <div class="span2"><?php echo $form->labelEx($model,'location_id',array('class'=>'inline-labels'));?></div>
		            <div class="span3"><?php echo $form->dropDownList($model,'location_id',CHtml::listData(Location::model()->findAll(),'id','name'),array('span'=>2,'prompt'=>'---'));?>
		            <?php echo CHtml::ajaxLink(Yii::t('location',TbHtml::button('+',array(
							'color' => TbHtml::BUTTON_COLOR_SUCCESS,
							'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
						))),$this->createUrl('location/addnew'),array(
						        'onclick'=>'$("#divDialog6").dialog("open"); return false;',
						        'update'=>'#divDialog6'
						        ),array(
                                                        'id'=>  uniqid()));?>
					        <div id="divDialog6"></div>	
            		</div>
		            <div class="span2"><?php echo $form->labelEx($model,'technical_incharge_id',array('class'=>'inline-labels'));?></div>
		            <div class="span3" id="plus"><?php echo $form->dropDownList($model,'technical_incharge_id',CHtml::listData(User::model()->findAll(),'id','name'),array('span'=>2,'prompt'=>'---'));?>
		            <?php echo CHtml::ajaxLink(Yii::t('user',TbHtml::button('+',array(
							'color' => TbHtml::BUTTON_COLOR_SUCCESS,
							'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
						))),$this->createUrl('user/addnew'),array(
						        'onclick'=>'$("#divDialog3").dialog("open"); return false;',
						        'update'=>'#divDialog3'
						        ),array(
                                                        'id'=>  uniqid()));?>
					        <div id="divDialog3"></div>
		            </div>
		        </div>
		    </div>
	    </tr>
        <tr>
	        <div class="row">
		    	<div class="col-md-3 col-sm-6">
		            <div class="span2"><?php echo $form->labelEx($model,'status_id',array('class'=>'inline-labels'));?></div>
		            <div class="span3"><?php echo $form->dropDownList($model,'status_id',CHtml::listData(Status::model()->findAll(),'id','status'),array('span'=>2,'prompt'=>'---'));?>
		            <?php echo CHtml::ajaxLink(Yii::t('status',TbHtml::button('+',array(
							'color' => TbHtml::BUTTON_COLOR_SUCCESS,
							'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
						))),$this->createUrl('status/addnew'),array(
						        'onclick'=>'$("#divDialog2").dialog("open"); return false;',
						        'update'=>'#divDialog2'
						        ),array(
                                                        'id'=>  uniqid()));?>
					        <div id="divDialog2"></div>
					</div>
		            <div class="span2"><?php echo $form->labelEx($model,'manufacturer_id',array('class'=>'inline-labels'));?></div>
		            <div class="span3"><?php echo $form->dropDownList($model,'manufacturer_id',CHtml::listData(Manufacturer::model()->findAll(),'id','name'),array('span'=>2,'prompt'=>'---'));?>
		            <?php echo CHtml::ajaxLink(Yii::t('manufacturer',TbHtml::button('+',array(
							'color' => TbHtml::BUTTON_COLOR_SUCCESS,
							'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
						))),$this->createUrl('manufacturer/addnew'),array(
						        'onclick'=>'$("#divDialog4").dialog("open"); return false;',
						        'update'=>'#divDialog4'
						        ),array(
                                                        'id'=>  uniqid()));?>
					        <div id="divDialog4"></div>
		            </div>
	        	</div>
	        </div>      
        </tr>
        <tr>
        <div class="row">
	    	<div class="col-md-3 col-sm-6">
            	<div class="span2"><?php echo $form->labelEx($model,'device_type_id',array('class'=>'inline-labels'));?></div>
            	<div class="span3"><?php echo $form->dropDownList($model,'device_type_id',CHtml::listData(Consumabletype::model()->findAll(),'id','name'),array('span'=>2,'prompt'=>'---'));?>
        		<?php echo CHtml::ajaxLink(Yii::t('consumabletype',TbHtml::button('+',array(
							'color' => TbHtml::BUTTON_COLOR_SUCCESS,
							'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
						))),$this->createUrl('consumabletype/addnew'),array(
						        'onclick'=>'$("#divDialog1").dialog("open"); return false;',
						        'update'=>'#divDialog1'
						        ),array(
                                                        'id'=>  uniqid()));?>
					        <div id="divDialog1"></div>	
				</div>
            	<div class="span2"><?php echo $form->labelEx($model,'management_type_id',array('class'=>'inline-labels'));?></div>
            	<div class="span3"><?php echo $form->dropDownList($model,'management_type_id',CHtml::listData(Managementtype::model()->findAll(),'id','name'),array('span'=>2,'prompt'=>'---'));?>
            	<?php echo CHtml::ajaxLink(Yii::t('managementtype',TbHtml::button('+',array(
							'color' => TbHtml::BUTTON_COLOR_SUCCESS,
							'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
						))),$this->createUrl('managementtype/addnew'),array(
						        'onclick'=>'$("#divDialog5").dialog("open"); return false;',
						        'update'=>'#divDialog5'
						        ),array(
                                                        'id'=>  uniqid()));?>
					        <div id="divDialog5"></div>	
            	</div>
        	</div>
        </div>
        </tr>
        <tr>
        <div class="row">
	    	<div class="col-md-3 col-sm-6">
            <div class="span2"><?php echo $form->labelEx($model,'brand',array('class'=>'inline-labels'));?></div>
            <div class="span3"><?php echo $form->textField($model,'brand',array('span'=>2));?></div>
            <div class="span2"><?php echo $form->labelEx($model,'serial_number',array('class'=>'inline-labels'));?></div>
            <div class="span3"><?php echo $form->textField($model,'serial_number',array('span'=>2));?></div>
            </div>
        </div>
        </tr>
        <tr>
        <div class="row">
	    <div class="col-md-3 col-sm-6">
            <div class="span2"><?php echo $form->labelEx($model,'image',array('class'=>'inline-labels'));?></div>
            <div class="span3"><?php echo $form->fileField($model,'image');?></div>
            <div class="span2"><?php echo $form->labelEx($model,'enable_financial',array('class'=>'inline-labels'));?></div>
            <div class="span3"><?php echo $form->radioButtonList($model,'enable_financial',array('1'=>'Yes', '0'=>'No'),array('labelOptions'=>array('style'=>'display: inline-block;')));?></div>
            </div>
        </div>
        </tr>
        <br/>
        <tr>
        <div class="row">
	    <div class="col-md-3 col-sm-6">
            <div class="span2"><?php echo $form->labelEx($model,'document',array('class'=>'inline-labels'));?></div>
            <div class="span3"><?php echo $form->fileField($model,'document');?></div>
            <div class="span2"><?php echo $form->labelEx($model,'available_on_loan',array('class'=>'inline-labels'));?></div>
            <div class="span3"><?php echo $form->radioButtonList($model,'available_on_loan',array('1'=>'Yes', '0'=>'No'),array('labelOptions'=>array('style'=>'display: inline-block;')));?></div>
        </div>
        </tr>
        <br/>
        <tr>
            <?php
            if(isset($_GET['commodity_id']))
                $link = Link::model()->findByAttributes(array('commodity1_id'=>$_GET['commodity_id']));
            else {
                $link = Link::model()->findByAttributes(array('commodity1_id'=>$model->commodity_id));
            }
            $commodity = Commodity::model()->findByAttributes(array('id'=>$link['commodity2_id']));
	?>
        
        <div class="row">
	    	<div class="col-md-3 col-sm-6">
            <div class="span2"><?php echo $form->labelEx($model,'comments',array('class'=>'inline-labels'));?></div>
            <div class="span3"><?php echo $form->textArea($model,'comments',array('rows'=>4,'span'=>3));?></div>
            <?php if(count($link) != 0){
                    $commodity = Commodity::model()->findByAttributes(array('id'=>$link['commodity2_id']));
                    $commodityName = $commodity['name'];
                    echo "<div class='span2'>".$form->labelEx($model,'link_to',array('class'=>'inline-labels'))."</div>
                    <div class='span3'>".$form->dropDownList($model,'link_to',CHtml::listData($commodityName::model()->findAllByAttributes(array('is_deleted'=>0)),'id','name'),array('span'=>2,'prompt'=>'---'))."</div>"; 
                }?>
                </div>
        </div>
        </tr>  
    </table>
	</div>

	
	 <div style="text-align: center;">
	        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Submit' : 'Update',array(
			    'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
			    'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
			    //'onclick'=>'js:document.location.href="http://localhost/asset_management/index.php/consumable/admin"'
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

