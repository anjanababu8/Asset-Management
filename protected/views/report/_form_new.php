<?php
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
// $cs->registerScriptFile($baseUrl.'/js/yourscript.js');
//echo "hiiiiii".$baseUrl;
//include('storage_system/css/_styles.css');
$cs->registerScriptFile($baseUrl . '/js/jquery-1.11.1.min.js');
?>


<script type="text/javascript">


    $(document).ready(function() {
        
        $("#combo_0").prop("disabled", true);
        $("#combo_1").prop("disabled", true);
        $("#combo_2").prop("disabled", true);
        $("#combo_3").prop("disabled", true);
    } );
     
    //    jQuery(function($) {
    //        jQuery('body').delegate('#entity','change',function(){
    //          
    //           
    //            $("#combo_1").prop("disabled", false);
    //               
    //        
    //            jQuery.ajax({
    //                'url':'<?php //echo Yii::app()->request->baseUrl;  ?>/index.php/Sample/Dispcombo_entity?data='+$('#entity').val(),
    //                'cache':false,
    //                'success':function(html){
    //                    jQuery("#subentity1").html(html);
    //                
    //                }
    //            });
    //            return false;
    //        });
    //    });
    jQuery(function($) {   
        jQuery('body').delegate('.commodity','change',function(){
            
            //alert("hiii");
            var hdn= $("#hdn").val();
   
            if(hdn=="")
            {
                hdn=1;
            }
       
            
            var ctr=parseInt(hdn)+1;
            $("#combo_1").prop("disabled", false);
            
             //alert(""+$(this).attr('id'));
             
             var id=$(this).attr('id');
             
            var sub= id.substring(9);
            
            //alert(sub);
           
            //var test="subentity"+ctr;
            
            //alert(hdn+"--"+ctr);
       
            //alert($("#"+id).val());
         
            jQuery.ajax({
                'url':'<?php echo Yii::app()->request->baseUrl; ?>/index.php/Sample/Dispcombo_commodity?data='+$( this ).val(),
                'cache':false,
                'success':function(html){
                    // alert(html);
                    //;
                    if($.trim(html)!="fail")
                    {
                        //alert("done");
                        $("#foo").append("<div id='div"+sub+"'></div>");
                        $( "#div"+sub ).html("<select name='subentity"+ctr+"[]' id='subentity"+ctr+"' class='entity' multiple ></select>");
                        
                        //alert(html);
                             
                        jQuery("#subentity"+ctr).html(html);
                             
                        $('#hdn').val(ctr);
                    }
                    
                
                }
            });
            
            
			
			 jQuery.ajax({
                'url':'<?php echo Yii::app()->request->baseUrl; ?>/index.php/Sample/Dispcombo_category?data='+$('#subentity'+hdn).val(),
                'cache':false,
                'success':function(html){
                    // alert(html);
                    //;
                    if($.trim(html)!="fail")
                    {
                            
                        jQuery("#category").html(html);
                             
                             
                    }
                    
                
                }
            });
			
			
            jQuery.ajax({
                'url':'<?php echo Yii::app()->request->baseUrl; ?>/index.php/Sample/Dispcombo_consumable?data='+$('#subentity'+hdn).val(),
                'cache':false,
                'success':function(html){
                    // alert(html);
                    //;
                    if($.trim(html)!="fail")
                    {
                            
                        jQuery("#consumable").html(html);
                             
                             
                    }
                    
                
                }
            });
            return false;
        });

    });
    
	jQuery(function($) {
        jQuery('body').delegate('#commodity','change',function(){
            
            //alert("here");
            //alert($('#prnter').val());
           
           
            $("#combo_1").prop("disabled", false);
   
            return false;
        });
    });

	jQuery(function($) {
        jQuery('body').delegate('#category','change',function(){
            
            //alert("here");
            //alert($('#prnter').val());
           
           
            $("#combo_2").prop("disabled", false);
   
            return false;
        });
    });
	
	
    jQuery(function($) {
        jQuery('body').delegate('#consumable','change',function(){
            
            //alert("here");
            //alert($('#prnter').val());
           
           
            $("#combo_3").prop("disabled", false);
   
            return false;
        });
    });
    
    jQuery(function($) {
        jQuery('body').delegate('#file_folder','change',function(){
            $("#combo_3").prop("disabled", false);
            return false;
        });
    });
    
      jQuery(function($) {
        jQuery('body').delegate('#user','change',function(){
            $("#combo_0").prop("disabled", false);
            return false;
        });
    });
    
    jQuery(function($) {
        jQuery('body').delegate('#page_operator','change',function(){
            //alert("hiiii");
            //$('#'+thiscombo+'').append()
            if($('#page_operator').val()=="between")
            {
                $("#to").css("display", "inline");
                $("#from").css("display", "inline");
                $( "#disp_text" ).append("<input type='text' name='page_value_to' id='page_value_to' size='2' style='width:50px;'>");
                    
                    
                //("#disp_text").html("<input type='text' name='size_value_to' id='size_value_to' size='2'>");
            
            }
            else
            {
                $("#to").css("display", "none");
                $("#from").css("display", "none");
                $("#page_value_to").remove();
            }
            
            return false;
        });
    });
    jQuery(function($) {
        jQuery('body').delegate('#date_operator','change',function(){
            //alert("hiiii");
            
            if($('#date_operator').val()=="between")
            {
  
                jQuery.ajax({
                    'url':'<?php echo Yii::app()->request->baseUrl; ?>/index.php/Report/Datepickto',
                    'cache':false,
                    'success':function(html){
                        
                        $("#to1").css("display", "inline");
                        $("#from1").css("display", "inline");
                        $("#date_disp1").css("display", "inline");
                        jQuery("#date_disp1").html(html);
                        jQuery('#btn').attr('disabled',false);
                    }
                });
            }
            else
            {
                $("#to1").css("display", "none");
                $("#from1").css("display", "none");
                $("#date_disp1").css("display", "none");
            }

            
            return false;
        });
    });
    
    
    
        
    
    
    jQuery(function($) {
        jQuery('body').delegate('.combo','change',function(){
            //alert("hiii");
            var thiscombo=$(this).attr('id');
                  
           // alert(thiscombo);
                    
            var getcomboid= thiscombo.substr(-1, thiscombo.indexOf('_')); 
                    
                    
                    
            var formdivid="div_"+getcomboid;
                
            var b=$("#"+formdivid+"").children();
            var span_id=$('#'+thiscombo+'').val();
            
            //alert(span_id);
            
            
            
            
            if(span_id!="")
            {
                  
                 if(formdivid=="div_0")
                {
                    var textboxname="txt_field_user[]";
                            
                }
                if(formdivid=="div_1")
                {
                    var textboxname="txt_field_commodity[]";
                            
                }
                else if(formdivid=="div_2")
                {
                    var textboxname="txt_field_category[]";
                }
				else if(formdivid=="div_3")
                {
                    var textboxname="txt_field_consumable[]";
                }
                
                    
                // alert(span_id);
                var id=1;
                console.log(""+b);
                for(var i=0; i<b.length; i++)
                {
                    if(b[i].id==span_id)
                    {
                                
                        id=2;
                    }
                    console.log(""+b[i].id);
                        
                }

                if(id==1)
                {
                
                
                    //$( "#"+formdivid+"" ).append( "<span id="+$('#'+thiscombo+'').val()+"><input type='checkbox' name='del_check' id='ch_"+$('#'+thiscombo+'').val()+"' value='ch_"+$('#'+thiscombo+'').val()+"'>&nbsp;<input type='text' name='"+textboxname+"' value='"+$('#'+thiscombo+' option:selected').text()+"'><br /><br /></span>" );
                    
                    if($('#'+thiscombo+'').val()==3 && formdivid=="div_3")
                    {
                                
                        $( "#"+formdivid+"" ).append( "<span id="+$('#'+thiscombo+'').val()+"><input type='checkbox' name='del_check' id='ch_"+$('#'+thiscombo+'').val()+"' value='ch_"+$('#'+thiscombo+'').val()+"'>&nbsp;<input type='text' name='"+textboxname+"' value='"+$('#'+thiscombo+' option:selected').text()+"'>&nbsp;<select name='size_operator' id='size_operator' style='width:100px'><option value=''>All</option><option value='>'>></option><option value='<'><</option><option value='='>=</option><option value='between'>between</option></select>&nbsp;<div id='from' style='display:none;'>From:</div><input type='text' name='size_value' size='2' style='width:80px;'><div id='disp_text' style='display:inline;'>&nbsp;<div id='to' style='display:none;'>To:</div></div><br /><br /></span>" );
                    }
                
                    else if($('#'+thiscombo+'').val()==1 && formdivid=="div_3")
                    {
                        $( "#"+formdivid+"" ).append( "<span id="+$('#'+thiscombo+'').val()+"><input type='checkbox' name='del_check' id='ch_"+$('#'+thiscombo+'').val()+"' value='ch_"+$('#'+thiscombo+'').val()+"'>&nbsp;<input type='text' name='"+textboxname+"' value='"+$('#'+thiscombo+' option:selected').text()+"'>&nbsp;<select name='name_operator' id='name_operator' style='width:120px'><option value=''>All</option><option value='starting'>Starting With</option><option value='closing'>Closing With</option><option value='having'>Having Characters</option><option value='exact'>Exact Name</option></select>&nbsp;Search<input type='text' name='file_name' size='2'><br /><br /></span>" );
                    }
                    else if($('#'+thiscombo+'').val()==5 && formdivid=="div_3")
                    {
                                
                        $( "#"+formdivid+"" ).append( "<span id="+$('#'+thiscombo+'').val()+"><input type='checkbox' name='del_check' id='ch_"+$('#'+thiscombo+'').val()+"' value='ch_"+$('#'+thiscombo+'').val()+"'>&nbsp;<input type='text' name='"+textboxname+"' value='"+$('#'+thiscombo+' option:selected').text()+"'>&nbsp;<select name='date_operator' id='date_operator' style='width:100px'><option value=''>All</option><option value='>'>></option><option value='<'><</option><option value='='>=</option><option value='between'>between</option></select>&nbsp;<div id='from1' style='display:none;'>From:</div><div id='date_disp' style='display:inline;'></div>&nbsp;<div id='to1' style='display:none;'>To:</div>&nbsp;<div id='date_disp1' style='display:inline;'></div><br /><br /></span>" );
                    
                    
                        jQuery.ajax({
                            'url':'<?php echo Yii::app()->request->baseUrl; ?>/index.php/Report/Datepick',
                            'cache':false,
                            'success':function(html){
                                jQuery("#date_disp").append(html);
                                //jQuery('#btn').attr('disabled',false);
                            }
                        });
            
                    }
                    else
                    {
                        $( "#"+formdivid+"" ).append( "<span id="+$('#'+thiscombo+'').val()+"><input type='checkbox' name='del_check' id='ch_"+$('#'+thiscombo+'').val()+"' value='ch_"+$('#'+thiscombo+'').val()+"'>&nbsp;<input type='text' name='"+textboxname+"' value='"+$('#'+thiscombo+' option:selected').text()+"'><br /><br /></span>" );            
                    }
                
            
                }
                else
                {
                    alert("record already present");
                }
                
            }
                    
            
            
            return false;
        });
		
		jQuery('body').delegate('#combo_2','blur',function(){
        
            var conumable= $( "#category" ).val();
            var combo_2= $( "#combo_2" ).val();
            alert(txt_field_consumable.length);
            var arr=[];
            arr=$('[name="txt_field_category["]').val();
            
            alert(arr);
     
        });
        
        jQuery('body').delegate('#combo_3','blur',function(){
        
            var conumable= $( "#consumable" ).val();
            var combo_2= $( "#combo_2" ).val();
            alert(txt_field_consumable.length);
            var arr=[];
            arr=$('[name="txt_field_consumable["]').val();
            
            alert(arr);
     
        });
    });
    
    jQuery(function($) {
        jQuery('body').delegate('.delete','click',function(){
            var chkArray = [];
	
            // alert($(this).attr('id'));
                    
            var thisdiv=$(this).attr('id');
                    
            var getid= thisdiv.substr(-1, thisdiv.indexOf('_')); 
            //alert(getid);
                    
            var frmdivid="div_"+getid;
            // alert(frmdivid);
                    
                    
            /* look for all checkboes that have a parent id called 'checkboxlist' attached to it and check if it was checked */
            $("#"+frmdivid+" input:checked").each(function() {
                chkArray.push($(this).val());
            });
	
            /* we join the array separated by the comma */
            var selected;
            //selected = chkArray.join(',') + ",";
	
        
        
            $.each( chkArray, function( key, value ) {
            
            
                var spanid= value.substr(-1, value.indexOf('_')); 
           
                //alert(spanid);
                $("span[id="+spanid+"]").remove();
            });
        
            //}
            return false;
        });
    });
    

