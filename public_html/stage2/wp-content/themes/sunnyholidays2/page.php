
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
                    <div class="metadata">
                        <?php edit_post_link(__('Изменить', 'sunnyholidays2'), '<span class="edit-link">', '</span>'); ?>


                    </div>
                </div>

            </div>
            <?php get_sidebar();?>
        </div>
    </div>
<?php get_footer(); ?>