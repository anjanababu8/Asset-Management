<div style="width: 250px; height: 175px; position: center;" id="meter"></div>
<?php 
Yii::app()->clientScript->registerScript('meter',"
$(document).ready(function(){
   s1 = [322];
 
   plot3 = $.jqplot('meter',[s1],{
       seriesDefaults: {
           renderer: $.jqplot.MeterGaugeRenderer,
           rendererOptions: {
               min: 100,
               max: 500,
               intervals:[200, 300, 400, 500],
               intervalColors:['#66cc66', '#93b75f', '#E7E658', '#cc6666']
           }
       }
   });
});
");

?>
