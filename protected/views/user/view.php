<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this UserController */
/* @var $model User */
?>

<?php
$this->breadcrumbs=array(
	'Users'=>array('admin'),
	'Manage'=>array('admin'),
	'View '.$model->name,
);
?>

<h1>View User <span style="color:#B40431"><?php echo $model->name; ?></span>
<?php echo CHtml::link('<i class="icon-pencil"></i>',array('update', 'id'=>$model->id),array('class'=>'btn-warning btn buttonDesign','title'=>'Update')); ?>
<?php echo CHtml::link('<i class="icon-trash"></i>','#',array('class'=>'btn-warning btn buttonDesign','title'=>'Delete','submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')); ?>
</h1>

<table>
    <tr><td>
<?php $this->widget('ext.DetailView4Col',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'name',
		'password',
                'organisation_id',
		'pw_md5',
		'email',
		'phone',
		'phones',
		'mobile',
		'fn',
		'ln',
		'active',
		'id_auth',
		'auth_method',
		'last_login',
		'date_mod',
		'designation',
	),
)); ?>
        </td>
        <td>
<?php
        
        $grps = Usergroup::model()->findAllByAttributes(array('uid'=>$model->id));
        $depts = Userdept::model()->findAllByAttributes(array('uid'=>$model->id));
        
        echo "<table class='table table-bordered'>";
        if(count($depts) == 0)
           echo "<tr style='background:#F7819F;color:white'><td>$model->name doesn't belong to any department</td></tr>";
        else{   
            echo "<tr style='background:#F5A9A9;'><th colspan='2'>Departments</th></tr>";
            foreach($depts as $d){
                $department = Dept::model()->findByAttributes(array('id'=>$d['dept_id']));
                $deptName = $department['name'];
                echo "<tr><td colspan='2'>$deptName</td></tr>";
            }
        }
        if(count($grps) == 0)
           echo "<tr style='background:#F7819F;color:white'><td>$model->name doesn't belong to any group</td></tr>";
        else{   
            echo "<tr style='background:#F5A9A9;'><th colspan='2'>Groups</th></tr>";
            foreach($grps as $g){
                $group = Group::model()->findByAttributes(array('id'=>$g['gid']));
                $groupName = $group['name'];
                echo "<tr><td colspan='2'>$groupName</td></tr>";
            }
        }    
        echo "</table>";
?>
        </td>