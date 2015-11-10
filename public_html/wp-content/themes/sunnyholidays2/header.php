<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>
        <?php
        wp_title('|', true, 'right');
        ?></title>
    <link rel="icon" href="<?php bloginfo( 'template_url' ); ?>/favicon.ico" type="image/x-icon"/>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700&subset=latin,cyrillic' rel='stylesheet'
          type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans+Caption:400,700&subset=latin,cyrillic' rel='stylesheet'
          type='text/css'>
    <link rel='stylesheet' type="text/css" href="<?php bloginfo( 'template_url' ); ?>/style.css">
    <script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/jquery-1.9.0.min.js"></script>
    <link rel='stylesheet' type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/liMarquee.css">
    <script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/jquery.liMarquee.js"></script>
    <link rel='stylesheet' type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/flexslider.css">
    <script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/jquery.flexslider-min.js">
    </script>
    <link rel='stylesheet' type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/magnific-popup.css">
    <script type="text/javascript"
            src="<?php bloginfo( 'template_url' ); ?>/js/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/spin.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/spin.helper.js"></script>

    <?php wp_head(); ?>

</head>
<body>
<div id="container">

    <div id="header">
        <div class="padding-w-170">
            <div id="logo">
                <a href=" <?php echo get_site_url(); ?> "><img
                        src="<?php bloginfo( 'template_url' ); ?>/img/logo.png"></a>
            </div>
            <div class="contacts">
                <img src="<?php bloginfo( 'template_url' ); ?>/img/call-icon.png">
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
                <a href="/about/contacts/#map"><img src="<?php bloginfo( 'template_url' ); ?>/img/gmap_pointer.png">Посмотреть на
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