
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
        //$("#example").css("width","50%")
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
     // orient= $("#orient"),
     orient=$( "form input:radio" ),

      allFields = $( [] ).add( size ).add( orient ),
      tips = $( ".validateTips" );
 
 
    function addUser() {
        
         //alert($('input[name$="orient"]:checked').val());
      var valid = true;
      allFields.removeClass( "ui-state-error" );
     
    $( "#page_size" ).val(size.val());
    $( "#page_orient" ).val($('input[name$="orient"]:checked').val());
    
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
        jQuery('body').delegate('#sub_btn','click',function(){

            //alert("got here");
            var qry=$('#qry').val();
            var report_name=$('#report_name').val();
            //alert(qry);
            
            //alert($('#drive').val());
            jQuery.ajax({
                'url':'<?php echo Yii::app()->request->baseUrl; ?>/index.php/Sample/Testchk?qry="'+qry+'"&name="'+report_name+'"',
                'cache':false,
                'success':function(html){
                    //alert(html);
                    //jQuery("#new").html(html);
                    
                    
                    if(html==1)
                    {
                        alert("Report saved Successfully");
                        $('#sub_btn').val('Report Saved');
                        jQuery('#sub_btn').attr('disabled',true);
                        // jQuery('#sub_btn').attr('value',true);
                    }
                    //jQuery('#btn').attr('disabled',false);
                }
            });
            return false;
        });
    });
    
    
    jQuery(function($) {
        jQuery('body').delegate('#print_btn','click',function(){
            var qry=$('#qry').val();
            $('#change').css('display','none');
            $('#resultprint').css('display','block');
                
            return false;
        });
    });
    
    jQuery(function($) {
        jQuery('body').delegate('#pdf_btn','click',function(){

            //alert("got here");
            //var qry=$('#qry').val();
            // var report_name=$('#report_name').val();
            //alert(qry);
            
            //alert($('#drive').val());
            jQuery.ajax({
                'url':'<?php echo Yii::app()->request->baseUrl; ?>/index.php/Report/Print',
                'cache':false,
                'success':function(html){
                    //alert(html);
                    jQuery("#new").html(html);
      
                }
            });
            return false;
        });
    });
    




    
    

</script>

<?php //echo CHtml::link('Home', array('site/index')); ?>


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





