<?php
/* @var $this EntryController */

$this->breadcrumbs=array(
	'Form',
	$form->FORM_NAME,
);

$this->menu=array(
	array('label'=>'Edit This Entry (#'.$model->ID.')', 'url'=>array('edit', 'entry'=>$model->ID,'form'=>$form->FORM_ID)),
	array('label'=>'Delete This Entry (#'.$model->ID.')', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','entry'=>$model->ID,'form'=>$form->FORM_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage This Form (#'.$model->FORM_ID.')', 'url'=>array('forms/view', 'form'=>$form->FORM_ID)),
	array('label'=>'Manage Entries for Form (#'.$model->FORM_ID.')', 'url'=>array('index','form'=>$form->FORM_ID)),
	array('label'=>'Manage Forms', 'url'=>array('forms/index')),
	
);
?>

<h1><?php echo $form->FORM_NAME.' (Entry #'.$model->ID.')'; ?></h1>

<?php if(Yii::app()->user->hasFlash('entryMessage')): ?>
<div class="success">
	<?php echo Yii::app()->user->getFlash('entryMessage'); ?>
</div>
<?php endif; ?>
<table>
<?php 
$i=7;
		if ($fields) {
			foreach($fields as $field) {
			?>
 <tr>
        <div class="row">
	    	<div class="col-md-3 col-sm-6">
			<?php 
			if($field->FIELD_ID%2==0){ ?>
            <div class="span2"><?php echo CHtml::encode($field->TITLE); ?></div>
            <div class="span3"><?php echo (($model->{$field->VARNAME})?$model->{$field->VARNAME}:''); ?></div> 
			<?php } ?>
            </div>
        </div>
		<?php $i++; } }?>
        </tr>
</table>	

<?php
			
$cartridges = Filedetails::model()->findAllByAttributes(array('fid'=>$model->ID));
 echo "<table class='table table-bordered'>";
 if(count($cartridges) != 0){
    echo "<tr style='background:#F5A9A9;'><th colspan='4' style='text-align:center'>File Details</th></tr>";
    foreach($cartridges as $c){
		$cartridgeName4 = $c['id'];
        $cartridgeName = $c['content'];
        $cartridgeName2 = $c['updatedby'];
        $cartridgeName3 = $c['updatedon'];
        
        
   $user = User::model()->findAllByAttributes(array('id'=>$c['updatedby']));
	$temp=$user['name'];
	echo $temp;die;

       
            echo "<tr><th>S.No.</th><th>Content</th><th>Updated By</th><th>Updated On</th></tr>";
            echo "<tr style='background:#F6E3CE'><th>$cartridgeName4</th><th>$cartridgeName</th><th></th><th>$cartridgeName3</th></tr>";
			
               echo "<tr>";
                        
     

    }
 }else{
  echo "<tr style='background:#F5A9A9;'><th colspan='4' style='text-align:center'></th></tr>";   
 }
 echo "</table>";

