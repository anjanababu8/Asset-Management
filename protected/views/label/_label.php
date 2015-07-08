<?php
/* @var $this LabelController */
/* @var $data Label */
?>

<?php $this->widget('application.extensions.print.printWidget', array(
                   'cssFile' => 'print.css',
                    'printedElement' => '#view',
                    'htmlOptions' => array('style'=>'padding:20px'),
                    )); 
    ?>
<div id="view">

    <?php 
	    $labelRow = Label::model()->findByPk(6);
		$attributes =  str_replace(' ', '_', strtoupper($labelRow['fields']));
		$itemId = $_GET['itemId'];
		$connection=Yii::app()->db;
		$sql = "
		select $attributes
		from fopen 
		where ID =$itemId";
		$command = $connection->createCommand($sql);
		$dataReader = $command->queryAll();
                
                $filetypeRow = FileType::model()->findByAttributes(array('name'=>$_GET['fileType']));
                
                $w = (int)$filetypeRow['label_width'];
                $h = (int)$filetypeRow['label_height'];
                
                ?>
    
	<table class="table table-bordered" style='width:<?php echo $w."px"?>;height:<?php echo $h."px"?>'>
		<tr>
		<?php 
			foreach($dataReader[0] as $key=>$value){
				echo "<th>$key</th>";
			}

		?>
		</tr>
		<tr>
		<?php 
			foreach($dataReader[0] as $key=>$value){
				echo "<td>$value</td>";
			}

		?>	
		</tr>
        </table>

</div>