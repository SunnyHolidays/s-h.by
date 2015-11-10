<?php get_header(); ?>

    <div id="content">
        <div class="padding-w-170">
            <div id="items">
                <?php if (have_posts()) : ?>


                    <?php /* Start the Loop */ ?>
                    <?php while (have_posts()) : the_post(); ?>

                        <?php get_template_part('content'); ?>

                    <?php endwhile; ?>
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