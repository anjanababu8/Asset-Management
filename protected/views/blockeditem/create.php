<?php
/* @var $this BlockeditemController */
/* @var $model Blockeditem */
?>

<?php $commodity = Commodity::model()->findByAttributes(array('id'=>$_GET['commodity_id'])); 
      $commodityName = $commodity['name'];
?>
<?php
$this->breadcrumbs=array(
        ucfirst($commodityName)=>array("$commodityName/admin"),
        'Manage'=>array("$commodityName/admin"),
	'Block Item',
);

?>

<h1>Block <span style="color:#B40431">Item</span></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>