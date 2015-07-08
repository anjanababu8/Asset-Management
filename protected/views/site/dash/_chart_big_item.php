<div id="chart_big"></div>
<?php 
$allocated = Allocate::model()->findAll('cons_id =:cons_id AND date_out IS NOT NULL',array(':cons_id'=>2));
$allocatedDates = [];
foreach($allocated as $a){
    $allocatedDates[] = strtotime($a['date_out']);
}
sort($allocatedDates);
$groupedArray = array_fill(0, count($allocatedDates), 0);
foreach($allocatedDates as $date){
    $groupedArray[($date - $allocatedDates[0])/604800]++;
}
foreach($groupedArray as $week=>$num){
    if($num == 0) unset($groupedArray[$week]);
}

//$a = count($groupedArray);
//echo "<script>alert($a)</script>";die;
$x = array();
$y = array();


foreach ($groupedArray as $a=>$b)
{
	$x[] = 'Week '.($a+1);
	$y[] = $b;
}

$x_data = json_encode($x);
$y_data = json_encode($y);


Yii::app()->clientScript->registerScript('chart_big',"
$(document).ready(function(){
        $.jqplot.config.enablePlugins = true;
        var s1 = $y_data;
        var ticks = $x_data;
         
        plot1 = $.jqplot('chart_big', [s1], {
            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
            animate: !$.jqplot.use_excanvas,
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true }
            },
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: ticks
                }
            },
            highlighter: { show: false }
        });
     
        $('#chart1').bind('jqplotDataClick',
            function (ev, seriesIndex, pointIndex, data) {
                $('#info1').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
            }
        );
    });
");

?>
