<?php
/* @var $this DefaultController */
$this->breadcrumbs = array(
    'Dashboard'
);
$this->header = 'Dashboard';
?>
<div class="span3 test"></div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="span-3 offset3">
                <?php $this->widget(
                    'StatBoxWidget',
                    array(
                        'model' => Orders::model(),
                        'label' => 'Заказы'
                    )
                );
                ?>
                <?php $this->widget(
                    'StatBoxWidget',
                    array(
                        'model' => Requests::model(),
                        'label' => 'Заявки'
                    )
                );
                ?>
                <?php $this->widget(
                    'StatBoxWidget',
                    array(
                        'model' => RequestComments::model(),
                        'label' => 'Комментарии'
                    )
                );
                ?>
            </div>
        </div>
        <div class="span-12">
            <div class="span6">
                <?php
                $this->widget(
                    'PieChartWidget',
                    array(
                        'modelHeader' => Countries::model(),
                        'modelData' => Orders::model(),
                        'attributes' => array('title', 'country_id'),
                        'widgetHeader' => 'Посещаемые страны'
                    )
                );
                ?>
            </div>
            <div class="span6">
                <?php
                $this->widget(
                    'PieChartWidget',
                    array(
                        'modelHeader' => Users::model(),
                        'modelData' => Requests::model(),
                        'attributes' => array('last_name', 'user_id'),
                        'widgetHeader' => 'Процент заказов для каждого менеджера'
                    )
                );
                ?>
            </div>
        </div>
        <div class="span-12">
            <div class="span6">
                <?php
                echo $this->renderPartial('_requestsGrid');
                ?>
            </div>
            <div class="span6">
                <?php
                echo $this->renderPartial('_ordersGrid');
                ?>
            </div>
        </div>
        <div class="span-12">
            <div class="span6">
                <?php
                $this->widget(
                    'FlotChartWidget',
                    array(
                        'modelData' => Orders::model(),
                        'attributes' => array('country_id','country','title'),
                        'color' => '#71c73e',
                        'widgetHeader' => 'Соотношение заказов по странам',
                        'labels' => array('Страна','Количество продаж'),
                        'type' => 'bars',
                    )
                );
                ?>
            </div>
            <div class="span6">
                <?php
                $this->widget(
                    'FlotChartWidget',
                    array(
                        'modelData' => Orders::model(),
                        'attributes' => array('date'),
                        'color' => '#71c73e',
                        'widgetHeader' => 'Соотношение заказов по месяцам',
                        'labels' => array('Месяц','Количество продаж'),
                        'type' => 'lines'
                    )
                );
                ?>
            </div>
        </div>
    </div>
</div>
