<!DOCTYPE html>
<html>
<head>
    <title>SunnyHolidays</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta charset="UTF-8" />
    <?php wp_head();?>
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon" />
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans+Caption:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/normalize.css" />

    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/chosen.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/jquery-ui.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/form-style.css" media="screen">
    <script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/chosen.jquery.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/jquery-ui-1.9.1.custom.min.js"></script>
    <script type="text/javascript">
        function placeholderForIE() {
            if ($.browser.msie) {         //this is for only ie condition ( microsoft internet explore )
                $('input[type="text"][placeholder], textarea[placeholder]').each(function () {
                    var obj = $(this);

                    if (obj.attr('placeholder') != '') {
                        obj.addClass('IePlaceHolder');

                        if ($.trim(obj.val()) == '' && obj.attr('type') != 'password') {
                            obj.val(obj.attr('placeholder'));
                        }
                    }
                });

                $('.IePlaceHolder').focus(function () {
                    var obj = $(this);
                    if (obj.val() == obj.attr('placeholder')) {
                        obj.val('');
                    }
                });

                $('.IePlaceHolder').blur(function () {
                    var obj = $(this);
                    if ($.trim(obj.val()) == '') {
                        obj.val(obj.attr('placeholder'));
                    }
                });
            }
        }

        $(document).ready(function () {
            placeholderForIE();
            $("#submit").on('click', function () {

                $('#error_form').hide('fast');
                if (!checkmail($("#form #mail").val())) {
                    return false;
                } else {
                    $("#submit").prop('disabled', true);
                    $("#submit").val('Ваш запрос отправляется...');
                    childb = new Array();
                    $("#children-birthday input").each(function () {
                        if (($(this).attr("id") != 'people') && ($(this).attr("id") != 'children_number'))
                            childb.push($(this).val());
                    });
                    checkbox = new Array();
                    $("#terms input").each(function () {
                        if ($(this).is(':checked'))
                            checkbox.push($(this).attr("id"));
                    });
                    $.post("/mail/", {

                            country:$("#form #country").val(),
                            period_from:$("#form #period_from").val(),
                            period_to:$("#form #period_to").val(),
                            duration:$("#form #amount").val(),
                            departure:$("#form #departure").val(),
                            people:$("#form #people").val(),
                            children_number:$("#form #children_number").val(),
                            "children_birthday[]":childb,
                            money_amount:$("#form #money-amount").val(),
                            category:$("#form #category-val").val(),
                            food:$("#form #food option:selected").val(),
                            "checkbox[]":checkbox,
                            fname:$("#form #fname").val(),
                            lname:$("#form #lname").val(),
                            mail:$("#form #mail").val(),
                            phone:$("#form #phone").val(),
                            subscribe:$("#form #subscribe:checked").attr("id"),
                            comment:$("#form #comment").val()

                        },
                        function (data) {
                            if (data == 'error') {
                                $("#submit").prop('disabled', false);
                                $("#submit").val('Отправить запрос');
                                $('#error_form').html('Ошибка отправки. Проверьте, пожалуйста, все-ли поля заполнены.');
                                $('#error_form').show('fast');
                            } else {
                                $(location).attr('href','/mail-success/');
                            }

                        });
                }
                function checkmail(value) {
                    var reg = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
                    //var reg = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+(?:[A-Z]{2}|com|org|net|edu|gov|mil|biz|info|mobi|name|aero|asia|jobs|museum)\b/;
                    if (!value.match(reg)) {
                        $('#error_form').html('Пожалуйста, проверьте свой введённый e-mail');
                        $('#error_form').show('fast');
                        $("#form #mail").focus();
                        return false;
                    }
                    return true;
                }


            });
        });

    </script>

</head>
<body>
<div id="container">

    <div id="header">
        <div class="padding-w-170">
            <div id="logo">
                <a href=" <?php echo get_site_url(); ?> "><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png"></a>
            </div>
            <div class="contacts">
                <img src="<?php echo get_template_directory_uri(); ?>/img/call-icon.png">
                <p> 8 (0152) 72-00-22</p>

                <p>8 (0152) 75-71-67</p>
            </div>
            <div id="skype">
                <img src="<?php bloginfo( 'template_url' ); ?>/img/skype-icon.png">

                <p class="title">Skype:</p>

                <p><a href="skype:sunnyholidays.by?chat">sunnyholidays.by</a></p>
            </div>
            <div class="address">
                <p class="title">Наш адрес:</p>

                <p>г. Гродно, ул. Буденного, 48а-46 (3 этаж)</p>
                <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/gmap_pointer.png">Посмотреть на
                    карте</a>
            </div>
        </div>
    </div>
    <?php if(is_super_admin()): ?>
        <div id="nav">
            <div id="top-nav">
                <div class="padding-w-170">
                    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'menu',) ); ?>
                    <?php get_search_form();?>
                </div>
            </div>
        </div>
    <?php else : ?>
    <div id="nav" style="min-height: 0!important;box-shadow: none"></div>
<?php endif; ?>