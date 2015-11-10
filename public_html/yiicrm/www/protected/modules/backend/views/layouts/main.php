<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?php
    Yii::app()->clientScript->registerCoreScript('jquery');
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl . '/css/bootstrap.min.css');
    $cs->registerCssFile($baseUrl . '/css/bootstrap-responsive.min.css');
    $cs->registerCssFile($baseUrl . '/css/fullcalendar.css');
    $cs->registerCssFile($baseUrl . '/css/uniform.css');
    $cs->registerCssFile($baseUrl . '/css/unicorn.main.css');
    $cs->registerCssFile($baseUrl . '/css/unicorn.grey.css');
    $cs->registerCssFile($baseUrl . '/css/select2.css');
    $cs->registerCssFile($baseUrl . '/css/jquery-ui.css');
    $cs->registerCssFile($baseUrl . '/js/gridster/jquery.gridster.css');
    $cs->registerCssFile($baseUrl . '/css/custom.css');
    $cs->registerCssFile($baseUrl . '/css/jquery.gritter.css');
    $cs->registerCssFile($baseUrl . '/css/jquery.fileupload.css');
    $cs->registerCssFile($baseUrl . '/css/jquery.fileupload-ui.css');
    $cs->registerScriptFile($baseUrl . '/js/select2.js');
    $cs->registerScriptFile($baseUrl . '/js/jquery.validate.js');
    $cs->registerScriptFile($baseUrl . '/js/excanvas.min.js');
    $cs->registerScriptFile($baseUrl . '/js/jquery-ui.custom.js');
    $cs->registerScriptFile($baseUrl . '/js/bootstrap.min.js');
    $cs->registerScriptFile($baseUrl . '/js/jquery.flot.min.js');
    $cs->registerScriptFile($baseUrl . '/js/highcharts.js');
    $cs->registerScriptFile($baseUrl . '/js/exporting.js');
    /*todo проверить нужны ли эти js для чартов, ибо загружать левые не нужные js не збс*/
    $cs->registerScriptFile($baseUrl . '/js/jquery.flot.pie.min.js');
    $cs->registerScriptFile($baseUrl . '/js/jquery.flot.pie.min.js');
    $cs->registerScriptFile($baseUrl . '/js/jquery.flot.resize.min.js');
    $cs->registerScriptFile($baseUrl . '/js/jquery.flot.axislabels.js');
    /* to do end */
    $cs->registerScriptFile($baseUrl . '/js/jquery.peity.min.js');
    $cs->registerScriptFile($baseUrl . '/js/jquery.uniform.js');
    $cs->registerScriptFile($baseUrl . '/js/fullcalendar.min.js');
    $cs->registerScriptFile($baseUrl . '/js/unicorn.js');
    $cs->registerScriptFile($baseUrl . '/js/unicorn.dashboard.js');
    $cs->registerScriptFile($baseUrl . '/js/custom/error_messages.js');
    $cs->registerScriptFile($baseUrl . '/js/custom/crm-ui.js');
    $cs->registerScriptFile($baseUrl . '/js/custom/dashboard.js');
    $cs->registerScriptFile($baseUrl . '/js/jquery.gritter.min.js');
    $cs->registerScriptFile(Yii::app()->baseUrl.'/js/up/jquery.fileupload.js');
    $cs->registerScriptFile(Yii::app()->baseUrl.'/js/up/jquery.fileupload-ui.js');
    $cs->registerScriptFile($baseUrl . '/js/gridster/jquery.gridster.js');
    $cs->registerScriptFile($baseUrl . '/js/widgets/yiiPieChart.js');
    $cs->registerScriptFile($baseUrl . '/js/widgets/yiiFlotChart.js');
    $cs->registerScriptFile($baseUrl . '/js/widgets/yiiStatBox.js');
    $cs->registerScriptFile($baseUrl . '/js/custom/orders_math.js');
    $cs->registerScriptFile($baseUrl . '/js/custom/responsivity.js');
    $cs->registerScriptFile($baseUrl . '/js/spin.min.js');

    $url = Yii::app()->controller->id;

    $cs->registerScript(
        'ativeMenuItem',
        '
            $(function(){
                    var request = "' . Yii::app()->controller->id . '"
             if(request=="dashboard"){
                $("#dashboard").attr("class","active");
             }
             if(request=="requests"){
                $("#requests").attr("class","active");
             }
             if(request=="orders"){
                $("#orders").attr("class","active");
             }
             if(request=="finances"){
                $("#finances").attr("class","active");
             }
             if(request=="mailTemplates"){
                $("#mail-templates").attr("class","active");
             }
             if(request=="users"){
                $("#users").attr("class","active");
             }
             if(request=="places"){
                $("#places").attr("class","active");
             }
        });
    '
    );
    ?>
</head>
<body>


<div id="header">
    <h1><?php echo CHtml::link(Yii::app()->name, array()); ?></h1>
</div>

<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav btn-group">
        <li class="btn btn-inverse">
            <?php echo CHtml::link(
                '<i class="icon icon-user"></i> <span class="text">Профиль',
                array('/backend/users/view', 'id' => Yii::app()->user->id)
            );
            ?>
        </li>
        <?php if (Yii::app()->user->isGuest) { ?>
            <li class="btn btn-inverse">
                <?php echo CHtml::link(
                    '<i class="icon icon-share-alt"></i> <span class="text">Войти</span>',
                    array('/backend/default/login')
                );
                ?>
            </li>
        <?php } else { ?>
            <li class="btn btn-inverse">
                <?php echo CHtml::link(
                    '<i class="icon icon-share-alt"></i> <span class="text">Выход (' . Yii::app()->user->name . ')</span>',
                    array('/backend/default/logout')
                );
                ?>
            </li>
        <?php } ?>


    </ul>
</div>
<div id="sidebar">
    <ul>
        <li id="dashboard"><?php echo CHtml::link(
                '<i class="icon icon-home"></i> <span>Dashboard</span>',
                array('/backend/dashboard')
            ); ?></li>
        <li id="requests"><?php echo CHtml::link(
                '<i class="icon icon-file"></i> <span>Заявки</span>',
                array('/backend/requests')
            ); ?></li>
        <li id="orders"><?php echo CHtml::link(
                '<i class="icon icon-file"></i> <span>Заказы</span>',
                array('/backend/orders')
            ); ?></li>
        <li id="finances">
            <?php echo CHtml::link(
                '<i class="icon icon-file"></i><span>Финансы</span>', array('/backend/finances')
            ); ?>
        </li>
        <li id="mail-templates">
            <?php echo CHtml::link(
                '<i class="icon icon-envelope"></i><span>Шаблоны писем</span>',
                array('/backend/mailTemplates')
            ); ?>
        </li>
        <li id="users">
            <?php echo CHtml::link(
                '<i class="icon icon-user"></i><span>Пользователи</span>',
                array('/backend/users')
            ); ?>
        </li>
        <li id="places">
            <?php echo CHtml::link('<i class="icon icon-plane"></i><span>Места</span>', array('/backend/places')); ?>
        </li>
    </ul>

</div>
<div id="content">

    <?php echo $content;?>

</div>
<div class="global-modal modal hide fade"></div>
</body>
</html>
<script>
    $(document).ready(function(){
        $(document).on('resize',function () {
            tooltipPlacement();
        })
    })
</script>
