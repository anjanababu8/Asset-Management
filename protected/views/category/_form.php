<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'category-form',
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
                    <div class="span2"><?php echo $form->labelEx($model,'name',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textField($model,'name',array('span'=>3,'maxlength'=>50)); ?></div>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'descr',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php echo $form->textArea($model,'descr',array('rows'=>6,'span'=>3)); ?></div>
                </div>
            </div>
        </tr>
        <tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo CHtml::label('Under Category','',array('class'=>'inline-labels'));?></div>
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
                        $rootobj->name = "At Root Level";
                        $root = array($rootobj);
                        $rootLevelCats = array_merge($root, $rootLevelCats);

                        if(isset($model->id) && $model->id == 1) {
                            echo "This is the root node and can't be moved.";
                            $model->pid = 0; 
                        }
                        else {
                            if(isset($_GET['categorypid']))
                                echo CHtml::DropDownList('Category[pid]', $_GET['Categorypid'], CHtml::listData($rootLevelCats, 'id', 'name'));
                            else
                                echo CHtml::DropDownList('Category[pid]', 1, CHtml::listData($rootLevelCats, 'id', 'name'));
                        } ?>
			
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