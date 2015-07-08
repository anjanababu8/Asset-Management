<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this EntryController */

$this->breadcrumbs=array(
	'Form',
	$form->FORM_NAME,
);
?>

<h1><?php echo $form->FORM_NAME.' '.'<span style="color:#B40431">'.$model->TITLE.'</span>'; ?>
<?php echo CHtml::link('<i class="icon-pencil"></i>',array('edit', 'entry'=>$model->ID,'form'=>$form->FORM_ID),array('class'=>'btn-warning btn buttonDesign')); ?>
<?php echo CHtml::link('<i class="icon-trash"></i>','#',array('class'=>'btn-warning btn buttonDesign','submit'=>array('delete','entry'=>$model->ID,'form'=>$form->FORM_ID),'confirm'=>'Are you sure you want to delete this item?')); ?>
</h1>

<?php if(Yii::app()->user->hasFlash('entryMessage')): ?>
<div class="success">
	<?php echo Yii::app()->user->getFlash('entryMessage'); ?>
</div>
<?php endif; ?>

<table>
<tr>
<td>
<table class="table table-bordered">
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
            <th><?php echo CHtml::encode($field->TITLE); ?></th>
            <td><?php echo (($model->{$field->VARNAME})?$model->{$field->VARNAME}:''); ?></td>
			<?php } ?>
            </div>
        </div>
		<?php $i++; } }?>
        </tr>
</table>
</td>
<td>	
<?php
if(isset($_GET['form']) && $_GET['form'] == 16){			
$cartridges = Filedetails::model()->findAllByAttributes(array('fid'=>$model->ID));
 echo "<table class='table table-bordered'>";
 if(count($cartridges) != 0){
                 

   
     echo "<tr style='background:#F5A9A9;'><th colspan='4' style='text-align:center'>File Details</th></tr>";
    echo "<tr><th>Content</th><th>Updated By</th><th>Updated On</th></tr>";
     foreach($cartridges as $c){
		$cartridgeName4 = $c['id'];
        $cartridgeName = $c['content'];
        $cartridgeName2 = $c['updatedby'];
        $cartridgeName3 = $c['updatedon'];
        
        
   $user = User::model()->findByAttributes(array('id'=>$c['updatedby']));
	$temp=$user['name'];
	
$i=1;
       
            echo "<tr style='background:#F6E3CE'><td>$cartridgeName</td><td>$temp</td><td>$cartridgeName3</td></tr>";
			
               echo "<tr>";
                        
     

    }
 }else{
  echo "<tr style='background:#F5A9A9;'><th colspan='4' style='text-align:center'></th></tr>";   
 }
 echo "</table>";
}?>
</td>
</tr>