if (isset($final_data)) {
    $test1 = json_decode($final_data);
    //echo "done";
    $report_name = $test1->{'report_name'};
    $description = $test1->{'description'};
    $tables = $test1->{'table'};
    $conditions = $test1->{'condition'};
    $fields = $test1->{'select_fields'};
    if(isset($test1->{'having'}))
    {
        $having=$test1->{'having'};
    }
     if(isset($test1->{'group'}))
    {
        $group=$test1->{'group'};
    }
    
    
    
   
    //print_r($conditions);
    

    $all_fields = array();
//var_dump($test1->{'table'}[0]);

    $sql = "select ";
    
    //print_r($tables);
   // die();


//echo $report_name;
//echo var_dump($fields->{'txt_field_type'});
    if (isset($fields->{'txt_field_subentity'})) {
        foreach ($fields->{'txt_field_subentity'} as $key => $value) {

            // echo $value;



              $sql.=$tables[0] . "." . $value . " ,";
            array_push($all_fields, $value);
        }
    }

//echo "<br>";

    $cnt_tbl=count($tables);
    
    if (isset($fields->{'txt_field_consumable'})) {
        foreach ($fields->{'txt_field_consumable'} as $key => $value) {

             if($value=="locations_id")
             {
                 
             }
            $sql.=$tables[1] . "." . $value . " ,";
            array_push($all_fields, $value);
        }
    }
        if (isset($fields->{'txt_field_user'})) {
        foreach ($fields->{'txt_field_user'} as $key => $value) {

            $sql.=$tables[$cnt_tbl-1] . "." . $value . " ,";
            array_push($all_fields, $value);
        }
    }
    
   // die();
    if (isset($fields->{'count'})) {
        //echo $value;
            $sql.=$fields->{'count'} . " ,";
            array_push($all_fields, "total");
       
    }

    
        if (isset($fields->{'new'})) {
        //echo $value;
            $sql.=$fields->{'new'} . " ,";
            array_push($all_fields, "new");
       
    }
         if (isset($fields->{'used'})) {
        //echo $value;
            $sql.=$fields->{'used'} . " ,";
            array_push($all_fields, "used");
       
    }
    
          if (isset($fields->{'threshold'})) {
        //echo $value;
            $sql.=$fields->{'threshold'} . " ,";
            array_push($all_fields, "difference");
       
    }
    
          if (isset($fields->{'location'})) {
        //echo $value;
            $sql.=$fields->{'location'} . " ,";
            array_push($all_fields, "location");
       
    }
          if (isset($fields->{'consumableItemType'})) {
        //echo $value;
            $sql.=$fields->{'consumableItemType'} . " ,";
            array_push($all_fields, "consumableItemType");
       
    }
           if (isset($fields->{'manufacturers'})) {
        //echo $value;
            $sql.=$fields->{'manufacturers'} . " ,";
            array_push($all_fields, "manufacturers");
       
    }
               if (isset($fields->{'alarm'})) {
        //echo $value;
            $sql.=$fields->{'alarm'} . " ,";
            array_push($all_fields, "alarm_threshold");
       
    }
    if (isset($fields->{'num'})) {
        //echo $value;
            $sql.=$fields->{'num'} . " ,";
            array_push($all_fields, "num");
       
    }
       if (isset($fields->{'entity_name'})) {
        //echo $value;
            $sql.=$fields->{'entity_name'} . " ,";
            array_push($all_fields, "entity_name");
       
    }
          if (isset($fields->{'consumable_name'})) {
        //echo $value;
            $sql.=$fields->{'consumable_name'} . " ,";
            array_push($all_fields, "consumable_name");
       
    }
          if (isset($fields->{'user_name'})) {
        //echo $value;
            $sql.=$fields->{'user_name'} . " ,";
            array_push($all_fields, "user_name");
       
    }
     if (isset($fields->{'date'})) {
        //echo $value;
            $sql.=$fields->{'date'} . " ,";
            array_push($all_fields, "date_out");
       
    }
    
    
    
    //die();

    $sql = substr($sql, 0, -1);
//echo $sql;
//echo "<br>"."<br>";

      $sql = $sql . " from ";

    $tble_cnt = count($tables);

    for ($i = 0; $i < $tble_cnt; $i++) {
        if ($i == 0) {
            $sql.=$tables[$i];
        }
        if ($tables[$i]=="glpi_consumableitems") {
            $sql.=" inner join " . $tables[$i] . " on glpi_entities.id=glpi_consumableitems.entities_id ";
        }
     
        if($tables[$i]=="glpi_locations")
        {
             $sql.=" left join " . $tables[$i] . " on glpi_consumableitems.locations_id=glpi_locations.id";
        }
        if($tables[$i]=="glpi_consumableitemtypes")
        {
             $sql.=" left join " . $tables[$i] . " on glpi_consumableitems.consumableitemtypes_id=glpi_consumableitemtypes.id";
        }
           if($tables[$i]=="glpi_manufacturers")
        {
             $sql.=" left join " . $tables[$i] . " on glpi_consumableitems.manufacturers_id=glpi_manufacturers.id";
        }
           if ($tables[$i]=="glpi_consumables") {
            $sql.=" inner join " . $tables[$i] . " on glpi_consumableitems.id=glpi_consumables.consumableitems_id ";
        }
           if ($tables[$i]=="glpi_users") {
            $sql.=" inner join " . $tables[$i] . " on glpi_consumables.items_id=glpi_users.id ";
        }
    }
    
       if (count($conditions) != 0) {
        $sql = $sql . " where ";
    }
//    foreach ($conditions as $value) {
//
//        $sql.=" " . $value . " and";
//        //echo $value;
//    }
  foreach ($conditions as $value) {

        $sql.=" " . $value . " and";
        //echo $value;
    }
    

//$sql = substr($sql, 0, -3);

//echo $sql;
//die();
    $and_remove = array();


    if ((count($conditions) != 0)) {

        $sql = substr($sql, 0, -3);
    }
    
//    if(in_array("glpi_consumables", $tables))
//    {
//        $sql.="group by glpi_consumableitems.id";
//    }
    
    if(isset($test1->{'group'}))
    {
        $sql.=$group;
    }
     if(isset($test1->{'having'}))
    {
        $sql.=$having;
    }
    
    
} 
else {
   // echo "here";
    $sql = $_POST['qry'];
    $column = $_POST['hdn_columns'];

    $test12 = json_decode($column);


    $columns = $test12->{'columns'};


    $all_fields = array();
    $all_fields = $columns;

    $report_name = $_POST['report_name'];
    $description = "";
}
?>

