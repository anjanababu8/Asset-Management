<style>
    tfoot input {
        width: 50%;
        padding: 3px;
        box-sizing: border-box;
    }
    /*body { font-size: 62.5%; }*/
    label, input { display:block; }
    input.text { margin-bottom:12px; width:95%; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    h1 { font-size: 1.2em; margin: .6em 0; }
    div#users-contain { width: 350px; margin: 20px 0; }
    div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
    .ui-dialog .ui-state-error { padding: .3em; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
</style>

<script>
    $(document).ready(function() {
        
        $('#resultprint').css('display','none');
        // Setup - add a text input to each footer cell
        
        //alert($('#sub_btn').val());
        $('#example tfoot th').each( function () {
            var title = $('#example thead th').eq( $(this).index() ).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );
 
        // DataTable
        var table = $('#example').DataTable();
 
        // Apply the search
        table.columns().eq( 0 ).each( function ( colIdx ) {
            $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
                table
                .column( colIdx )
                .search( this.value )
                .draw();
            } );
        } );
    } );
    
    $(function() {
        var dialog, form,
 
 
        size = $( "#size" ),
        orient= $("#orient"),

        allFields = $( [] ).add( size ).add( orient ),
        tips = $( ".validateTips" );
 
 
        function addUser() {
            var valid = true;
            allFields.removeClass( "ui-state-error" );
     
            $( "#page_size" ).val(size.val());
            $( "#page_orient" ).val(orient.val());
    
            dialog.dialog( "close" );
            return valid;
        }
 
        dialog = $( "#dialog-form" ).dialog({
            autoOpen: false,
            height: 300,
            width: 400,
            modal: true,
            buttons: {
                "Apply": addUser,
                Cancel: function() {
                    dialog.dialog( "close" );
                }
            },
            close: function() {
                form[ 0 ].reset();
                allFields.removeClass( "ui-state-error" );
            }
        });
 
        form = dialog.find( "form" ).on( "submit", function( event ) {
            event.preventDefault();
            addUser();
        });
 
        $( "#create-user" ).button().on( "click", function() {
            dialog.dialog( "open" );
        });
    });
    
    
    jQuery(function($) {
        jQuery('body').delegate('#chart','change',function(){
            
            //alert("here");
            //alert($('#prnter').val());
           
            //            $("#combo_1").prop("disabled", false);
            //               
            //           
            //            //  alert($('#drive').val());
            jQuery.ajax({
                'url':'<?php echo Yii::app()->request->baseUrl; ?>/index.php/Report/Displaychart',
                'cache':false,
                'success':function(html){
                    jQuery("#disp_chart").html(html);
                    //jQuery('#btn').attr('disabled',false);
                },
                'error':function(jqXHR, textStatus){
                    alert("failed="+jqXHR.responseText);
                    
                }
            });
            return false;
        });
    });
</script>

<?php
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
// $cs->registerScriptFile($baseUrl.'/js/yourscript.js');
//echo "hiiiiii".$baseUrl;
//include('storage_system/css/_styles.css');
$cs->registerScriptFile($baseUrl . '/js/min.js');
$cs->registerScriptFile($baseUrl . '/js/min2.js');
$cs->registerCssFile($baseUrl . '/css/style.css');
$cs->registerCssFile($baseUrl . '/css/jquery-ui.css');
///$cs->registerScriptFile($baseUrl . '/js/jquery-form.js');
$cs->registerScriptFile($baseUrl . '/js/jquery-ui.js');

/* @var $this ReportController */
/* @var $model Report */
?>

<?php
$this->breadcrumbs = array(
    'Reports' => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => 'Create Report', 'url' => array('create')),
    array('label' => 'View Report', 'url' => array('admin')),
);
?>

<h1>View Report</h1>


<?php


$sql = "select name,query,description from reportloc where rid=$model->rid";

$connection = Yii::app()->db;
$command = $connection->createCommand($sql);
$dataReader = $command->query();
$row = $dataReader->read();
echo "<br>";
$query = $row['query'];
$report_name = $row['name'];
$description = $row['description'];


$connection = Yii::app()->db;
$command = $connection->createCommand($query);
$dataReader = $command->query();
$row1 = $dataReader->read();
//var_dump($row1);
//die();

$arr_columns = array();
$arr_data = array();
foreach ($row1 as $key => $value) {

    //echo  $key." = ".$value;

    if (!in_array($key, $arr_columns)) {
        array_push($arr_columns, $key);
    }
    array_push($arr_data, $value);
}

$num_fields = count($arr_columns);

// $num_fields = count($all_fields);
// echo $sql;
//die();
?>