</script>
<?php
/* @var $this ReportController */
/* @var $model Report */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'report-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        //'enableAjaxValidation' => false,
        'enableClientValidation' => true,
            ));
    ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model, 'name', array('span' => 5, 'maxlength' => 50)); ?>
    <?php echo $form->textAreaControlGroup($model, 'description', array('span' => 5, 'row'=>3)); ?>

	
    <input type="hidden" name="hdn" id="hdn" >
    <table>
			<!--
            <tr>
            <td style="vertical-align: top; border-top:thin solid black; ">
                <?php /*echo $form->labelEx($model, 'Select User'); ?>

                <select name="user[]" id="user" multiple >
                    <?php
                    $connection = Yii::app()->db;
                    $sql3 = "select id,name from user";
                    $command = $connection->createCommand($sql3);
                    // $command->bindParam(":locId",$locId,PDO::PARAM_INT);
                    $dataReader = $command->query();
                    ?>
                    <option value="">Select</option>
                    <option value="all">All</option>
                    <?php
                    while ($row = $dataReader->read()) {

                        $id = $row['id'];
                        $name = $row['name'];
                        ?>

                        <option value="<?php echo "'" . $id . "'"; ?>"><?php echo $name; ?></option>
                        <?php
                    }
                    ?></select>
                
<!--                <select name='subentity' id='subentity' class='entity' multiple >
                    
                    <option>select</option>
                    <option>select1</option>
                    
                </select>-->



            </td> 
            <td style="vertical-align: top; border-top:thin solid black; ">

<?php //echo $form->labelEx($model, 'Select Printer Columns');   ?>
                <select name="field_user" id="combo_0" class="combo">

                    <option value="">Select</option>
                    <?php
                    $columns = Yii::app()->db->schema->getTable('user')->columns;
                    $i = 1;
                    foreach (array_slice($columns, 0) as $columns) {

                        foreach ($columns as $key => $val) {


                            if ($key == "name") {

                                if ($i!=3) {
                                    
                                    if($i<11)
                                    {
                                    ?>
                                    <option value="<?php echo $i; ?>"><?php echo $val; ?></option>

                                    <?php }
                                }
                                $i++;
                            }
                        }
                    }*/
                    ?>
                </select>&nbsp;<input type="button" value="Delete" id="del_0" class='delete'>



                <br />
                <div id="div_0">

                </div>

            </td>
        </tr>
		-->
		
        <tr>
            <td style="vertical-align: top; border-top:thin solid black; ">
                <?php echo $form->labelEx($model, 'Select Commodity'); ?>
