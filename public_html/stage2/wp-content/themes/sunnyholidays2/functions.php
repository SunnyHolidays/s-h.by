<?php

function sunnyholidays2_setup()
{
    // Adds RSS feed links to <head> for posts and comments.
    add_theme_support('automatic-feed-links');

    // This theme supports a variety of post formats.
    add_theme_support('post-formats', array('aside', 'image', 'link', 'quote', 'status'));

    // This theme uses wp_nav_menu() in one location.
    register_nav_menu('primary', __('Primary Menu', 'twentytwelve'));

    // This theme uses a custom image size for featured images, displayed on "standard" posts.
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(624, 9999); // Unlimited height, soft crop
}

add_action('after_setup_theme', 'sunnyholidays2_setup');

function sunnyholidays2_wp_title($title, $sep)
{
    global $paged, $page;

    if (is_feed()) {
        return $title;
    }

    // Add the site name.
    $title .= get_bloginfo('name');

    // Add the site description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && (is_home() || is_front_page())) {
        $title = "$title $sep $site_description";
    }

    // Add a page number if necessary.
    if ($paged >= 2 || $page >= 2) {
        $title = "$title $sep " . sprintf(__('Page %s', 'twentytwelve'), max($paged, $page));
    }

    return $title;
}

add_filter('wp_title', 'sunnyholidays2_wp_title', 10, 2);

function sunnyholidays2_page_menu_args($args)
{
    if (!isset($args['show_home'])) {
        $args['show_home'] = true;
    }
    return $args;
}

add_filter('wp_page_menu_args', 'sunnyholidays2_page_menu_args');


function sunnyholidays2_widgets_init()
{
    register_sidebar(
        array(
            'name' => __('Главный сайдбар', 'sunnyholidays2'),
            'id' => 'sidebar-1',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        )
    );

    register_sidebar( array(
            'name' => __( 'Первый сайдбар главной страницы', 'sunnyholidays2' ),
            'id' => 'sidebar-2',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ) );
    register_sidebar( array(
            'name' => __( 'Сайдбар формы заказа', 'sunnyholidays2' ),
            'id' => 'sidebar-3',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ) );

}

add_action('widgets_init', 'sunnyholidays2_widgets_init');



if (!function_exists('sunnyholidays2_comment')) :
    function sunnyholidays2_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        ?>
        <div class="comment " <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <?php echo get_avatar( $comment, 45 );?>
            <div class="meta">
                <span class="author"><?php echo get_comment_author_link() ?></span>
                <span class="separator">|</span>
                <span class="date"><?php echo get_comment_date('d M Y'); ?></span>
                <span class="separator">|</span>
                <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Ответить', 'sunnyholidays2' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                <?php edit_comment_link("Редактировать", '<span class="separator">|</span>', ''); ?>
            </div>
            <div class="comment-body">
                <?php if ('0' == $comment->comment_approved) : ?>
                    <p class="comment-awaiting-moderation">Ваш комментарий ожидает модерации</p>
                <?php endif; ?>
                <?php comment_text(); ?>

            </div>
        </div>

<?php
}
endif;
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'preserve_excerpt_format');
function preserve_excerpt_format($text,$length=null)
{
    $raw_excerpt = $text;
    if ('' == $text )
    {
        $text = get_the_content('');
        $text = strip_shortcodes($text);
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]&gt;', $text);

        $exceptions = '<p>,<a>,<em>,<strong>,<br><img>'; //PRESERVE THESE TAGS, ADD/REMOVE AS NEEDED
        $text = strip_tags($text, $exceptions);

        $maxCount = 55; //DEFAULT WP WORD COUNT, INCREASE AS NEEDED
        $excerpt_length = apply_filters('excerpt_length', $maxCount);

        $moreText = '  [...]';
        $excerpt_more = apply_filters('excerpt_more', $moreText);

        $words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length+1, PREG_SPLIT_NO_EMPTY);
        if(count($words) > $excerpt_length)
        {
            array_pop($words);
            $text = implode(' ', $words);
            $text = $text.$excerpt_more;
        }
        else
            $text = implode(' ', $words);
    }
    return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}
function new_excerpt_length() {
    return 20;
}
add_filter('excerpt_length', 'new_excerpt_length');
function get_blog_pagination(){
    global $wp_query;
    $big = 99999999;
    echo paginate_links(array(
            'base' => str_replace($big, '%#%', get_pagenum_link($big)),
            'format' => '?paged=%#%',
            'total' => $wp_query->max_num_pages,
            'current' => max(1, get_query_var('paged')),
            'show_all' => false,
            'end_size' => 2,
            'mid_size' => 3,
            'prev_next' => true,
            'prev_text' => '&lsaquo;',
            'next_text' => '&rsaquo;',
        ));
}
add_filter('widget_text', 'php_text', 99);

function php_text($text) {
 if (strpos($text, '<' . '?') !== false) {
 ob_start();
 eval('?' . '>' . $text);
 $text = ob_get_contents();
 ob_end_clean();
 }
 return $text;
}

function get_regions() {
    $file_path = TEMPLATEPATH . '/includes/regions/regions_full.csv';
    $result = array();

    if (($handle = fopen($file_path, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            //if ($data[0] != "") {
            $result[] = array('id' => $data[0].",".$data[1], 'region' => $data[3]);
            //}
        }
        fclose($handle);
    }
    //usort($result, "cmp_region");

    return $result;
}