<div id="dialog-form" title="Page Setup" style="height:150px;">

  <form>
    <fieldset>
    
        <b>Select Size </b><br /><select name="size" id="size" class="text ui-widget-content ui-corner-all">
          
          
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
      <!--Select Orientation <br /><select name="orient" id="orient" class="text ui-widget-content ui-corner-all">
          
          
          <option value="L">Landscape </option>
          <option value="P">portrait</option>
          
          
    
      </select>-->
      <b>Select Orientation </b><br />
      <div style="display:inline-flex;">   
        <input type="radio" name="orient" value="L">Landscape&nbsp;&nbsp;
        <input type="radio" name="orient" value="P">portrait
      </div>
 
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>

       
           

      

<div style="display: inline-flex; width:800px;">
    <div>
        <input type="button" name="btn" id="sub_btn" value="Save Report" class="btn btn-primary btn-small">
    </div> &nbsp;
    
    <form name="test" id="test" method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/index.php/Report/Print">

<?php
$final_data = array();
$final_data["columns"] = $all_fields;

$test = json_encode($final_data);
//echo $test;
?>

        <input type="hidden" name="hdn_qry" value="<?php echo $sql; ?>">
        <input type="hidden" name="hdn_columns" value="<?php echo htmlspecialchars($test); ?>">
        <input type="hidden" name="report_name" value="<?php echo $report_name; ?>">

        <?php
        echo CHtml::submitButton('Print', array('submit' => '<?php echo Yii::app()->request->baseUrl; ?>/index.php/Report/Print', 'class' => 'btn btn-primary btn-small'));
        ?>
    </form>&nbsp;
    <div>
    <button id="create-user" class="btn btn-primary btn-small">Page Setup</button>
    </div>&nbsp;
    <form name="test1" id="test1" method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/index.php/Report/Pdf" target="_blank">

<?php
$final_data = array();
$final_data["columns"] = $all_fields;

$test = json_encode($final_data);
//echo $test;
?>
         
        <input type="hidden" name="page_size" id="page_size">
        <input type="hidden" name="page_orient" id="page_orient">
        <input type="hidden" name="hdn_qry" value="<?php echo $sql; ?>">
        <input type="hidden" name="hdn_columns" value="<?php echo htmlspecialchars($test); ?>">
        
        

        
        <?php
        echo CHtml::submitButton('Save as Pdf', array('submit' => '<?php echo Yii::app()->request->baseUrl; ?>/index.php/Report/Pdf', 'class' => 'btn btn-primary btn-small'), array('' => ''));
        ?>
    </form>&nbsp;
    

</div>

<div width="1024px;" style=" height:600px;position: relative; overflow: auto;">
    <table border="0" align="center" width="70%" >

        <tr>
            <td><fieldset ><legend><?php  echo $report_name;  ?></legend>

<?php

//die();
$connection = Yii::app()->db;
$command = $connection->createCommand($sql);
$dataReader = $command->query();
$num_fields = count($all_fields);

 //echo $sql;

 
?>




<!-- <input type="button" name="btn" id="print_btn" value="Print Report" class="btn btn-primary btn-small">

<input type="button" name="btn" id="pdf_btn" value="Save as Pdf" class="btn btn-primary btn-small">-->




                    <br />


                    
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
                    <table id="example" class="display" cellspacing="0">

                        <thead>
                            <tr>
                                <th>Sr. No</th>
<?php
for ($i = 0; $i < $num_fields; $i++) {
    $v = $all_fields[$i];
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
                                    $v = $all_fields[$i];
                                    $v_n = ucfirst($v);
                                    ?>
                                    <th align="left"><?php echo $v_n; ?></th>

                                <?php } ?>
                            </tr>
                        </tfoot>
                        <tbody>
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



                        </tbody>
                    </table>
                   
                </fieldset>

            </td>
        </tr>
    </table>
</div>
<input type="hidden" name="qry" id="qry" value="<?php echo $sql; ?>">
<input type="hidden" name="report_name" id="report_name" value="<?php echo $report_name; ?>">

<div id="testbox">
</div>

<div id="new">



</div>


<?php ?>
