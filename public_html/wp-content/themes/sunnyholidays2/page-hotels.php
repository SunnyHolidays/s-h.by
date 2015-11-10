<?php
/**
 * Template Name: Поиск отелей
 */

?>
<?php get_header(); ?>
    <div id="content">
        <div class="padding-w-170">
            <div id="items">
                <div class="item item-full">
                    <h1><?php the_title(); ?></h1>

                    <div class="item-body">
                        <?php
                        the_post();
                        the_content();

                        ?>

                    </div>
                </div>

            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
    <link rel='stylesheet' type="text/css" href="<?php bloginfo('template_url'); ?>/css/hotels.css">

    <script>
        $(document).ready(function () {
            $('.hcsb_guests').find('option:last').remove();
        });

    </script>
<?php get_footer(); ?>
