<?php
/**
 * @var $this FlotChartWidget
 */
$content = <<<EOD
<div id="graph-{$type}-{$this->id}" style="width:100%;margin:0 auto"></div>
EOD;

$this->widget(
    'Wrapper',
    array(
        'widget' => array(
            'name' => null,
            'emptyWidgetContent' => $content,
        ),
        'headerElements' => array('close' => true),
        'header' => $header,
        'icon' => 'icon-signal',
    )
);
?>

<script>
    $(document).on('widgetAdded', function (e) {

        var type = <?php echo "'$type'" ?>,
            data = <?php echo json_encode($data);?>,
            labels = <?php echo json_encode($labels); ?>,
            ticksLabel = <?php echo json_encode($ticks);?>,
            color = <?php echo "'$color'";?>;

        if(!$("#<?php echo "graph-{$type}-{$this->id}"?>").is('[data-highcharts-chart]') && $("#<?php echo "graph-{$type}-{$this->id}"?>").length){
            if (type == 'bars') {
                $('#graph-bars-<?php echo $this->id;?>').highcharts(getChartBar(ticksLabel, data, labels,color))
            } else {
                $('#graph-lines-<?php echo $this->id;?>').highcharts(getChartLines(data, labels,color))
            }
        }
    });
</script>