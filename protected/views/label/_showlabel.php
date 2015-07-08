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
          $paper = PaperType::model()->findByAttributes(array('id'=>$labelParams['paper']));
          $paperWidth = $paper['width'];
          if(trim($labelParams['fileType']) != ''){  
            $fileType = $labelParams['fileType'];
            $filetypeRow = FileType::model()->findByAttributes(array('id'=>$fileType));
          }else{
            $filetypeRow['label_width'] = 400;
            $filetypeRow['label_height'] = 100;
          }
          $label_width = (int)$filetypeRow['label_width'].'px';
          $label_height = (int)$filetypeRow['label_height'].'px';
          
          
          $paper = $labelParams['paper'];
          
          $numColumns = floor($paperWidth/$filetypeRow['label_width']);
          
          $connection=Yii::app()->db;
          if(trim($labelParams['depts']) == ''){
            $sql = "select CODE,TITLE from fopen";  
          }else{
            $deptRow = Dept::model()->find('id=:id',array(':id'=>$labelParams['depts']));
            $deptName = $deptRow['name'];

            
            /* Which all Files??*/
            if(isset($labelParams['fileNames'])){
              $fileIDsText = implode(',',$labelParams['fileNames']);
              $sql = "select CODE,TITLE from fopen where ID IN ($fileIDsText)";
            }else if(!isset($labelParams['fileNames'])){
              $sql = "select CODE,TITLE from fopen where DEPARTMENT='".$deptName."'";  
            }
          }
          
          $command = $connection->createCommand($sql);
          $dataReader = $command->queryAll();
          
          echo "<table>";
          $numRows = ceil(count($dataReader)/$numColumns);
         
          for($r=1;$r<=$numRows;$r++){
            echo "<tr>";
            for($i=0;$i<$numColumns;$i++){
                $file = current($dataReader);
                if($file!=''){
                    echo "<td>";
                    echo "<table border='1' style='width:$label_width;height:$label_height;margin:10px'>";
                    $code = $file['CODE'];
                    $name = $file['TITLE'];
                    //echo "<tr><th>CODE</th><th>TITLE</th></tr>";
                    echo "<tr><td style='width:20%;vertical-align:middle;text-align:center;'>$code</td><td style='vertical-align:middle;text-align:center;'>$name</td></tr>";
                    echo "</table>";
                    echo "</td>";
                    $file = next($dataReader);
                }else break;
            }
            echo "</tr>";
          }  
          echo "<table>";
           
           ?>
</div>       