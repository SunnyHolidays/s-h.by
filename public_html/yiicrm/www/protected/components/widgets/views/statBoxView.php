<?
/**
 * @var $this StatBoxWidget
 */
?>
<ul class="stat-boxes">
    <li id="popover_<?php echo $this->id;?>">
        <div class="left ">
            <span class="peity_<?php echo $this->id;?>">2,4,9,7,12,10,12</span>
            <?php echo $data['incrementDataInPercent'];?>
        </div>
        <div class="right">
            <strong>
                <?php echo $data['totalAmount'];?>

            </strong>
            <?php echo $label;?>

        </div>
        <a href="javascript:void(0)"  class="widget-delete close stat-box-delete"><i class="icon-remove""></i></a>
    </li>

</ul>
<div id="popover-content_<?php echo $this->id;?>" style="display: none">
    <span class="content-big"><?php echo $data['inMonth'];?></span>
    <span class="content-small"><?php echo $label;?> за текущий месяц</span>
    <br>
    <span class="content-big"><?php echo $data['inLastMonth'];?></span>
    <span class="content-small"><?php echo $label;?> за прошлый месяц</span>
    <br>
</div>
<script>
    $(document).on('widgetAdded', function(e){
        getPeity(<?php echo $data['inLastMonth']?>,<?php echo $data['inMonth'] ?>,'.peity_<?php echo $this->id?>');
        getPopover('#popover_<?php echo $this->id;?>', '#popover-content_<?php echo $this->id;?>')
    });
</script>
