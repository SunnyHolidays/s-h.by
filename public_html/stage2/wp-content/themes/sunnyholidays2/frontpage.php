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
                        <script type="text/javascript" language="JavaScript" src="http://tourclient.ru/f/jsboot/85327/find_tour_form?style=default&conf=default"></script>
                        <!--END OF MODULE BLOCK-->

                    </div>
                </div>
                <div class="block2">
                    <div class="title">Горящий тур</div>
                    <div class="container"><img src="<?php echo get_template_directory_uri(); ?>/img/img1.png">
                        <span style="color: red;font-weight: bold;font-size: 24px;line-height: 20px;">Акция!</span>

                        <p class='main-text'>Повседневная практика показывает, что укрепление и развитие структуры
                            требуют определения и уточнения направлений прогрессивного развития. </p>

                        <p class="sub-text">Не следует, однако забывать, что дальнейшее развитие различных форм
                            деятельности в значительной степени обуславливает создание системы обучения</p>
                    </div>
                </div>
                <div class="block3"><img src="<?php echo get_template_directory_uri(); ?>/img/img2.png">

                    <p>Задача организации, в особенности же консультация с широким активом требуют от нас анализа модели
                        развития. С другой стороны начало повседневной работы по формированию позиции способ</p></div>
            </div>
        </div>
        <div id="bottom-nav">
            <div class="padding-w-170">
                <ul>
                    <li class="active"><a href="#">Популярное</a></li>
<!--                    <li><a href="#">Горячие путевки</a></li>
                    <li><a href="#">Лучшие по оценкам</a></li>
                    <li><a href="#">Лето 2013</a></li>
                    <li><a href="#">Зима 2013/2014</a></li>-->
                </ul>
            </div>
        </div>
    </div>

    <div id="content">
        <div class="padding-w-170">
            <?php get_sidebar( 'front' ); ?>
        </div>
    </div>
    <div id="partners">
        <div class="padding-w-170">
            <p class="title">Наши партнеры:</p>
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
            <span class="title">Новости</span>
            <a href="<?php bloginfo('rss2_url'); ?>" id="subscribe">Подписаться</a>

            <div id="news">
                <?php if (have_posts()) : ?>


                    <?php query_posts('posts_per_page=3');
                    $i = 0; ?>
                    <?php while (have_posts()) : the_post();
                        $i++; ?>

                        <div class="news-item">
                            <h5><span class="number"><?php echo $i;?></span><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h5>

                            <div class="item-body">
                                <?php new_excerpt_length();?>
                                <a href="<?php the_permalink(); ?>"><?php the_excerpt();?></a>
                            </div>


                        </div>

                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#partners-sprite').liMarquee({
                direction: 'left',
                loop:-1,
                scrollamount:50,
                circular: true,
                drag: true
            });
        })

    </script>
<?php get_footer(); ?>