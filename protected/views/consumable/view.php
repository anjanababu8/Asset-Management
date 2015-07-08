<html>
    <style>
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
    </style>
</html>
<?php
/* @var $this ConsumableController */
/* @var $model Consumable */
?>

<?php
$this->breadcrumbs=array(
        'Consumable'=>array('admin'),
        'Manage'=>array('admin'),
	'View '.$model->name,
);
?>

<h1>View Consumable <span style="color:#B40431"><?php echo $model->name; ?></span>
<?php echo CHtml::link('<i class="icon-pencil"></i>',array('update', 'id'=>$model->id),array('class'=>'btn-warning btn buttonDesign')); ?>
<?php echo CHtml::link('<i class="icon-trash"></i>','#',array('class'=>'btn-warning btn buttonDesign','submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')); ?>
</h1>

<?php $this->widget('ext.DetailView4Col',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'name',
                //array('name'=>'commodity.name','header'=>'Commodity'),
                'category_id',
                //array('name'=>'category.name','header'=>'Category'),
                array('name'=>'location.name','label'=>'Location'),
		array('name'=>'user.name','label'=>'Technical Incharge'),
		array('name'=>'status.status','label'=>'Status'),
		array('name'=>'manufacturer.name','label'=>'Manufacturer'),
		array('name'=>'consumabletype.name','label'=>'Consumable Type'),
		array('name'=>'managementtype.name','label'=>'Management Type'),
                array('name'=>'status.status','label'=>'Status'),
		'model',
		'threshold',
		'imageFileName',
		'documentFileName',
		'enable_financial',
		'available_on_loan',
		'semi_consumable',
                'link_to'
	),
)); ?>
<?php
        
        $link = Link::model()->findByAttributes(array('commodity2_id'=>$model->commodity_id));
        echo "<table class='table table-bordered'>";
        if(count($link) == 0)
           echo "<tr style='background:#F7819F;color:white'><td>No Commodity Linked to $model->name</td></tr>";
        else{    
            $commodity = Commodity::model()->findByAttributes(array('id'=>$link['commodity1_id']));
            $commodityItems = $commodity['name']::model()->findAllByAttributes(array('link_to'=>$model->id));


            if(count($commodityItems) != 0){
                echo "<tr style='background:#F5A9A9;'><th colspan='4' style='text-align:center'>Linked ".$commodity['name']." Allocate History</th></tr>";
                foreach($commodityItems as $c){
                    $cartridgeName = $c['name'];
                    $fullallocates = Allocate::model()->findAll("commodity_id =:commodity_id AND cons_id=:cons_id",array('commodity_id'=>12,'cons_id'=>$c['id']));
                    $allocates = Allocate::model()->findAll("commodity_id =:commodity_id AND cons_id=:cons_id AND given_by IS NOT NULL",array('commodity_id'=>12,'cons_id'=>$c['id']));
                    $total = count($fullallocates);
                    $allocated = count($allocates);

                echo "<tr style='background:#F6E3CE'><th colspan='4'>$cartridgeName <code>$allocated / $total allocated</code></th></tr>";

                if(count($allocates) != 0){
                    echo "<tr><th>Date Out</th><th>Allocated By</th><th>Allocated To</th></tr>";
                    foreach($allocates as $a){
                       echo "<tr>";

                       $date_out = $a['date_out'];echo "<td>";echo Yii::app()->dateFormatter->format(Yii::app()->locale->getDateFormat("long"),
                                                CDateTimeParser::parse($date_out, 'yyyy-mm-dd'));echo "</td>";

                       $given_by = User::model()->findByPk($a['given_by']);$givenBy = $given_by['name'];echo "<td>$givenBy</td>";
                       if($a['user_group'] == 'U'){
                           $given_to = User::model()->findByPk($a['given_to']);$givenTo = $given_to['name'];echo "<td>$givenTo</td>";
                       }else if($a['user_group'] == 'G'){
                           $given_to = Group::model()->findByPk($a['given_to']);$givenTo = $given_to['name'];echo "<td>$givenTo</td>";
                       }
                       echo "</tr>";
                    }
                }else{
                    echo "<tr><td><i>None Allocated</i></td></tr>";
                }

            }
            }else{
            echo "<tr style='background:#F5A9A9;'><th colspan='4' style='text-align:center'>No ".$commodity['name'] ." Linked</th></tr>";   
            }
            }
 echo "</table>";
?>