<!--                <select name="entity[]" id="entity" multiple>
                <?php
//                    $connection = Yii::app()->db;
//                    $sql3 = "select id,name from glpi_entities where level=1";
//                    $command = $connection->createCommand($sql3);
//                    // $command->bindParam(":locId",$locId,PDO::PARAM_INT);
//                    $dataReader = $command->query();
//                    
                ?>
                    <option value="">Select</option>
                                        <option value="all">All</option>
                    //<?php
//                    while ($row = $dataReader->read()) {
//
//                        $id = $row['id'];
//                        $name = $row['name'];
//                        
                ?>

                        <option value="//<?php //echo "'" . $id . "'"; ?>"><?php //echo $name; ?></option>
                        //<?php
//                    }
                ?></select>-->


<select name="commodity[]" id="commodity" multiple >
<?php
$connection = Yii::app()->db;
//$sql3 = "select id,name from glpi_entities where level=1";
$sql3 = "select id,name from commodity";
$command = $connection->createCommand($sql3);
// $command->bindParam(":locId",$locId,PDO::PARAM_INT);
$dataReader = $command->query();
?>

<option value="all">Select All</option>
<!--<option value="all">All</option>-->
<?php
while ($row = $dataReader->read()) {

    $id = $row['id'];
    $name = $row['name'];
    ?>

    <option value="<?php echo "'" . $id . "'"; ?>"><?php echo $name; ?></option>
    <?php
}
?>
</select>

            </td> 
            <td style="vertical-align: top; border-top:thin solid black; ">


                <select name="field_commodity" id="combo_1" class="combo">

                    <option value="">Select</option>
					
                    <?php
                    $columns = Yii::app()->db->schema->getTable('commodity')->columns;
                    $i = 1;
                    foreach (array_slice($columns, 0) as $columns) {

                        foreach ($columns as $key => $val) {


                            if ($key == "name") {
                                if ($i == 2 or $i == 4 or $i == 3 or $i == 5) {
                                    ?>
                                    <option value="<?php echo $i; ?>"><?php echo $val; ?></option>
                                    <?php
                                }
                                $i++;
                            }
                        }
                    }
                    ?>
                </select>&nbsp;<input type="button" value="Delete" id="del_1" class='delete'>



                <br />
                <div id="div_1">

                </div>

            </td>
        </tr>
		
		
		
		
		
		
		
		
		<tr>
            <td style="vertical-align: top; border-top:thin solid black; ">
                <?php echo $form->labelEx($model, 'Select Category'); ?>
