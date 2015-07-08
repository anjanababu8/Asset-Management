<html>
<style>
.inline-labels{
    display:inline-block;
    padding:10px;
}
</style>
</html>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'client-account-create-form',
    'enableAjaxValidation'=>false,
		'htmlOptions' => array('enctype' => 'multipart/form-data'),

)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php
    $temp=$_GET['itemId'];
    ?>
    <?php echo $form->errorSummary($model); ?>
	
	<table>
        <tr>
    	<div class="row">
	    	<div class="col-md-3 col-sm-6">
                <div class="span2"><?php echo $form->labelEx($model,'content',array('class'=>'inline-labels'));?></div>
                <div class="span3"><?php echo $form->textField($model,'content')?></div>
               
				</div>
	    </div>
	    </tr>
		<tr>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="span2"><?php echo $form->labelEx($model,'updatedon',array('class'=>'inline-labels'));?></div>
                    <div class="span3"><?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                'attribute'=>'updatedon',
                                'name'=>'updatedon',
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
	<?php 
              if(isset($_GET['deptName'])){
                $deptName = $_GET['deptName'];
                $deptRow = Dept::model()->findByAttributes(array('name'=>$deptName));
                $deptId = $deptRow['id'];
              }
              
              $validUsersIdRows = Userdept::model()->findAll('dept_id =:dept_id',array('dept_id'=>$deptId));
              $updateBy = [];
              foreach($validUsersIdRows as $user){
                  $u = User::model()->findByPk($user['uid']);
                  $updateBy[$u['id']] = $u['name'];
              }
              $connection=Yii::app()->db;
			$sql = "select OWNER,MAINTENED_BY from fopen WHERE ID=$temp";
			$command = $connection->createCommand($sql);
			$dataReader = $command->queryAll();
			
                        $allowedUsers = [];
			foreach($dataReader[0] as $key=>$value){
                            $user = User::model()->findByAttributes(array('name'=>$value));
                            $allowedUsers[$user['id']]= $value;
                        }		
             
        ?>   
        
        <tr>
    	<div class="row">
	    	<div class="col-md-3 col-sm-6">
                <div class="span2"><?php echo $form->labelEx($model,'updatedby',array('class'=>'inline-labels'));?></div>
                <div class="span3"><?php echo $form->dropDownList($model,'updatedby',$allowedUsers,array('span'=>2,'prompt'=>'---'))?></div>
                <div class="span2"><?php echo $form->labelEx($model,'remark',array('class'=>'inline-labels'));?></div>
                <div class="span3"><?php echo $form->textfield($model,'remark')?></div>
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
