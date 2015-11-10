<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>
        <?php
        wp_title('|', true, 'right');
        ?></title>
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon"/>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700&subset=latin,cyrillic' rel='stylesheet'
          type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans+Caption:400,700&subset=latin,cyrillic' rel='stylesheet'
          type='text/css'>
    <link rel='stylesheet' type="text/css" href="<?php echo get_template_directory_uri(); ?>/style.css">
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.9.0.min.js"></script>
    <link rel='stylesheet' type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/liMarquee.css">
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.liMarquee.js"></script>
    <link rel='stylesheet' type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/flexslider.css">
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.flexslider-min.js">
    </script>
    <link rel='stylesheet' type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/magnific-popup.css">
    <script type="text/javascript"
            src="<?php echo get_template_directory_uri(); ?>/js/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/spin.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/spin.helper.js"></script>
    <?php wp_head(); ?>


</head>
<body>
<div id="container">

    <div id="header">
        <div class="padding-w-170">
            <div id="logo">
                <a href=" <?php echo get_site_url(); ?> "><img
                        src="<?php echo get_template_directory_uri(); ?>/img/logo.png"></a>
            </div>
            <div class="contacts">
                <img src="<?php echo get_template_directory_uri(); ?>/img/call-icon.png">

                <p>8 (029) 5828667</p>

                <p> 8 (0152) 72-00-22</p>
            </div>
            <div id="skype">
                <img src="<?php echo get_template_directory_uri(); ?>/img/skype-icon.png">

                <p class="title">Skype:</p>

                <p>sunnyholidays.by</p>
            </div>
            <div class="address">
                <p class="title">Наш адрес:</p>

                <p>г. Гродно, ул. Буденного, 48а-403</p>
                <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/gmap_pointer.png">Посмотреть на
                    карте</a>
            </div>
        </div>
    </div>
    <div id="nav">
        <div id="top-nav">
            <div class="padding-w-170">

                <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'menu',)); ?>
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>