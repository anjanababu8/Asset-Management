


<?php
/* @var $this NewController */

$this->breadcrumbs=array(
	'New',
);
?>

<?php $commodityId = $_GET['commodityId'];
$existingPath = "location.href='".Yii::app()->homeUrl."/template/admin?commodityId=$commodityId"."'";
$newPath = "location.href='".Yii::app()->homeUrl."/fm/forms/new'";
$modify = "location.href='".Yii::app()->homeUrl."/fm/forms/index'";
?>
<div class="well offset4 span3" >
    <div class="radio">	
        <input type="radio" 
               name="choice" 
               onclick=<?php echo $existingPath;?>
               value="use_existing_table"> Use Existing Template
    </div>
    <div class="radio">
        <input type="radio" 
               name="choice" 
               onclick=<?php echo $newPath;?>
               value="create_new"> Create New Template
    </div>
    <div class="radio">
        <input type="radio" 
               name="choice" 
               onclick=<?php echo $modify;?>
               value="modify_existing"> Modify Existing Template
    </div>
</div>