<div id="dialog-form" title="Page Setup" style="height:150px;">

    <form>
        <fieldset>

            Select Size <br /><select name="size" id="size" class="text ui-widget-content ui-corner-all">


                <option value="A0">A0</option>
                <option value="A1">A1</option>
                <option value="A2">A2</option>
                <option value="A3">A3</option>
                <option value="A4" selected>A4</option>
                <option value="A5">A5</option>
                <option value="Letter">Letter</option>
                <option value="Legal">Legal</option>
                <option value="Executive">Executive</option>


            </select><br><br />
            Select Orientation <br /><select name="orient" id="orient" class="text ui-widget-content ui-corner-all">


                <option value="L">Landscape </option>
                <option value="P">portrait</option>

            </select>


            <!-- Allow form submission with keyboard without duplicating the dialog button -->
            <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
        </fieldset>
    </form>
</div>


<div style="display: inline-flex; width:800px;">

    <form name="test" id="test" method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/index.php/Report/Print">

        <?php
        $final_data = array();
        $final_data["columns"] = $arr_columns;

        $test = json_encode($final_data);
//echo $test;
        ?>

        <input type="hidden" name="hdn_qry" value="<?php echo $query; ?>">
        <input type="hidden" name="hdn_columns" value="<?php echo htmlspecialchars($test); ?>">
        <input type="hidden" name="id" value="<?php echo $model->rid; ?>">
        <input type="hidden" name="report_name" value="<?php echo $report_name; ?>">

        <?php
        echo CHtml::submitButton('Print', array('submit' => '<?php echo Yii::app()->request->baseUrl; ?>/index.php/Report/Print', 'class' => 'btn btn-primary btn-small'));
        ?>
    </form>
    &nbsp;  <div>
        <button id="create-user" class="btn btn-primary btn-small">Page Setup</button>
    </div>&nbsp;

    <form name="test1" id="test1" method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/index.php/Report/Pdf" target="_blank">

        <?php
        $final_data = array();
        $final_data["columns"] = $arr_columns;

        $test = json_encode($final_data);
//echo $test;
        ?>

        <input type="hidden" name="page_size" id="page_size">
        <input type="hidden" name="page_orient" id="page_orient">
        <input type="hidden" name="hdn_qry" value="<?php echo $query; ?>">
        <input type="hidden" name="hdn_columns" value="<?php echo htmlspecialchars($test); ?>">
        <?php
        echo CHtml::submitButton('Save as Pdf', array('submit' => '<?php echo Yii::app()->request->baseUrl; ?>/index.php/Report/Pdf', 'class' => 'btn btn-primary btn-small'), array('' => ''));
        ?>
    </form>&nbsp;



</div>



<table border="0" align="center" width="100%" >

    <tr>
        <td><fieldset ><legend><?php echo $report_name; ?></legend>
                <table>
                    <tr>
                        <td colspan="10">
                            <b>Report Description:</b> <?php echo $description; ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="10" height="20px">

                        </td>
                    </tr>
                </table>
                <table id="example" class="display" cellspacing="0" width="100%">

                    <thead>
                        <tr>
                            <th>Sr. No</th>
                            <?php
                            for ($i = 0; $i < $num_fields; $i++) {
                                $v = $arr_columns[$i];
                                $v_n = ucfirst($v);
                                ?>
                                <th align="left"><?php echo $v_n; ?></th>

                            <?php } ?>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sr. No</th>
                            <?php
                            for ($i = 0; $i < $num_fields; $i++) {
                                $v = $arr_columns[$i];
                                $v_n = ucfirst($v);
                                ?>
                                <th align="left"><?php echo $v_n; ?></th>

                            <?php } ?>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $dataReader = $command->query();
                        $cnt=1;
                        while ($row1 = $dataReader->read()) {
                            ?>
                        
                            <tr>
                                <td><?php echo $cnt;?></td>
                                <?php
                                for ($i = 0; $i < $num_fields; $i++) {

                                    //$v = $all_fields[$i];
                                    $value = $row1[$arr_columns[$i]];
                                    ?>
                                    <td><?php echo $value; ?></td>

                                <?php } ?>
                            </tr>

                        <?php 
                        
                        $cnt++;
                        } ?>

                    </tbody>
                </table>
            </fieldset>

        </td>
    </tr>
</table>




<?php
$sql1 = $query;

$arr_colname = array();
$arr_coltype = array();

$connection = Yii::app()->db;
$command = $connection->createCommand($sql1);
$reader = $command->query();
$pdoStatement = $command->getPdoStatement();
$headers = array();

for ($i = 0; $i < $reader->columnCount; $i++) {
    $meta = $pdoStatement->getColumnMeta($i);

    $name = $meta['name'];
    $native_type = $meta['native_type'];

    if ($native_type == "LONGLONG") {
        array_push($arr_colname, $name);
        array_push($arr_coltype, $native_type);
    }
}

