<html>
    <style>
        .myFlash{
            color:#B40431;
            padding:10px;
            background:#F8E0E6;
            border-radius:15px;
            size: 13px;
        }
        .buttonDesign{
            margin-left : 2px;
            margin-right : 2px;
        }
       
    </style>
    <style type="text/css" media="print">
   .no-print { display: none; }
    </style>
</html>
<?php
/* @var $this FieldsController */
/* @var $model FormField */

$this->breadcrumbs=array(
	'Entries',
	'Manage',
);
?>

<h1>Manage Entries of <span style="color:#B40431"><?php echo $form->FORM_NAME;?></span></h1>
<?php echo CHtml::link('<i class="icon-plus"></i>',array('new','form'=>$form->FORM_ID),array('class'=>'btn-danger btn buttonDesign','title'=>'Add '.ucfirst($this->id))); ?>
<?php $this->widget('application.extensions.print.printWidget', array(
                   'cssFile' => 'print.css',
                    'printedElement' => '#fopen-grid',
                    'htmlOptions' => array(),
                    )); 
?>
<?php //echo CHtml::link('<i class="icon-file"></i> <b>PDF</b>','generatePdf',array('class'=>'btn btn-danger buttonDesign','style'=>'height:16px;','title'=>'Save as PDF'));?>
<?php //echo CHtml::link('<i class="icon-file"></i> <b>CSV</b>','#csv',array('class'=>'btn-success btn buttonDesign','style'=>'height:16px;','title'=>'Save as CSV')); ?>
<?php echo "<br/><br/>"?> 

<div id="fopen-grid">
<table class="items table-bordered table">
	<thead>
		<tr>
			<!--
			<th id="form-field-grid_c0">Entry ID</th>
			<th id="form-field-grid_c1">Form ID</th>
			<th id="form-field-grid_c2">Created By</th>
			<th id="form-field-grid_c3">Modified By</th>
			<th id="form-field-grid_c4">Create Date</th>
			<th id="form-field-grid_c5">Modified Date</th> -->
			<?php $i="odd"; $count1 = 0;foreach($fields AS $m){ 
                                    if($count1 == 5) break; else ++$count1;
                            ?>
                                                        
                        <th id="form-field-grid_c5"><?php echo $m->TITLE; ?>&nbsp;&nbsp;&nbsp;</th>	<?php } ?>
			
		</tr>
	</thead>
	<tbody>

		<?php $i="odd"; foreach($model AS $m){ ?>
		<tr class="<?php echo $i;?>">
			<?php /*echo $m->ID; ?></td>
			<td><?php echo $m->FORM_ID; ?></td>
			<td><?php echo $m->CREATED_BY; ?></td>
			<td><?php echo $m->LAST_MODIFIED_BY; ?></td>
			<td><?php echo $m->CREATED_DATE; ?></td>
			<td><?php echo $m->LAST_MODIFIED_DATE; */?>
			<?php $i="odd"; $count2 = 0; foreach($fields as $n){ 
                                        if($count2 == 5) break; else ++$count2;
                            
                            ?>
			<td><?php echo $m->{$n->VARNAME}; ?>&nbsp;&nbsp;&nbsp;</th>	<?php  }?>
        
			
                        <td class="no-print">	<?php echo CHtml::link('<i class="icon-eye-open"></i>', array('view', 'form'=>$m->FORM_ID, 'entry'=>$m->ID)); ?></td>
                        <td class="no-print">	<?php echo CHtml::link('<i class="icon-edit"></i>', array('edit', 'form'=>$m->FORM_ID, 'entry'=>$m->ID)); ?></td>
                        <td class="no-print">	<?php echo CHtml::link('<i class="icon-remove"></i>',"#", array("submit"=>array('delete', 'form'=>$m->FORM_ID, 'entry'=>$m->ID), 'confirm' => 'Are you sure you want to delete this item?')); ?></td>
			
			<td class="render-button no-print">
				<?php $this->renderButtons($m); ?>
			</td>
		</tr>
		<?php if($i=='odd'){$i="even";}else{$i="odd";} } ?>
		
	</tbody>
</table>
</div>
<?php //$this->renderExportGridButton($gridWidget,'<i class="icon-file"></i> <b>CSV</b>',array('id'=>'csv','class'=>'btn-success btn buttonDesign pull-right','style'=>'height:16px;','title'=>'Save as CSV'));?>