<!--                <select name="entity[]" id="entity" multiple>
                <?php
//                    $connection = Yii::app()->db;
//                    $sql3 = "select id,name from glpi_entities where level=1";
//                    $command = $connection->createCommand($sql3);
//                    // $command->bindParam(":locId",$locId,PDO::PARAM_INT);
//                    $dataReader = $command->query();
//                    
                ?>
                    <option value="">Select</option>
                                        <option value="all">All</option>
                    //<?php
//                    while ($row = $dataReader->read()) {
//
//                        $id = $row['id'];
//                        $name = $row['name'];
//                        
                ?>

                        <option value="//<?php //echo "'" . $id . "'"; ?>"><?php //echo $name; ?></option>
                        //<?php
//                    }
                ?></select>-->


<select name="category[]" id="category" multiple >
    <?php
    $connection = Yii::app()->db;
    $sql3 = "select id,path from commodity_category where commodity_id=3";
    $command = $connection->createCommand($sql3);
    $dataReader = $command->query();
    ?>
   <option value="all">Select All</option>
    <?php
        while ($row = $dataReader->read()) {
        $id = $row['id'];
        $name = $row['path'];
    ?>
    <option value="<?php echo "'" . $id . "'"; ?>"><?php echo $name; ?></option>
    <?php
    }
    ?>