//print_r($arr_coltype);


//$connection = Yii::app()->db;
//$command = $connection->createCommand($sql1);
////var_dump($command->queryScalar());
//$dataReader = $command->query();
//
//$cnt = 0;
//if (isset($_POST['x_axis'])) {
//
//    $g_name = $_POST['x_axis'];
//    $x_col = $_POST['x_axis'];
//} else {
//    $x_col = "user";
//    $g_name = "";
//}
//
//
//
//$arr_printer = array();
//
//$arr_arrdata = array();
//$num = array();
//while ($row = $dataReader->read()) {
//
//    $printer = $row['printer'];
//
//    if (isset($_POST['y_axis'])) {
//        array_push($num, intval($row[$_POST['y_axis']]));
//    }
//
//
//    $user = $row[$x_col];
//    $category['data'][] = $row[$x_col];
//
//    $arr_data = array();
//
//    $sql2 = "select count(*) as t from print_detail where $x_col='$user'";
//    $command1 = $connection->createCommand($sql2);
//    $dataReader1 = $command1->query();
//    $row1 = $dataReader1->read();
//    $series1['data'][] = $row1['t'];
//
//
//
//    $cnt++;
//}
//
//
//$imp = implode(",", $series1['data']);
//$tmp1 = array();
//
//foreach ($series1['data'] as $val) {
//
//    array_push($tmp1, intval($val));
//}
//
//
//$arr1 = $tmp1;
//
//$user_prints = array();
//
//if (isset($_POST['y_axis'])) {
//    for ($i = 0; $i < $cnt; $i++) {
//        $tmp_array = array();
//        array_push($tmp_array, $category['data'][$i], intval($num[$i]));
//
//        array_push($user_prints, $tmp_array);
//    }
//}
?>

<div id="disp_chart">

</div>



<?php
//print_r($arr1);
if (isset($_POST['view'])) {
    $name = $_POST['chart_name'];

    if ($name == "column") {
        $type = "column";
    } else if ($name == "line") {
        $type = "line";
    }

    if ($name == "column" or $name == "line") {
        $this->Widget('ext.highcharts.HighchartsWidget', array(
            'options' => array(
                'title' => array('text' => 'Patient Visits By Day (Last Two Weeks)'),
                'xAxis' => array(
                    'categories' => $category['data']
                ),
                'yAxis' => array(
                    'title' => array('text' => 'Number of Prints'),
                ),
                'colors' => array('#6AC36A', '#FFD148', '#0563FE', '#FF2F2F'),
                'gradient' => array('enabled' => true),
                'credits' => array('enabled' => false),
                'exporting' => array('enabled' => false),
                'chart' => array(
                    'plotBackgroundColor' => '#ffffff',
                    'plotBorderWidth' => null,
                    'plotShadow' => false,
                    'height' => 400,
                    'type' => $type
                ),
                'title' => false,
                'series' => array(
                    array('name' => $g_name, 'data' => $num),
                ),
            )
        ));
    } else if ($name == "pie") {

        echo "<br>";

        echo "<span><h4>" . $g_name . "</h4></span>";
        $this->Widget('ext.highcharts.HighchartsWidget', array(
            'options' => array(
                // 'colors'=>array('#6AC36A', '#FFD148', '#0563FE', '#FF2F2F', '#000000'),
                //'colors'=>array('#FFD148', '#0563FE', '#FF2F2F', '#000000'),
                'gradient' => array('enabled' => true),
                'credits' => array('enabled' => false),
                'exporting' => array('enabled' => false),
                'chart' => array(
                    'plotBackgroundColor' => '#ffffff',
                    'plotBorderWidth' => null,
                    'plotShadow' => false,
                    'height' => 400,
                ),
                'title' => true,
                'tooltip' => array(
                    // 'pointFormat' => '{series.name}: <b>{point.percentage}%</b>',
                    // 'percentageDecimals' => 1,
                    'formatter' => 'js:function() { return this.point.name+":  <b>"+Math.round(this.point.percentage)+"</b>%"; }',
                //the reason it didnt work before was because you need to use javascript functions to round and refrence the JSON as this.<array>.<index> ~jeffrey
                ),
                'plotOptions' => array(
                    'pie' => array(
                        'allowPointSelect' => true,
                        'cursor' => 'pointer',
                        'dataLabels' => array(
                            'enabled' => true,
                            'color' => '#AAAAAA',
                            'connectorColor' => '#AAAAAA',
                        ),
                        'showInLegend' => true,
                    )
                ),
                'series' => array(
                    array(
                        'type' => 'pie',
                        'name' => 'Percentage',
                        'data' => $user_prints
                    ),
                ),
            )
        ));

        echo "---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------";

        echo "<br>";
    }
}
?>