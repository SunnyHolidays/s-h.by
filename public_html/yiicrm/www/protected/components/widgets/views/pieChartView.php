<?php
/**
 * @var $this PieChartWidget
 *
 */
$content = <<<EDO
<div id="type_$this->id" style="height:450px;margin:0 auto"></div>
EDO;
$this->widget(
    'Wrapper',
    array(
        'widget' => array(
            'name' => null,
            'emptyWidgetContent' => $content
        ),
        'header' => $header,
        'headerElements' => array('close' => true),
        'icon' => 'icon-signal',
    )
);
?>
<script>
    $(document).on('widgetAdded', function (e) {
        initChart('#type_<?php echo $this->id?>', <?php echo json_encode($data);?>);
    });
</script>