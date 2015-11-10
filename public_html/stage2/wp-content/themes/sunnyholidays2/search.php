<?php get_header(); ?>

    <div id="content">
        <div class="padding-w-170">
            <div id="items">
                <?php if (have_posts()) : ?>
                    <h1 class="search-title">Результаты для запроса:  <b>"<?php echo get_search_query();?>"</b></h1>

                    <?php /* Start the Loop */ ?>
                    <?php while (have_posts()) : the_post(); ?>

                        <?php get_template_part('content'); ?>

                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="item-full item">
                        <h1>
                            Ничего не найдено!
                        </h1>
                        <div class="entry-content">
                            <p>Запрашиваемая по запросу <b>"<?php echo get_search_query();?>"</b> страница не найдена в архиве. Попробуйте изменить запрос.</p>
                            <?php get_search_form();?>
                        </div><!-- .entry-content -->
                    </div>
                <?php endif; ?>


                <div id="pagination">
                    <?php
                    get_blog_pagination();
                    ?>
                </div>
            </div>


            <?php get_sidebar();?>
        </div>
    </div>
<?php get_footer(); ?>