</select>
        

            </td> 
            <td style="vertical-align: top; border-top:thin solid black; ">

<?php //echo $form->labelEx($model, 'Select Printer Columns');   ?>
                <select name="field_category" id="combo_2" class="combo">

                    <option value="">Select</option>
					
                    <?php
                    $columns = Yii::app()->db->schema->getTable('commodity_category')->columns;
                    $i = 1;
                    foreach (array_slice($columns, 0) as $columns) {

                        foreach ($columns as $key => $val) {


                            if ($key == "name") {

                                if ($i == 2 or $i == 4 or $i == 3 ) {
                                    ?>
                                    <option value="<?php echo $i; ?>"><?php echo $val; ?></option>

                                    <?php
                                }
                                $i++;
                            }
                        }
                    }
                    ?>
                </select>&nbsp;<input type="button" value="Delete" id="del_1" class='delete'>



                <br />
                <div id="div_2">

                </div>

            </td>
        </tr>

<!--        <tr>

            <td style="vertical-align: top;"><input type="hidden" name="h2" id="h2" />        
<?php //echo $form->labelEx($model, 'Select Sub-Entity');  ?>
                <select name="subentity1[]" id="subentity1" multiple onchange="load_subentities()">

                </select>
            </td>
            <td style="vertical-align: top;">

            </td>
        </tr>
        -->


        <tr>

            <td id="foo" style="vertical-align: top; border-bottom: thin solid black;">

            </td>
            <td style="vertical-align: top; border-bottom: thin solid black;"></td>



            <td></td>

        </tr>
		
		
        <tr>
            <td style="vertical-align: top; border-top:thin solid black; ">
                <?php echo $form->labelEx($model, 'Select Item'); ?>
