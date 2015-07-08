<div id="chart1"></div>
<?php 
Yii::app()->clientScript->registerScript('chart1',"
$(document).ready(function(){
  var cosPoints = [];
  for (var i=0; i<2*Math.PI; i+=0.1){
     cosPoints.push([i, Math.cos(i)]);
  }
  var plot1 = $.jqplot('chart1', [cosPoints], { 
      series:[{showMarker:false}],
      axes:{
        xaxis:{
          label:'Angle (radians)'
        },
        yaxis:{
          label:'Cosine'
        }
      }
  });
});
");

?>
