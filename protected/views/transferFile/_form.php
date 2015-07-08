
<html>
<style>
.inline-labels{
    display:inline-block;
    padding:10px;
}
</style>
</html>
<?php
/* @var $this TransferFileController */
/* @var $model TransferFile */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'transfer-file-form',
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
              if(isset($_GET['owner'])){
                $owner = $_GET['owner'];
                $ownerRow = User::model()->findByAttributes(array('name'=>$owner));  
                $ownerId = $ownerRow['id'];
              }else $ownerId = '';
              if(isset($_GET['deptName'])){
                $deptName = $_GET['deptName'];
                $deptRow = Dept::model()->findByAttributes(array('name'=>$deptName));
                $deptId = $deptRow['id'];
              }else $deptId= '';
              
              $validUsersIdRows = Userdept::model()->findAll('dept_id =:dept_id AND uid !=:uid',array('dept_id'=>$deptId,'uid'=>$ownerId));
              $transferTo = [];
              foreach($validUsersIdRows as $user){
                  $u = User::model()->findByPk($user['uid']);
                  $transferTo[$u['id']] = $u['name'];
              }
              
        ?>   
    
    
	<table>
        <tr>
    	<div class="row">
	    	<div class="col-md-3 col-sm-6">
                <div class="span2"><?php echo $form->labelEx($model,'transfer_to',array('class'=>'inline-labels'));?></div>
                <div class="span3"><?php echo $form->dropDownList($model,'transfer_to',$transferTo,array('span'=>2,'prompt'=>'---'))?></div>
                <div class="span2"><?php echo $form->labelEx($model,'transfer_location',array('class'=>'inline-labels'));?></div>
                <div class="span3"><?php echo $form->dropDownList($model,'transfer_location',CHtml::listData(Location::model()->findAll(),'id','name'),array('span'=>2,'prompt'=>'---'))?></div>
				</div>
	    </div>
	    </tr>
		<tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'transfer_date',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                'attribute'=>'transfer_date',
                                'name'=>'transfer_date',
                                'htmlOptions'=>array('value'=>date('Y-m-d')),
                                'model'=>$model,
                                'options'=>array(
                                    'showAnim'=>'fold',
                                    'dateFormat'=>'yy-mm-dd'
                                ),
                        ));?></div> 
            </div>
            </div>
        </tr>
		<tr>
    	<div class="row">
	    	<div class="col-md-3 col-sm-6">
                <div class="span2"><?php echo $form->labelEx($model,'Remark',array('class'=>'inline-labels'));?></div>
                <div class="span3"><?php echo $form->textfield($model,'Remark',CHtml::listData(User::model()->findAll(),'id','name'),array('span'=>2,'prompt'=>'---'))?></div>
               
				</div>
	    </div>
	    </tr>
			
			
			<?php echo $form->hiddenField($model,'timestamp',array('span'=>5,'value'=>22/06/2015)); ?>
			

            

          


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