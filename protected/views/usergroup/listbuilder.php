<?php
/* @var $this UsergroupController */
/* @var $model Usergroup */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'usergroup-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <?php echo $form->errorSummary($model); ?>
    <?php $groupName = $_GET['groupName'];?>
    
    <h1> Manage Group <span style="color:#B40431"><?php echo "$groupName";?></h1>
    <?php echo "<br/>";?>
                   <?php 
                    $this->widget('ext.multiselects.XMultiSelects',array(
                    'id'=>'listbuilder',
                    'leftTitle'=>'Group Users',
                    'leftName'=>'Usergroup[groupusers][]',
                    'leftList'=>Usergroup::model()->findUsersByGroup($_GET['groupId']),
                    'rightTitle'=>'Other Users',
                    'rightName'=>'Usergroup[otherusers][]',
                    'rightList'=>Usergroup::model()->findUsersNotInGroup($_GET['groupId']),
                    'size'=>20,
                    'width'=>'200px',
                        ));?>
               
    <div style="text-align: center;">
    <?php echo CHtml::submitButton('Update',array('submit' => array('usergroup/moveusers','groupId' => $_GET['groupId'])),array(
                'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
                'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
            )); ?>
    </div

    <?php $this->endWidget(); ?>

</div><!-- form -->
