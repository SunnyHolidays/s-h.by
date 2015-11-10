<?php
/**
 * Created by JetBrains PhpStorm.
 * User=> amd1648
 * Date=> 09.09.13
 * Time=> 12=>32
 * To change this template use File | Settings | File Templates.
 */

return array(
    'widgets' => array(
        'users_orders' => array(
            'params' => array(
                'modelData' => 'Orders',
                'dataAttribute' => 'user_id',
                'relation' => 'user',
                'header' => 'last_name',
                'widgetHeader' => 'Процент заказов для каждого менеджера',
            ),
            'widgetType' => 'PieChartWidget',
            'size_x' => 1,
            'size_y' => 2
        ),
        'countries' => array(
            'params' => array(
                'modelData' => 'PackageTour',
                'dataAttribute' => 'country_id',
                'relation' => 'country',
                'header' => 'title',
                'widgetHeader' => 'Посещаемые страны',
            ),
            'widgetType' => 'PieChartWidget',
            'size_x' => 1,
            'size_y' => 2
        ),
        'users_requests' => array(
            'params' => array(
                'modelData' => 'Requests',
                'dataAttribute' => 'user_id',
                'relation' => 'user',
                'header' => 'last_name',
                'widgetHeader' => 'Процент заявок для каждого менеджера',
            ),
            'widgetType' => 'PieChartWidget',
            'size_x' => 1,
            'size_y' => 2
        ),
        'month_orders' => array(
            'params' => array(
                'modelData' => 'PackageTour',
                'attributes' => array(
                    'date'
                ),
                'color' => '#71c73e',
                'widgetHeader' => 'Соотношение заказов по месяцам',
                'labels' => array(
                    'Месяц', 'Количество продаж'
                ),
                'type' => 'lines',
            ),
            'widgetType' => 'FlotChartWidget',
            'size_x' => 1,
            'size_y' => 2
        ),
        'countries_orders' => array(
            'params' => array(
                'modelData' => 'PackageTour',
                'attributes' => array(
                    'country_id', 'country', 'title'
                ),
                'color' => '#71c73e',
                'widgetHeader' => 'Соотношение заказов по странам',
                'labels' => array(
                    'Страна', 'Количество продаж'
                ),
                'type' => 'bars',
            ),
            'widgetType' => 'FlotChartWidget',
            'size_x' => 1,
            'size_y' => 2
        ),
        'orders_stat' => array(
            'params' => array(
                'model' => 'Orders',
                'label' => 'Заказы'
            ),
            'widgetType' => 'StatBoxWidget',
            'size_x' => 2,
            'size_y' => 1
        ),
        'request_comments_stat' => array(
            'params' => array(
                'model' => 'RequestComments',
                'label' => 'Комментарии'
            ),
            'widgetType' => 'StatBoxWidget',
            'size_x' => 2,
            'size_y' => 1
        ),
        'requests_stat' => array(
            'params' => array(
                'model' => 'Requests',
                'label' => 'Заявки'
            ),
            'widgetType' => 'StatBoxWidget',
            'size_x' => 2,
            'size_y' => 1
        ),
        '_requestsGrid' => array(
            'widgetType' => 'grid',
            'size_x' => 1,
            'size_y' => 1,
            'params' => array()
        ),
        '_ordersGrid' => array(
            'widgetType' => 'grid',
            'size_x' => 1,
            'size_y' => 1,
            'params' => array()
        ),
    ),

);