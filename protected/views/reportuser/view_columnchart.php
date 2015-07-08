
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
    //array('label' => 'List Report', 'url' => array('index')),
    array('label' => 'Create Report', 'url' => array('create')),
    // array('label' => 'Update Report', 'url' => array('update', 'id' => $model->rid)),
    // array('label' => 'Delete Report', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->rid), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'View Report', 'url' => array('admin')),
);
?>

<h1>View Report</h1>

<?php
//$this->widget('zii.widgets.CDetailView', array(
//    'htmlOptions' => array(
//        'class' => 'table table-striped table-condensed table-hover',
//    ),
//    'data' => $model,
//    'attributes' => array(
//        'rid',
//        'name',
//        'timestamp',
//        'uid',
//        'description',
//    ),
//));
?>

<?php
$sql = "select name,query,description from report where rid=$model->rid";

$connection = Yii::app()->db;
$command = $connection->createCommand($sql);
$dataReader = $command->query();
$row = $dataReader->read();
$query = $row['query'];
$name = $row['name'];
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
        <td><fieldset ><legend><?php echo $name; ?></legend>
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
while ($row1 = $dataReader->read()) {
    ?>

                            <tr>
                            <?php
                            for ($i = 0; $i < $num_fields; $i++) {

                                //$v = $all_fields[$i];
                                $value = $row1[$arr_columns[$i]];
                                ?>
                                    <td><?php echo $value; ?></td>

                                <?php } ?>
                            </tr>

                            <?php } ?>

                    </tbody>
                </table>
            </fieldset>

        </td>
    </tr>
</table>
<?php
$sql1 = "select * from print_detail group by user";

//		$res=mysql_query($sql);
//		$data=mysql_fetch_array($res);
//		$series1['data'][] = $data['t'];

$connection = Yii::app()->db;
$command = $connection->createCommand($sql1);
$dataReader = $command->query();
//$row = $dataReader->read();
while ($row = $dataReader->read()) {
    $user = $row['user'];
    $category['data'][] = $row['user'];

    $sql2 = "select count(*) as t from print_detail where user='$user' and printer='hplaser'";
    $command1 = $connection->createCommand($sql2);
    $dataReader1 = $command1->query();
    $row1 = $dataReader1->read();
    $series1['data'][] = $row1['t'];
    
    
    $sql3 = "select count(*) as s from print_detail where user='$user' and printer='HP_LaserJet_CM1415fn'";
    $command2 = $connection->createCommand($sql3);
    $dataReader2 = $command2->query();
    $row2 = $dataReader2->read();
    $series2['data'][] = $row2['s'];
    

//    $sql3 = "select count(*) as s from print_detail where user='$user' and printer='HP_LaserJet_CM1415fn'";
//    $command2 = $connection->createCommand($sql3);
//    $dataReader2 = $command2->query();
//    $row2 = $dataReader2->read();
//    $series2['data'][] = $row2['s'];
}

$imp=implode(",",$series1['data']);
$tmp1=array();
$tmp2=array();
foreach($series1['data'] as $val)
{
    
    array_push($tmp1, intval($val));
}

foreach($series2['data'] as $val)
{
    
    array_push($tmp2, intval($val));
}
//var_dump($tmp1);

//$arr=array(1,2,3,1,0,27,1,9,3,1);
$arr1=$tmp1;
$arr2=$tmp2;



$this->Widget('ext.highcharts.HighchartsWidget', array(
    'options' => array(
        'title' => array('text' => 'Patient Visits By Day (Last Two Weeks)'),
        'xAxis' => array(
            //'categories' => array('14th','15th','16th','17th','18th','19th','20th','21th','22th','23th','24th','25th','26th','27th','28th')

            'categories' => $category['data']
        ),
        'yAxis' => array(
            'title' => array('text' => 'Number of Prints')
        //'categories' => array('14th','15th','16th','17th','18th','19th','20th','21th','22th','23th','24th','25th','26th','27th','28th')
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
            'type' => 'column'
        ),
        'title' => false,
        'series' => array(
            //array('name' => 'Hampton Office', 'data' => array(20, 25, 25,35, 30, 28,25, 27, 23, 24, 25, 26,27,28,33)),

            //array('name' => 'Hplaser', 'data' => $series1['data']),
           array('name' => 'Hplaser', 'data' => $arr1),
           
          // array('name' => 'Hplaser', 'data' => $arr_series),
            //
           // array('name' => 'color', 'data' => $series2),
            
            array('name' => 'HP_LaserJet_CM1415fn', 'data' =>$arr2),
        ),
    )
));
?>