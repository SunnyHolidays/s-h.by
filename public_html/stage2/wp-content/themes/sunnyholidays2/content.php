<div class="item">


    <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
    <span class="date"><?php echo get_the_date(get_option('date_format'));?></span>

    <div class="item-body">
        <?php
        the_post_thumbnail();
        the_excerpt();
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
        <a class="read-full" href="<?php the_permalink(); ?>">Читать дальше</a>

    </div>
</div>






