<?php

/**
 * @version 1.0
 */

/*
Class Name: search_api
Description: base class for offers search
*/

class search_api {
	
	const url_for_tophotels = 'http://www.tophotels.ru/';
	
	//mapping keys of response to keys of output template
	protected $mapped_keys = array();
	
	//parameters for output search template
	protected $output_template_parameters = array(
												'id', 
												'name', //name of offer
												'tour_operator', //tour operator
												'start_date', //start date of tour
												'price', //float price
												'country',
												'city',
												'duration'
														);
	
	//region
	public $destination = "";
	
	//start date
	public $date_start = "";
	
	//end date
	public $date_end = "";
	
	//number of adults
	public $adt = "";

    public $departureCity = "";
	
	public function post_request($url, $request, $is_post = true, $header = false) {

        //var_dump($url); echo "<br/><br/>";
        //var_dump($request); echo "<br/><br/>";

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
		
		if ($header) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		}

		if ($is_post) {
			curl_setopt($ch, CURLOPT_POST,   1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
			curl_setopt($ch, CURLOPT_URL, $url);
		} else {
			curl_setopt($ch, CURLOPT_URL, $url . $request);
		}

		$response = curl_exec($ch);

        $curl_info = curl_getinfo($ch);
        echo "<b>Request Time: ".$curl_info['total_time']."</b><br/><br/>";

		curl_close($ch);

		return $response;
	}
	
	public function make_search_request() {
		return '';
	}
	
	public function parsing_search_response($response){
		if(!$response) {
			die('ERROR');
		}
		return $response;
	}
	
	public function get_search_result($url) {
		return $this->parsing_search_response($this->post_request($url, $this->make_search_request()));
	}
	
	public function check_mapped_keys($key) {
		if (isset($this->mapped_keys[$key])) {
			return $this->mapped_keys[$key];
		} else {
			return $key;
		}
	}
	
	public function get_tophotels_rating($title, $country, $by_post = false) {
		
		if (!$title) return '';
	
		$post = get_page_by_title( $title, OBJECT, 'post' );
		if ($post) {
			$rating = get_post_custom_values('tophotels_rating', $post->ID);
		}
		if ((count($rating) > 0) && is_numeric($rating[0])) return $rating[0];
		if ($by_post) return '';
		
		$allocation = '';
		
		$title = strip_tags($title,"");
		$title = preg_replace('/[^A-Za-z0-9\s.\s-]/','',$title);
		$title = str_replace( array( '-', '.' ), '', $title);
		$title = str_replace( array( '  '), ' ', $title);
		
		$title = explode(' ', $title);
		if (count($title) > 1) {
			$title = $title[0] . ' ' . $title[1];
		} else {
			$title = $title[0];
		}
		
		$result = $this->post_request(self::url_for_tophotels . 'action.php?', http_build_query(array('q' => $title, 'limit' => 200, 'timestamp' => time(), 'co' => 0, 'action' => 'hotel_search')), false);
		
		$result = preg_split("/(\r\n|\n|\r)/", $result);
		
		foreach ($result as $res) {
			$line = explode('|', $res);
			$get_country = iconv("windows-1251", "UTF-8//IGNORE", $line[3]);
			if (strtolower($country) == strtolower($get_country)) {
				if ($allocation == '') {
					$allocation = $line[4];
				} else {
					$allocation = '';
					break;
				}
			}
		}
		
		if ($allocation == '') return '';
		
		$params = array('allocation' => $allocation, 'lang' => 'ru', 'page_lang' => 'ru', 'type' => 12, 'mode' => 17);
		$header = array('Content-Type: application/x-www-form-urlencoded; charset=UTF-8');
		$result = $this->post_request(self::url_for_tophotels . 'action.php?action=informer_code', http_build_query($params), true, $header);
		$hash_code = $this->found_string("tophotels.inform.init('", "'", $result);
		
		$result = $this->post_request(self::url_for_tophotels . "informer/out/" . $hash_code, '', false);
		$rating = $this->found_string('<a class=\"th_informer_info-td3-a-green\" href=\"http:\/\/tophotels.ru\/main\/hotel\/al'.$allocation.'\" target=\"_blank\">\n', '\n<\/a>\n<\/td>', $result);
		
		return is_numeric($rating) ? $rating : '';
	}
	
	public function found_string($b_marker, $e_marker, $str) {
		$begin_marker = strpos($str, $b_marker) + strlen($b_marker);
		$end_marker = strpos($str, $e_marker, $begin_marker);
		return substr($str, $begin_marker, $end_marker - $begin_marker );
	}
	
};

?>
