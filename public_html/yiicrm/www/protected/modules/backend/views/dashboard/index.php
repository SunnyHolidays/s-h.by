<?php
/**
 * @var $this DashboardController
 * @var $widgets string
 * @var $stats string
 */
$baseUrl = Yii::app()->baseUrl;
$this->breadcrumbs = array(
    'Dashboard'
);
$this->header = 'Dashboard';
$this->headerMenu = array(
    array(
        'label' => 'Редактировать/сохранить панель',
        'url' => '#',
        'icon' => 'icon-edit',
        'linkOptions' => array(
            'id' => 'edit-layout',
            'type' => 'start'
        ),
    ),
    array(
        'label' => 'Добавить виджет',
        'url' => '#',
        'icon' => 'icon-plus',
        'linkOptions' => array(
            'id' => 'add-widget',
        ),
    )
,
);
?>
<style>
    #widgets [data-col="2"] { left:50%;}
    #widgets [data-sizex="1"] { width:50%;}
</style>
<script>

</script>
<div class="alert alert-info">
    <button class="close" data-dismiss="alert">×</button>
    <strong>Информация!</strong> Для добавления виджетов нажмите кнопку
    "Добавить виджет" (<i class="icon-plus"></i>) в меню. Для редактирования расположения виджетов нажмите кнопку
    "Редактировать панель" (<i class="icon-edit"></i>). Для
    сохранения параметров панели нажмите кнопку "Редактировать панель" (<i class="icon-ok"></i>) ещё раз.
</div>
<div>
    <div id='stats' class="gridster">
        <ul class='stats' style="max-width:700px !important; margin: 0 auto">
            <?php echo $stats ?>
        </ul>
    </div>
    <div id='widgets' class="gridster">
        <ul class="widgets">
            <?php echo $widgets; ?>
        </ul>
    </div>
</div>
<input id="settings-url" type="hidden" value="<?php echo Yii::app()->createUrl('backend/dashboard/saveSettings')?>">
<div id="widget-selector" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Доступные виджеты</h3>
    </div>
    <div class="modal-body">
        <ul class="widget-list" style="list-style: none" data-get-url="<?php echo Yii::app()->createUrl('backend/dashboard/getWidget')?>">
            <li>
                <img src="img/widgets_thumbs/pie-chart.png" width="150" height="150" style="float: left;">

                <div style="padding-left: 155px">
                    <div class='widget-name'>Круговые диаграммы</div>
                    <div class="widget-description">
                        <ul class="widgets-elements">
                            <li>
                                <p>Процент заказов для каждого менеджера</p>
                                <button class="btn btn-small add-widget-button"
                                        type="PieChartWidget"
                                        widget-name="users_orders"
                                        data-size-x="1"
                                        data-size-y="2"
                                    >Добавить
                                </button>
                            </li>
                            <li>
                                <p>Процент заявок для каждого менеджера</p>
                                <button class="btn btn-small add-widget-button"
                                        type="PieChartWidget"
                                        widget-name="users_requests"
                                        data-size-x="1"
                                        data-size-y="2"
                                    >Добавить
                                </button>
                            </li>
                            <li>
                                <p>Посещаемые страны</p>
                                <button class="btn btn-small add-widget-button"
                                        type="PieChartWidget"
                                        widget-name="countries"
                                        data-size-x="1"
                                        data-size-y="2"
                                    >Добавить
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li>
                <img src="img/widgets_thumbs/line-chart.png" width="155" height="155" style="float: left;">

                <div style="padding-left: 155px">
                    <div class='widget-name'>Линейная диаграмма</div>
                    <div class="widget-description">
                        <ul class="widgets-elements">
                            <li>
                                <p>Соотношение заказов по месяцам</p>
                                <button class="btn btn-small add-widget-button"
                                        type="FlotChartWidget"
                                        widget-name="month_orders"
                                        data-size-x="1"
                                        data-size-y="2"
                                    >Добавить
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li>
                <img src="img/widgets_thumbs/bar-chart.png" width="155" height="155" style="float: left;">

                <div style="padding-left: 155px">
                    <div class='widget-name'>Столбцовая диаграмма</div>
                    <div class="widget-description">
                        <ul class="widgets-elements">
                            <li>
                                <p>Процент продаж по странам</p>
                                <button class="btn btn-small add-widget-button"
                                        type="FlotChartWidget"
                                        widget-name="countries_orders"
                                        data-size-x="1"
                                        data-size-y="2"
                                    >Добавить
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li>
                <img src="img/widgets_thumbs/stat-box.png" width="155" height="155" style="float: left;">

                <div style="padding-left: 155px">
                    <div class='widget-name'>"Stat-box"</div>
                    <div class="widget-description">
                        <ul class="widgets-elements">
                            <li>
                                <p>Заказы за месяц</p>
                                <button class="btn btn-small add-widget-button" type="StatBoxWidget"
                                        widget-name="orders_stat" data-size-x="2"
                                        data-size-y="1" stat="stat">Добавить
                                </button>
                            </li>
                            <li>
                                <p>Заявки за месяц</p>
                                <button class="btn btn-small add-widget-button" type="StatBoxWidget"
                                        widget-name="requests_stat" data-size-x="2"
                                        data-size-y="1" stat="stat">Добавить
                                </button>
                            </li>
                            <li>
                                <p>Комментарии за месяц</p>
                                <button class="btn btn-small add-widget-button" type="StatBoxWidget"
                                        widget-name="request_comments_stat" data-size-x="2"
                                        data-size-y="1" stat="stat">Добавить
                                </button>
                            </li>
                        </ul>
                    </div>

                </div>
            </li>
            <li>
                <img src="img/widgets_thumbs/grid.png" width="155" height="155" style="float: left;">

                <div style="padding-left: 155px">
                    <div class='widget-name'>Таблицы</div>
                    <div class="widget-description">
                        <ul class="widgets-elements">
                            <li>
                                <p>Запросы с просроченным "Next step"</p>
                                <button class="btn btn-small add-widget-button" type="grid"
                                        widget-name="_requestsGrid" data-size-x="1"
                                        data-size-y="1">Добавить
                                </button>
                            </li>
                            <li>
                                <p>Заявки с вылетом в ближайшие 7 дней</p>
                                <button class="btn btn-small add-widget-button" type="grid"
                                        widget-name="_ordersGrid" data-size-x="1"
                                        data-size-y="1">Добавить
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="modal-footer">
        <a href="#" data-dismiss="modal" class="btn">Закрыть</a>
    </div>
</div>
<script>
    $(document).ready(function(){
        $.create_dashboard();
    });
</script>