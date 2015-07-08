<?php
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
// $cs->registerScriptFile($baseUrl.'/js/yourscript.js');
//echo "hiiiiii".$baseUrl;
//include('storage_system/css/_styles.css');
$cs->registerScriptFile($baseUrl . '/js/jquery-1.11.1.min.js');?>


<script type="text/javascript">


    $(document).ready(function() {
  
     $("#combo_1").prop("disabled", true);
     $("#combo_2").prop("disabled", true);
     $("#combo_3").prop("disabled", true);
     } );
     
    jQuery(function($) {
        jQuery('body').delegate('#storage_type','change',function(){
            
            //alert("here");
           // alert($('#storage_type').val());
           
            $("#combo_1").prop("disabled", false);
               
           
            //alert($('#drive').val());
            jQuery.ajax({
                'url':'<?php echo Yii::app()->request->baseUrl; ?>/index.php/Sample/Dispcombo_deatil?data='+$('#storage_type').val(),
                'cache':false,
                'success':function(html){
                    jQuery("#storage_detail").html(html);
                    //jQuery('#btn').attr('disabled',false);
                }
            });
            return false;
        });
    });



    jQuery(function($) {
        jQuery('body').delegate('#storage_detail','change',function(){

           // alert($('#storage_detail').val());
            $("#combo_2").prop("disabled", false);
            //alert($('#drive').val());
            jQuery.ajax({
                'url':'<?php echo Yii::app()->request->baseUrl; ?>/index.php/Sample/Dispcombo_content?data='+$('#storage_detail').val(),
                'cache':false,
                'success':function(html){
                    jQuery("#storage_content").html(html);
                    //jQuery('#btn').attr('disabled',false);
                }
            });
            return false;
        });
    });
    
    jQuery(function($) {
        jQuery('body').delegate('#storage_content','change',function(){
             $("#combo_3").prop("disabled", false);
             return false;
        });
    });
        
    
    
    jQuery(function($) {
        jQuery('body').delegate('.combo','change',function(){
                //alert("hiii");
                  var thiscombo=$(this).attr('id');
                    
                    var getcomboid= thiscombo.substr(-1, thiscombo.indexOf('_')); 
                    
                    //alert(getcomboid);
                    
                    var formdivid="div_"+getcomboid;
                
                    var b=$("#"+formdivid+"").children();
                    var span_id=$('#'+thiscombo+'').val();
                    
                    if(formdivid=="div_1")
                    {
                        var textboxname="txt_field_type[]";
                            
                    }
                    else if(formdivid=="div_2")
                    {
                        var textboxname="txt_field_detail[]";
                    }
                    else if(formdivid=="div_3")
                    {
                        var textboxname="txt_field_content[]";
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
                
                
                        $( "#"+formdivid+"" ).append( "<span id="+$('#'+thiscombo+'').val()+"><input type='checkbox' name='del_check' id='ch_"+$('#'+thiscombo+'').val()+"' value='ch_"+$('#'+thiscombo+'').val()+"'>&nbsp;<input type='text' name='"+textboxname+"' value='"+$('#'+thiscombo+' option:selected').text()+"'><br /><br /></span>" );
                    }
                    else
                    {
                        alert("record already present");
                    }
                
            
            return false;
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
  'enableClientValidation'=>true,
            ));
    ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model, 'name', array('span' => 5, 'maxlength' => 50)); ?>

    <?php echo $form->textFieldControlGroup($model,'timestamp',array('span'=>5));  ?>


    <!----------------start Set1----------------------------------------------------------->
    <input type="hidden" name="h1" id="h1" />
    <?php echo $form->labelEx($model, 'Select Storage Type'); ?>

    <select name="storage_type[]" id="storage_type" multiple>
        <?php
        $connection = Yii::app()->db;
        $sql3 = "select * from storage_type";
        $command = $connection->createCommand($sql3);
        // $command->bindParam(":locId",$locId,PDO::PARAM_INT);
        $dataReader = $command->query();
        ?>
        <option value="">Select</option>
        <option value="all">All</option>
        <?php
        while ($row = $dataReader->read()) {
            //$dataReader->close();
            $storage_type_id = $row['storage_type_id'];
            $storage_type = $row['storage_type'];
            ?>

            <option value="<?php echo $storage_type_id; ?>"><?php echo $storage_type; ?></option>
            <?php
        }
        ?></select><br />

    <?php echo $form->labelEx($model, 'Select Storage Type Columns'); ?>
    <select name="field_type" id="combo_1" class="combo">
        <option value="">Select</option>
        <?php
        $columns = Yii::app()->db->schema->getTable('storage_type')->columns;
        $i=1;
        foreach (array_slice($columns, 1, 2) as $columns) {
            
            foreach ($columns as $key => $val) {


                if ($key == "name") {
                    ?>
                    <option value="<?php echo $i; ?>"><?php echo $val; ?></option>

                    <?php
                    
                    $i++;
                }
            }

            //echo $key['name']."<br>";
            //}
//                            echo $columns["name"]."<br>";
        }
        ?>
    </select><input type="button" value="Delete" id="del_1" class='delete'>



    <br />
    <div id="div_1">
    
    </div>

    <!----------------end Set1----------------------------------------------------------->                        



    <br /><br />



    <!----------------start Set2----------------------------------------------------------->                           

    <input type="hidden" name="h2" id="h2" />        
    <?php echo $form->labelEx($model, 'Select Disk'); ?>
    <select name="storage_detail[]" id="storage_detail" multiple>

    </select>


    <?php echo $form->labelEx($model, 'Select Disk Columns'); ?>
    <select name="field_detail" id="combo_2" class="combo">
        <option value="">Select</option>
        <?php
        $columns = Yii::app()->db->schema->getTable('storage_detail')->columns;
        $j=1;
        foreach (array_slice($columns, 1, 13) as $columns) {
            foreach ($columns as $key => $val) {


                if ($key == "name") {
                    ?>
                    <option value="<?php echo $j; ?>"><?php echo $val; ?></option>

                    <?php
                    
                    $j++;
                }
            }

            //echo $key['name']."<br>";
            //}
//                            echo $columns["name"]."<br>";
        }
        ?>
    </select> <input type="button" value="Delete" id="del_2" class='delete'>



    <br />
    <div id="div_2">
        
    </div><br /><br />

    <!----------------end Set2-----------------------------------------------------------> 

    <!----------------start Set3----------------------------------------------------------->                           

    <input type="hidden" name="h3" id="h3" />        
    <?php echo $form->labelEx($model, 'Select Storage Content'); ?>
    <select name="storage_content[]" id="storage_content" multiple>
        <option value="">Select</option>
    </select>


    <?php echo $form->labelEx($model, 'Select Storage Content Columns'); ?>
    <select name="field_content" id="combo_3" class="combo">
        <option value="">Select</option>
        <?php
        $columns = Yii::app()->db->schema->getTable('storage_content')->columns;
        $k=1;
        foreach (array_slice($columns, 1, 6) as $columns) {
            foreach ($columns as $key => $val) {


                if ($key == "name") {
                    ?>
                    <option value="<?php echo $k; ?>"><?php echo $val; ?></option>

                    <?php
                    
                    $k++;
                }
            }

            //echo $key['name']."<br>";
            //}
//                            echo $columns["name"]."<br>";
        }
        ?>
    </select><input type="button" value="Delete" id="del_3" class='delete'>



    <br />
    <div id="div_3">
        
    </div>

    <!----------------end Set3-----------------------------------------------------------> 



    <?php //echo $form->textFieldControlGroup($model,'uid',array('span'=>5));  ?>

    <?php echo $form->textFieldControlGroup($model, 'description', array('span' => 5, 'maxlength' => 150)); ?>



    <div class="form-actions">
        <?php
        echo TbHtml::submitButton($model->isNewRecord ? 'Generate' : 'Save', array(
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            'size' => TbHtml::BUTTON_SIZE_LARGE,
        ));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->