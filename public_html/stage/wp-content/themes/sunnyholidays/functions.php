<?php

	$functions_path = TEMPLATEPATH . '/functions/';
	$includes_path = TEMPLATEPATH . '/includes/';
	
	//Loading jQuery and Scripts
	require_once $includes_path . 'theme-scripts.php';
	
	//Widget and Sidebar
	require_once $includes_path . 'sidebar-init.php';
	require_once $includes_path . 'register-widgets.php';
	
	//Theme initialization
	require_once $includes_path . 'theme-init.php';
	
	//Additional function
	require_once $includes_path . 'theme-function.php';
	
	//Additional search by API
	require_once $includes_path . '/api_class/merlinx_pl_api.php';
	require_once $includes_path . '/api_class/bronni_ru_api.php';
	
	//Shortcodes
	require_once $includes_path . 'theme_shortcodes/shortcodes.php';
	include_once(TEMPLATEPATH . '/includes/theme_shortcodes/alert.php');
	include_once(TEMPLATEPATH . '/includes/theme_shortcodes/tabs.php');
	include_once(TEMPLATEPATH . '/includes/theme_shortcodes/toggle.php');
	include_once(TEMPLATEPATH . '/includes/theme_shortcodes/html.php');
	
	//tinyMCE includes
	include_once(TEMPLATEPATH . '/includes/theme_shortcodes/tinymce/tinymce_shortcodes.php');
	
	
	// removes detailed login error information for security
	add_filter('login_errors',create_function('$a', "return null;"));
	
	if ( !function_exists( 'optionsframework_init' ) ) {
	
	
	/*-----------------------------------------------------------------------------------*/
	/* Options Framework Theme
	/*-----------------------------------------------------------------------------------*/
	
	/* Set the file path based on whether the Options Framework Theme is a parent theme or child theme */
	
	if ( STYLESHEETPATH == TEMPLATEPATH ) {
		define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/admin/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('template_directory') . '/admin/');
	} else {
		define('OPTIONS_FRAMEWORK_URL', STYLESHEETPATH . '/admin/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('stylesheet_directory') . '/admin/');
	}
	
	require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');
	
	}
		
	// Removes Trackbacks from the comment cout
	add_filter('get_comments_number', 'comment_count', 0);
	function comment_count( $count ) {
		if ( ! is_admin() ) {
			global $id;
			$comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
			return count($comments_by_type['comment']);
		} else {
			return $count;
		}
	}
  
	
	// enable shortcodes in sidebar
	add_filter('widget_text', 'do_shortcode');
	
	// custom excerpt ellipses for 2.9+
	function custom_excerpt_more($more) {
		return 'Read More &raquo;';
	}
	add_filter('excerpt_more', 'custom_excerpt_more');
	// no more jumping for read more link
	function no_more_jumping($post) {
		return '&nbsp;<a href="'.get_permalink($post->ID).'" class="read-more">'.'Continue Reading'.'</a>';
	}
	add_filter('excerpt_more', 'no_more_jumping');
	
	
	// category id in body and post class
	function category_id_class($classes) {
		global $post;
		foreach((get_the_category($post->ID)) as $category)
			$classes [] = 'cat-' . $category->cat_ID . '-id';
			return $classes;
	}
	
	add_filter('post_class', 'category_id_class');
	add_filter('body_class', 'category_id_class');
	
	
	
	// functions for search of offers by APIs
	function tsearch() {

		$merlinx_search = new merlinx_pl_api();
		$bronni_search = new bronni_ru_api();

		$country_ids = explode(",", registry()->request()->getParam('destination', ""));
		$merlinx_search->destination = $country_ids[0];
		$bronni_search->destination = $country_ids[1];

		$merlinx_search->adt = $bronni_search->adt = registry()->request()->getParam('adt', "");
		$merlinx_search->date_start = $bronni_search->date_start = registry()->request()->getParam('date_start', "");
		$merlinx_search->date_end = $bronni_search->date_end = registry()->request()->getParam('date_end', "");

		$result = array_merge($merlinx_search->get_search_result(), $bronni_search->get_search_result());
		usort($result, 'cmp_price');

		return $result;
	}

	//return details for api offer
	function get_offer_details($api_type, $offer_id) {
		
		if (($api_type == "") || ($offer_id == ""))
			return array();

		switch ($api_type) {
			case 'merlinx':
				$search_api = new merlinx_pl_api();
			break;
			case 'bronni':
				$search_api = new bronni_ru_api();
			break;	
		}
		
		$odetail = $search_api->get_offer_detail($offer_id);
		
		foreach ($odetail['content'] as $hotel) {
		
			$post_exist = get_page_by_title( $hotel['title'], OBJECT, 'post' );
			 
			if (!$post_exist) {
				
				$content = $hotel['content'].'Images:<br/>';
					
				foreach ($hotel['images'] as $image) {
					$content .= $image. '<br/>';
				}
				
				$new_post = array(
						'post_title' => $hotel['title'],
						'post_content' => $content,
						'post_status' => 'draft',
						'post_date' => date('Y-m-d H:i:s'),
						'post_author' => 'system',
						'post_type' => 'post',
						'post_category' => array()
				);
				
				$post_id = wp_insert_post($new_post);
				add_post_meta($post_id, 'tophotels_rating', $hotel['tophotels_rating'], true);
			} elseif ($post_exist->post_status == 'publish') {
				return array('content' => $post_exist, 'is_post' => true);
			}
		}
		
		return array('content' => $odetail['content'], 'is_post' => false, 'airports' => $odetail['airports']);
	}
	
	//functions for get and sort regions
	function cmp_region($a, $b)
	{
		return strcmp($a["region"], $b["region"]);
	}
	
	function cmp_price($a, $b)
	{
		if (floatval($a["price"]) == floatval($b["price"])) {
        return 0;
	    }
	    return (floatval($a["price"]) < floatval($b["price"])) ? -1 : 1;
	}

	function cmp_rating($a, $b)
	{
		if (floatval($a["rating"]) == floatval($b["rating"])) {
			return 0;
		}
		return (floatval($a["rating"]) < floatval($b["rating"])) ? -1 : 1;
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

function bronni_search() {

    //$sApi = new search_api();
    //$result = $sApi->post_request('http://remote.bronni.ru/Security.ashx/login?name=sunnyholidays.by&password=sunnyholidays.by', '', false);

    //var_dump(get_object_vars(json_decode('{"id":-1,"result":"Пользователь:Гоманчук Елена Петровна, Права на модуль поиска:Есть"}'))); exit();



    $bronni_search = new bronni_ru_api();

    $bronni_search->destination = 3;
    $bronni_search->adt = 2;
    $bronni_search->date_start = "2013-02-05";
    $bronni_search->date_end = "2013-02-10";
    $bronni_search->departureCity = 1;

    $result = $bronni_search->get_search_result();
    //usort($result, 'cmp_price');

    return $result;
}

?>