<!--                <select name="entity[]" id="entity" multiple>
                <?php
//                    $connection = Yii::app()->db;
//                    $sql3 = "select id,name from glpi_entities where level=1";
//                    $command = $connection->createCommand($sql3);
//                    // $command->bindParam(":locId",$locId,PDO::PARAM_INT);
//                    $dataReader = $command->query();
//                    
                ?>
                    <option value="">Select</option>
                                        <option value="all">All</option>
                    //<?php
//                    while ($row = $dataReader->read()) {
//
//                        $id = $row['id'];
//                        $name = $row['name'];
//                        
                ?>

                        <option value="//<?php //echo "'" . $id . "'"; ?>"><?php //echo $name; ?></option>
                        //<?php
//                    }
                ?></select>-->


                <select name="consumable[]" id="consumable" multiple >
                    <?php
                    $connection = Yii::app()->db;
                    //$sql3 = "select id,name from glpi_entities where level=1";
					$sql3 = "select id,name from consumable where category_id='Category 1'";
                    $command = $connection->createCommand($sql3);
                    // $command->bindParam(":locId",$locId,PDO::PARAM_INT);
                    $dataReader = $command->query();
                    ?>
                   <option value="all">Select All</option>
                    <!--<option value="all">All</option>-->
                    <?php
                    while ($row = $dataReader->read()) {

                        $id = $row['id'];
                        $name = $row['name'];
                        ?>

                        <option value="<?php echo "'" . $id . "'"; ?>"><?php echo $name; ?></option>
                        <?php
                    }
                    ?></select>
                
<!--                <select name='subentity' id='subentity' class='entity' multiple >
                    
                    <option>select</option>
                    <option>select1</option>
                    
                </select>-->



            </td> 
            <td style="vertical-align: top; border-top:thin solid black; ">

