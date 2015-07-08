<!DOCTYPE html PUBLIC"-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>insert page</title></head>

<?php
ini_set('max_execution_time', 0);
ini_set("memory_limit", "2G");

//$mpdf->packTableData = true;


$sql = $_POST['hdn_qry'];

$test=$_POST['hdn_columns'];
$test1 = json_decode($test);

$sql=$sql;

$fields = $test1->{'columns'};
$all_fields=array();

//var_dump($fields);

//die();

foreach ($fields as $key => $value) {

            //echo $value;
        array_push($all_fields, $value);
    }

    
 

$connection = Yii::app()->db;
$command = $connection->createCommand($sql);
$dataReader = $command->query();
$num_fields = count($all_fields);


//echo "hiiiii"?>
    <?php
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
// $cs->registerScriptFile($baseUrl.'/js/yourscript.js');
//echo "hiiiiii".$baseUrl;
//include('storage_system/css/_styles.css');
//$cs->registerScriptFile($baseUrl . '/js/min.js');
//$cs->registerScriptFile($baseUrl . '/js/min2.js');
//$cs->registerCssFile($baseUrl . '/css/style.css');?>
    
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

    <body>
<table id="example" class="display">
    <tr>
        
<td>Sr. No</td>
        
        
        <?php
                                for ($i = 0; $i < $num_fields; $i++) {
                                    $v = $all_fields[$i];
                                    $v_n = ucfirst($v);
                                    ?>
                                    
                                     <td><b><?php echo $v_n; ?></b></td>

                                <?php } ?>
    </tr>

        
       
                            <?php
                            $cnt=1;
                            while ($row = $dataReader->read()) {
                                ?>

                                <tr>
                                    <td><?php echo $cnt;?></td>
                                     <?php
                                    for ($i = 0; $i < $num_fields; $i++) {

                                        $v = $all_fields[$i];
                                        $value = $row[$v];
                                        ?>
                                        <td><?php echo $value; ?></td>

                                    <?php } ?>
                                    
                                </tr>

                            <?php
                            
                            $cnt++;
                            } ?>
   
    
</table>
    </body>

