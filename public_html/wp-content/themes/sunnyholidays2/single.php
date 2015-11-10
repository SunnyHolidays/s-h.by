<?php get_header(); ?>

    <div id="content">
        <div class="padding-w-170">
            <div id="items">
                <div class="item item-full">
                    <h1><?php the_title(); ?></h1>
                    <span class="date"><?php echo get_the_date(get_option('date_format'));?></span>

                    <div class="item-body post">
                        <?php
                        the_post();
                        the_content();
                        ?>
                    </div>
                    <div class="metadata">
                        <?php edit_post_link(__('Изменить', 'sunnyholidays2'), '<span class="edit-link">', '</span>'); ?>
                        <span class="comments">
                        <?php if (comments_open()) : ?>

                                <?php
                                comments_popup_link(
                                    '' . __('Оставить комментарий', 'sunnyholidays2') . '</span>',
                                    __('1 комментарий', 'sunnyholidays2'),
                                    __('% комментариев', 'sunnyholidays2')
                                ); ?>
                            <?php endif; // comments_open() ?></span>

                    </div>
                </div>
                <div id="nav-single">
                    <h1 class="assistive-text"><?php _e( 'Навигация по записям', 'twentytwelve' ); ?></h1>
                    <span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentytwelve' ) . '</span> %title' ); ?></span>
                    <span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentytwelve' ) . '</span>' ); ?></span>
                </div>
                <?php get_comments();?>
                <?php comments_template( '', true ); ?>
            </div>
            <?php get_sidebar();?>
        </div>
    </div>
<?php get_footer(); ?>