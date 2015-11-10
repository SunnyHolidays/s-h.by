<?php
include_once('include/MenuWidget.php');
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
            'name' => __( 'Сайдбар формы заказа', 'sunnyholidays2' ),
            'id' => 'sidebar-3',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ) );
    register_sidebar( array(
            'name' => __( 'Сайдбар поиска туров', 'sunnyholidays2' ),
            'id' => 'search-tours',
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
add_action( 'widgets_init', create_function( '', 'register_widget( "MenuWidget" );' ) );

function kama_excerpt($args=''){
    global $post;
    parse_str($args, $i);
    $maxchar 	 = isset($i['maxchar']) ?  (int)trim($i['maxchar'])		: 550;
    $text 		 = isset($i['text']) ? 			trim($i['text'])		: '';
    $save_format = isset($i['save_format']) ?	trim($i['save_format'])			: "<p>,<em>,<strong>,<b>,<ul>,<li>";
    $echo		 = isset($i['echo']) ? 			false		 			: true;

    if (!$text){
        $out = $post->post_excerpt ? $post->post_excerpt : $post->post_content;
        $out = preg_replace ("!\[/?.*\]!U", '', $out ); //убираем шоткоды, например:[singlepic id=3]
        // для тега <!--more-->
        if( !$post->post_excerpt && strpos($post->post_content, '<!--more-->') ){
            preg_match ('/(.*)<!--more-->/s', $out, $match);
            $out = str_replace("\r", '', trim($match[1], "\n"));
            $out = preg_replace( "!\n\n+!s", "</p><p>", $out );
            $out = "<p>". str_replace ( "\n", "<br>", trim($out) ) ."</p>";
            $out = "<p>". str_replace ( "</li><br>", "</li>", trim($out) ) ."</p>";
            if ($echo)
                return print $out;
            return $out;
        }
    }

    $out = $text.$out;
    if (!$post->post_excerpt)
        $out = strip_tags($out, $save_format);

    if ( iconv_strlen($out, 'utf-8') > $maxchar ){
        $out = iconv_substr( $out, 0, $maxchar, 'utf-8' );
        $out = preg_replace('@(.*)\s[^\s]*$@s', '\\1 ...', $out); //убираем последнее слово, ибо оно в 99% случаев неполное
    }

    if($save_format){
        $out = str_replace( "\r", '', $out );
        $out = preg_replace( "!\n\n+!", "</p><p>", $out );
        $out = "<p>". str_replace ( "\n", "<br>", trim($out) ) ."</p>";
        $out = "<p>". str_replace ( "</li><br>", "</li>", trim($out) ) ."</p>";
    }
    $out=close_tags($out);
    if($echo) return print $out;
    return $out;
}
/**
 * @desc Close all opened tags.
 * @param string $content
 * @return string content
 */
function close_tags($content)
{
    $position = 0;
    $open_tags = array();
    //теги для игнорирования
    $ignored_tags = array('br', 'hr', 'img');

    while (($position = strpos($content, '<', $position)) !== FALSE)
    {
        //забираем все теги из контента
        if (preg_match("|^<(/?)([a-z\d]+)\b[^>]*>|i", substr($content, $position), $match))
        {
            $tag = strtolower($match[2]);
            //игнорируем все одиночные теги
            if (in_array($tag, $ignored_tags) == FALSE)
            {
                //тег открыт
                if (isset($match[1]) AND $match[1] == '')
                {
                    if (isset($open_tags[$tag]))
                        $open_tags[$tag]++;
                    else
                        $open_tags[$tag] = 1;
                }
                //тег закрыт
                if (isset($match[1]) AND $match[1] == '/')
                {
                    if (isset($open_tags[$tag]))
                        $open_tags[$tag]--;
                }
            }
            $position += strlen($match[0]);
        }
        else
            $position++;
    }
    //закрываем все теги
    foreach ($open_tags as $tag => $count_not_closed)
    {
        $content .= str_repeat("</{$tag}>", $count_not_closed);
    }

    return $content;
}