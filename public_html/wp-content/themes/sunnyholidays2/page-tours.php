<?php
/**
 * Template Name: Поиск туров
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
            <?php get_sidebar("search-tours");?>
        </div>
    </div>
    
<?php get_footer(); ?>