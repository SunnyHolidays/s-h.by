<?php
/*
Template Name: Главная страница
*/
?>
<?php get_header(); ?>
    <div id="second-nav">
        <div id="nav-body">
            <div class="padding-w-170">
                <div class="block1">
                    <div class="title">Поиск путевок</div>
                    <div class="container">
                        <!--BEGIN OF MODULE BLOCK-->
                        <script type="text/javascript" language="JavaScript"
                                src="http://tourclient.ru/f/jsboot/85327/find_tour_form?style=homepage&conf=default"></script>
                        <!--END OF MODULE BLOCK-->

                    </div>
                </div>
                <div class="block2">
                <div class="title">Специальное предложение</div>
                <a href="/promos/canary/"><img src="<?php echo content_url(); ?>/uploads/2015/07/canary-banner.jpg" border="0"></a>
                </div>
                <div class="block3"><a target="_blank" href="/promos/tours-of-the-day/"><img src="<?php echo get_template_directory_uri(); ?>/img/img2.png">
                    <p class="line1">Объявлен сезон охоты за СКИДКАМИ!</p>
                    <p class="line2">Каждый день новые спецпредложения по самым низким ценам!</p></a>
                </div>
            </div>

        </div>

        <div id="bottom-nav">

            <div class="padding-w-170">
                <a id="tab"></a>
                <ul>
                    <?php
                    $pages = get_pages(
                        array('child_of' => $post->ID, 'sort_column' => 'menu_order',)
                    );
                    $i = 0;
                    foreach ($pages as $page):
                        $i++;
                        if ($i != 1):
                            ?>
                            <li><a class="tab<?php echo $i; ?>" href="#tab"><?php echo $page->post_title; ?></a></li>
                        <?php else : ?>
                            <li class='active'><a class="tab<?php echo $i; ?>"
                                                  href="#tab"><?php echo $page->post_title; ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <div id="content" class='tabs'>
        <div class="padding-w-170">

            <?php
            $i = 0;
            foreach ($pages as $page):
                $i++;
                if ($i != 1):
                    ?>
                    <div class="tab<?php echo $i; ?>"><?php echo $page->post_content; ?></div>
                <?php else : ?>
                    <div class=" active tab<?php echo $i; ?>"><?php echo $page->post_content; ?></div>
                <?php endif; ?>
            <?php endforeach; ?>

        </div>
    </div>
    <div id="partners">
        <div class="padding-w-170">
            <p class="title">У нас можно забронировать туры:</p>

            <div id='partners-sprite'>
                <a href="#" class="sprite-alfastar"></a>
                <a href="#" class="sprite-anex-tour"></a>
                <a href="#" class="sprite-biblio-globus"></a>
                <a href="#" class="sprite-coral-travel"></a>
                <a href="#" class="sprite-eco-tour-6"></a>
                <a href="#" class="sprite-exim"></a>
                <a href="#" class="sprite-intercity"></a>
                <a href="#" class="sprite-intourist"></a>
                <a href="#" class="sprite-itaka"></a>
                <a href="#" class="sprite-join-up"></a>
                <a href="#" class="sprite-mouzenidis-travel-logo"></a>
                <a href="#" class="sprite-natalie-tours"></a>
                <a href="#" class="sprite-pegas-touristik"></a>
                <a href="#" class="sprite-rosting"></a>
                <a href="#" class="sprite-sanrayz-tur"></a>
                <a href="#" class="sprite-sunfun"></a>
                <a href="#" class="sprite-sunmar"></a>
                <a href="#" class="sprite-tez-tour"></a>
                <a href="#" class="sprite-top-tour"></a>
                <a href="#" class="sprite-troyka"></a>
                <a href="#" class="sprite-tui"></a>
                <a href="#" class="sprite-turtess"></a>
                <a href="#" class="sprite-tusson-voyage"></a>
                <a href="#" class="sprite-ukrest"></a>
                <a href="#" class="sprite-ecco-holiday"></a>
                <a href="#" class="sprite-citron"></a>
                <a href="#" class="sprite-beefree"></a>
                <a href="#" class="sprite-7-islands"></a>
                <a href="#" class="sprite-grecos"></a>
                <a href="#" class="sprite-wezyr"></a>
                <a href="#" class="sprite-rainbowtours"></a>
                <a href="#" class="sprite-neckermann"></a>
                <a href="#" class="sprite-net-holiday"></a>
            </div>
        </div>

    </div>
    <div id="news-feed">
        <div class="padding-w-170">
            <a href="/category/news/"><span class="title">Новости</span></a>
            <a href="<?php bloginfo('rss2_url'); ?>" id="subscribe">Подписаться</a>

            <table id="news" class="news-table">
                <?php if (have_posts()) : ?>
                    <?php query_posts('category_name=news&posts_per_page=3');
                    $i = 0; ?>
                    <tr>
                        <?php while (have_posts()) : the_post();
                            $i++; ?>
                            <th>
                                <h5><span class="number"><?php echo $i; ?></span><a
                                        href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h5>
                            </th>

                        <?php endwhile; ?>
                    </tr>
                    <tr>
                        <?php while (have_posts()) : the_post();
                            $i++; ?>
                            <td class="item-body">
                                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                            </td>

                        <?php endwhile; ?>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            jQuery.noConflict();
            $('#partners-sprite').liMarquee({
                direction: 'left',
                loop: -1,
                scrollamount: 50,
                circular: true,
                drag: true
            });
            jQuery.noConflict();
            $('#bottom-nav li a').on('click', function (event) {
                event.preventDefault();
                $('html,body').animate({
                    scrollTop: $('a#tab').offset().top - 10
                }, 500);

            });

            var current = 'tab1';
            $('#bottom-nav li a:not(.active)').on('click', function (event) {
                $('#content.tabs').spin('small');
                $('#bottom-nav li.active').removeClass();
                $('#content.tabs .active').attr('class', current);
                current = $(this).attr('class');
                $(this).parent().addClass('active');
                $('#content.tabs').find('.' + current).addClass('active');
                $('#content.tabs').spin(false);
            });
        })

    </script>
<?php get_footer(); ?>