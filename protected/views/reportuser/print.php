    
<style>
    table { 
color: #333; /* Lighten up font color */
font-family: Helvetica, Arial, sans-serif; /* Nicer font */
width: 640px; 
border-collapse: 
collapse; border-spacing: 0; 
}

td, th { border: 1px solid #CCC; height: 30px; } /* Make cells a bit taller */

th {
background: #F3F3F3; /* Light grey background */
font-weight: bold; /* Make sure they're bold */
}

td {
background: #FAFAFA; /* Lighter grey background */
text-align: center; /* Center our text */
}
</style>

<?php

$sql = $_POST['hdn_qry'];

$test=$_POST['hdn_columns'];
$report_name=$_POST['report_name'];

$test1 = json_decode($test);



$fields = $test1->{'columns'};
$all_fields=array();

foreach ($fields as $key => $value) {

           
        array_push($all_fields, $value);
    }

    
 

$connection = Yii::app()->db;
$command = $connection->createCommand($sql);
$dataReader = $command->query();
$num_fields = count($all_fields);


?>

<?php
       $this->widget('ext.mPrint.mPrint', array(
            'title' => 'Report',        //the title of the document. Defaults to the HTML title
            'tooltip' => 'Report',    //tooltip message of the print icon. Defaults to 'print'
            'text' => 'Print Results', //text which will appear beside the print icon. Defaults to NULL
            'element' => '#resultprint',      //the element to be printed.
            'exceptions' => array(     //the element/s which will be ignored
                '.summary',
                '.search-form'
            ),
            'publishCss' => true,       //publish the CSS for the whole page?
            'id' => 'resultprintid'
            //'style'=>'float: right; padding: 5px; margin-top: -5px;'                       
        ));
  ?>
<br/>
<br/>
<h3>Print Preview</h3>
<div id="resultprint" width="1024px;" style=" height:500px;position: relative; overflow: auto;">
    
    <table  cellspacing="0">

                      
                            <tr>
                                
                                <?php
                                for ($i = 0; $i < $num_fields; $i++) {
                                    $v = $all_fields[$i];
                                    $v_n = ucfirst($v);
                                    ?>
                                    <th align="left"><?php echo $v_n; ?></th>

                                <?php } ?>
                                
                             
                            </tr>
                      
                            <?php
                            
                           
                            while ($row = $dataReader->read()) {
                                ?>

                                <tr>
                                    
                                     <?php
                                    for ($i = 0; $i < $num_fields; $i++) {

                                        $v = $all_fields[$i];
                                        $value = $row[$v];
                                        //echo $v;
                                        ?>
                                        <td><?php echo $value; ?></td>

                                    <?php } ?>
                                    
                                </tr>

                            <?php } ?>


                    </table><?php ?>
    
</div>

<?php //echo CHtml::button('Back',array('name' => 'btnBack','onclick'=>'js:history.go(-1);returnFalse;','class'=>'uibutton loading confirm', 'class' => 'btn btn-primary btn-small'));?>


<form name="test" id="test" method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/index.php/Report/Backbtn">

    <?php $final_data = array();
          $final_data["columns"] = $all_fields;

          $test = json_encode($final_data);?>
 <input type="hidden" name="qry" value="<?php echo $sql; ?>">
 <input type="hidden" name="hdn_columns" value="<?php echo htmlspecialchars($test); ?>">
 <input type="hidden" name="report_name" value="<?php echo $report_name; ?>">
 
 <?php if(isset($_POST['id']))
 {?>
 <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
<?php  }?>

 <?php
 
 if(isset($_POST['id']))
 {
       echo CHtml::submitButton('Back', array('submit' => Yii::app()->request->baseUrl.'/index.php/Report/Backbtnview', 'class' => 'btn btn-primary btn-small'));
 }
 else
 {
     echo CHtml::submitButton('Back', array('submit' => Yii::app()->request->baseUrl.'/index.php/Report/Backbtn', 'class' => 'btn btn-primary btn-small'));
 }
       ?>
</form>