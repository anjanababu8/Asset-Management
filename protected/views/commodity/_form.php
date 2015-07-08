<html>
<style>
.inline-labels{
    display:inline-block;
    padding:10px;
}
</style>
</html>

<?php
/* @var $this CommodityController */
/* @var $model Commodity */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'commodity-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
    <?php echo $form->hiddenField($model,'organisation_id',array('span'=>2,'value'=>Yii::app()->user->getState("org_id")));?>
    <table>
        <tr>
    	<div class="row">
	    <div class="col-md-3 col-sm-6">
                <div class="span2"><?php echo $form->labelEx($model,'name',array('class'=>'inline-labels'));?></div>
                <div class="span3"><?php echo $form->textField($model,'name',array('span'=>3,'maxlength'=>50,'placeHolder'=>'Commodity Name'));?></div>
	    </div>
	    </div>
	</tr>
        <tr>
        <div class="row">
	    <div class="col-md-3 col-sm-6">
                <div class="span2"><?php echo $form->labelEx($model,'description',array('class'=>'inline-labels'));?></div>
                <div class="span3"><?php echo $form->textArea($model,'description',array('row'=>4,'span'=>3));?></div>
            </div>
        </div>
        </tr>
        <tr>
        <div class="row">
	    <div class="col-md-3 col-sm-6">
                <div class="span2"><?php echo $form->labelEx($model,'categories',array('class'=>'inline-labels'));?></div>
				<div class="span3"><?php $rootLevelCats = Category::model()->findAll('pid=:pid', array('pid' => '0'));
                        foreach($rootLevelCats as $child) {
                            $subchilds = $child->childs;
                            foreach($subchilds as $subchild) {
                                $subchild->name = $subchild->getparent->name . "->" . $subchild->name;
                                $rootLevelCats = array_merge($rootLevelCats, $child->childs);
                            }
                        }

                        $rootobj = new Category;
                        $rootobj->id = 0;
                        $rootobj->name = "-----";
                        $root = array($rootobj);
                        $rootLevelCats = array_merge($root, $rootLevelCats);

                        if(isset($model->id) && $model->id == 1) {
                            echo "This is the root node and can't be moved.";
                            $model->pid = 0; 
                        }
                        else {
                            //if(isset($_GET['categorypid']))
							//{
                                echo Select2::activeMultiSelect($model,'categories', CHtml::listData($rootLevelCats, 'id', 'name'), array(
									'required' => 'required',
									'select2Options' => array(
                                                                        'width'=>'85%',
									'placeholder' => '--- Add Categories ---'))); 
									echo CHtml::ajaxLink(Yii::t('category',TbHtml::button('+',array(
                                        'color' => TbHtml::BUTTON_COLOR_SUCCESS,
                                        'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
                                    ))),$this->createUrl('category/addnew'),array(
                                            'onclick'=>'$("#divDialog").dialog("open"); return false;',
                                            'update'=>'#divDialog'
                                            ),array('id'=>  uniqid())); ?>
                                        <div id="divDialog"></div>
							
							<?php 
                            /*else
							{ 
                                echo Select2::activeMultiSelect($model,'categories', CHtml::listData($rootLevelCats, 'id', 'name'),array(
									'required' => 'required',
									'select2Options' => array(
									'placeholder' => '--- Add Categories ---'))); ?>
									<?php echo CHtml::ajaxLink(Yii::t('category',TbHtml::button('+',array(
                                        'color' => TbHtml::BUTTON_COLOR_SUCCESS,
                                        'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
                                    ))),$this->createUrl('category/addnew'),array(
                                            'onclick'=>'$("#divDialog").dialog("open"); return false;',
                                            'update'=>'#divDialog'
                                            ),array('id'=>  uniqid())); ?>
                                        <div id="divDialog"></div>
				
						<?php }*/
                        } ?>
				
					</div>
				
				
				
                 
                </div>
            </div>
        </div>
        </tr>
    </table>

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
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->