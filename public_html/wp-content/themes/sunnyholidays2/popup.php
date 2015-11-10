<?php
/**
 * Template Name: Popup
 */

?>
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
    <?php wp_head(); ?>


</head>
<body>

    <div id="content">

            <div id="items full">
                <div class="item item-full">
                    <div class="item-body">
                        <?php
                        the_post();
                        the_content();
                        ?>
                    </div>
                </div>

            </div>

    </div>

<?php wp_footer(); ?>
</body>
</html>