<!DOCTYPE html>
<html lang="en">
<head>
    <title>Панель администратора</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?php
    Yii::app()->clientScript->registerCoreScript('jquery');

    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl . '/css/bootstrap.min.css');
    $cs->registerCssFile($baseUrl . '/css/bootstrap-responsive.min.css');
    $cs->registerCssFile($baseUrl . '/css/unicorn.login.css');
    $cs->registerCssFile($baseUrl . '/css/jquery.gritter.css');
    $cs->registerCssFile($baseUrl . '/css/custom.css');
    $cs->registerScriptFile($baseUrl . '/js/unicorn.login.js');
    $cs->registerScriptFile($baseUrl . '/js/jquery.gritter.min.js');
    $cs->registerScriptFile($baseUrl . '/js/bootstrap-tooltip.js');
    $cs->registerScriptFile($baseUrl . '/js/custom/error_messages.js');

    ?>

</head>
<body>
<div id="logo">
    <img src="img/logo.png" alt=""/>
</div>
<div id="loginbox">
    <?php
    echo $content;
    ?>
</div>
</body>
</html>
