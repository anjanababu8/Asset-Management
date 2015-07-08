<?php
/* @var $this BlockeditemController */
/* @var $model Blockeditem */
?>

<?php $commodity = Commodity::model()->findByPk($model->commodity_id);
      $commodityName = $commodity['name'];
?>
<?php
$this->breadcrumbs=array(
    ucfirst($commodityName)=>array("$commodityName/admin"),
        'Manage'=>array("$commodityName/admin"),
	'Blocked Items'=>Yii::app()->request->urlReferrer,
	'Update',
);

?>

    <h1>Update Blockeditem</h1>

<?php $this->renderPartial('_customUpdate', array('model'=>$model)); ?>