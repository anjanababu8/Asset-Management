<div id="chart_big1"></div>
<?php 
$x = array();
$y = array();

$allconsumables = Consumable::model()->findAllByAttributes(array('is_deleted'=>0));
foreach ($allconsumables as $cons)
{
	$x[] = $cons['name'];
        
        $stocks = Allocate::model()->findAllByAttributes(array('cons_id'=>$cons['id'],'date_out'=>NULL));
	$y[] = count($stocks);
}

$x_data = json_encode($x);
$y_data = json_encode($y);

Yii::app()->clientScript->registerScript('chart_big1',"
$(document).ready(function(){
        $.jqplot.config.enablePlugins = true;
        var s1 = $y_data;
        var ticks = $x_data;
         
        plot1 = $.jqplot('chart_big1', [s1], {
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
