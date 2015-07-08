<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this UsergroupController */
/* @var $model Usergroup */
?>

<?php
$this->breadcrumbs=array(
	'Usergroups'=>array('admin'),
	'Create',
);

?>

<h1>Create Usergroup</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>