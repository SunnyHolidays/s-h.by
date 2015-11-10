<?php get_header(); ?>

    <div id="content">
        <div class="padding-w-170">
            <div id="items">
                    <div class="item-full item">
                        <h1>
                            Страница не найдена
                        </h1>
                        <div class="entry-content">
                            <p>Запрашиваемая страница не найдена в архиве. Попробуйте воспользоватья поиском.</p>
                            <?php get_search_form();?>
                        </div><!-- .entry-content -->
                    </div>
            </div>
            <?php get_sidebar();?>
        </div>
    </div>
<?php get_footer(); ?>