<?php //echo $form->labelEx($model, 'Select Printer Columns');   ?>
                <select name="field_consumable" id="combo_3" class="combo">

                    <option value="">Select</option>
					
                    <?php
                    $columns = Yii::app()->db->schema->getTable('consumable')->columns;
                    $i = 1;
                    foreach (array_slice($columns, 0) as $columns) {

                        foreach ($columns as $key => $val) {


                            if ($key == "name") {

                                if ($i > 3 and $i < 22 ) {
                                    ?>
                                    <option value="<?php echo $i; ?>"><?php echo $val; ?></option>

                                    <?php
                                }
                                $i++;
                            }
                        }
                    }
                    ?>
                </select>&nbsp;<input type="button" value="Delete" id="del_1" class='delete'>



                <br />
                <div id="div_3">

                </div>

            </td>
        </tr>
		
		
		
          <tr>
            <td style="vertical-align: top; border-top:thin solid black; ">
                <?php echo $form->labelEx($model, 'Select Date'); ?>
                <select name='date_operator' id='date_operator' style='width:100px'>
                    <option value=''>All</option>
                    <option value='>'>></option>
                    <option value='<'><</option>
                    <option value='='>=</option>
                    <option value='between'>between</option>
                </select>
            </td>

            <td style="vertical-align: top; border-top:thin solid black; ">

                <div id='from1' style='display:inline;'>From:</div>
                <div id='date_disp' style='display:inline;'>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'name' => 'Date', 'options' => array('dateFormat' => 'yy/mm/dd', 'showAnim' => 'fold', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
                            'showOn' => 'button', // 'focus', 'button', 'both'
                            'buttonText' => Yii::t('ui', 'Select from calendar'),
                            'buttonImage' => Yii::app()->request->baseUrl . '/images/calendar.png',
                            'buttonImageOnly' => true,),
                        'htmlOptions' => array('style' => 'width:80px;'),
                    ));
                    ?>

                </div>&nbsp;
			</td>
			<td style="vertical-align: top; border-top:thin solid black; ">
                <div id='to1' style='display:inline;'>To:</div>
                <div id='date_disp1' style='display:inline;'>
				<?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'name' => 'Date', 'options' => array('dateFormat' => 'yy/mm/dd', 'showAnim' => 'fold', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
                            'showOn' => 'button', // 'focus', 'button', 'both'
                            'buttonText' => Yii::t('ui', 'Select from calendar'),
                            'buttonImage' => Yii::app()->request->baseUrl . '/images/calendar.png',
                            'buttonImageOnly' => true,),
                        'htmlOptions' => array('style' => 'width:80px;'),
                    ));
                    ?>
					</div>

            </td>
        </tr>
                <tr>
            <td style="vertical-align: top; ">
                <?php echo $form->labelEx($model, 'Sort By'); ?>
                <select name="sort_by" id="sort_by">
                    <option value="">Select</option>
                    <option value="glpi_consumableitems.id">Sort By Item</option>
                    <option value="glpi_consumables.date_out">Sort By Date</option>
                </select></td>
            <td>
            </td>

        </tr>


        <tr>

            <td style="vertical-align: top;"><input type="hidden" name="h2" id="h2" />        
                <div class="checkboxes">
                    <label for="w"><input type="checkbox" id="total" name="total"/> <span>Blocked</span></label>
                    <label for="x"><input type="checkbox" id="new_stock" name="new_stock" /> <span>On loan</span></label>
                    <label for="z"><input type="checkbox" id="threshold" name="threshold" /> <span>Less Than Threshold</span></label>
                    <label for="z"><input type="checkbox" id="damage" name="threshold" /> <span>Damaged</span></label>
                </div> 
            </td>
            <td style="vertical-align: top;">

            </td>
        </tr>
    </table>



   <div style="text-align: center;">
	        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Generate' : 'Update',array(
			    'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
			    'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
			    //'onclick'=>'js:document.location.href="http://localhost/asset_management/index.php/consumable/admin"'
			)); ?>
			<?php echo TbHtml::button('Cancel',array(
				'color' => TbHtml::BUTTON_COLOR_DANGER,
				'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
				'onclick' => 'history.go(-1)'
			));?>
            </div>
            <br/>
    <?php $this->endWidget(); ?>

</div><!-- form -->