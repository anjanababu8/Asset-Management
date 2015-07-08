<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
        #centerDiv{
     position:absolute;
     z-index:15;
     top:50%;
     left:40%;
     margin:-100px 0 0 -150px;
    // background:#424242;
}
    </style>
<?php
/* @var $this UserController */
/* @var $model User */


$this->breadcrumbs=array(
	'Users'=>array('admin'),
	'Manage',
);

?>
<div id='centerDiv'>
      
<table class="" border='0'>
    <tr>
        <td><button type="button" class="btn btn-danger" style="width:120px;height:70px" onclick=<?php echo "location.href='".Yii::app()->homeUrl."/organisation/admin'"?>><img src='/asset_management/images/control_panel/organisation.png'>Organisations</button></td>
        <td></td>
        <td><button type="button" class="btn btn-danger" style="width:120px;height:70px"onclick=<?php echo "location.href='".Yii::app()->homeUrl."/dept/admin'"?>><img src='/asset_management/images/control_panel/department.png'><br/>Departments</button></td>
    </tr>
    <tr>
        <td><button type="button" class="btn btn-warning" style="width:120px;height:70px" onclick=<?php echo "location.href='".Yii::app()->homeUrl."/location/tree'"?>><img src='/asset_management/images/control_panel/location.png'><br/>Locations</button></td>
        <td><button type="button" class="btn btn-default" style="width:120px;height:70px" onclick=<?php echo "location.href='".Yii::app()->homeUrl."/supplier/admin'"?>><img src='/asset_management/images/control_panel/supplier.png'><br/>Suppliers</button></td>
        <td><button type="button" class="btn btn-warning" style="width:120px;height:70px" onclick=<?php echo "location.href='".Yii::app()->homeUrl."/manufacturer/admin'"?>><img src='/asset_management/images/control_panel/manufacturer.png'>Manufacturers</button></td>
        
        
    </tr>
    <tr style="text-align:center">
        <td><button type="button" class="btn btn-default" style="width:120px;height:70px" onclick=<?php echo "location.href='".Yii::app()->homeUrl."/category/admin'"?>><img src='/asset_management/images/control_panel/categories.png'><br/>Categories</button></td>
        <td><button type="button" class="btn btn-warning" style="width:120px;height:70px" onclick=<?php echo "location.href='".Yii::app()->homeUrl."/status/admin'"?>><img src='/asset_management/images/control_panel/status.png'><br/>Status</button></td>
        <td><button type="button" class="btn btn-default" style="width:120px;height:70px" onclick=<?php echo "location.href='".Yii::app()->homeUrl."/commodity/admin'"?>><img src='/asset_management/images/control_panel/commodity.png'>Commodities</button></td>
    </tr>
    <tr>
        
        <td><button type="button" class="btn btn-danger" style="width:120px;height:70px" onclick=<?php echo "location.href='".Yii::app()->homeUrl."/group/admin'"?>><img src='/asset_management/images/control_panel/group.png'><br/>Groups</button></td>
        <td></td>
        <td><button type="button" class="btn btn-danger" style="width:120px;height:70px" onclick=<?php echo "location.href='".Yii::app()->homeUrl."/user/admin'"?>><img src='/asset_management/images/control_panel/user.png'><br/>Users</button></td>
    </tr>
    
</table>
</div>
</html>

