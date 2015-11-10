<?php

require_once 'search_api.php';

/**
 * @version 1.0
 */

/*
Class Name: bronni_ru_api
API doc URL: http://bronni.ru/Home/API
API URL: http://remote.bronni.ru/{type}/
request/responce type: json
*/

class bronni_ru_api extends search_api {
	
	// api url
	const api_url = 'http://remote.bronni.ru/'; #'http://merlinx.pl.test/';
	
	const url_for_search = 'price.ashx/searchFirstPage?'; #'?apitype=bronni&';
	
	const url_for_details = 'price.ashx/getObject?'; #'?apitype=bronni&';
	
	const url_for_hotel = 'hotel.ashx/getHotelDescription?'; #'?apitype=bronni&f=getHotelDescription&';
	
	const url_for_image = 'Handlers/HotelImageHandler.ashx?';
	
	const image_width = 800;
	
	const image_height = 600;
	
	//mapping keys of response to keys of output template
	protected $mapped_keys = array();
	
	//api identifier
	private $api_id = 'bronni';

    public function api_login() {
        if ($this->is_api_login()) {
            $security = $_SESSION['identity'];
        } else {
            $result = $this->post_request('http://remote.bronni.ru/Security.ashx/login?name=sunnyholidays.by&password=sunnyholidays.by&enc=65001', '', false);
            $result = json_decode($result, true);
            $security = $result['result'];
            $_SESSION['identity'] = $security;
        }
        return $security;
    }

    public function is_api_login() {
        if (isset($_SESSION['identity']) && ($_SESSION['identity'] != '')) {
            $result = $this->post_request('http://remote.bronni.ru/Security.ashx/isLogin?security=' . $_SESSION['identity'] . '&enc=65001', '', false);
            $result = json_decode($result, true);

            if (!isset($result['error']) &&  $result['result'] != '') {
                return true;
            }
        }
        return false;
    }
	
	public function make_search_request() {
		
		$searchFilter = array();
		$searchFilter["cities"] = array();

		if ($this->date_start != '') {
			$searchFilter["checkinDateFrom"] = $this->date_start;
		}
		if ($this->date_end != '') {
			$searchFilter["checkinDateTo"] = $this->date_end;
		}
		if ($this->adt != '') {
			$searchFilter["adultsCount"] = $this->adt;
		}
		if ($this->destination != '') {
			$searchFilter["country"] = $this->destination;
		}
        if ($this->departureCity != '') {
            $searchFilter["departureCity"] = $this->departureCity;
        }

		return http_build_query(array('searchFilter' => json_encode($searchFilter), 'pricePerPage' => 10, 'security' => $this->api_login(), 'enc' => 65001));
	}
	
	public function get_search_result() {
		return $this->parsing_search_response($this->post_request(self::api_url . self::url_for_search, $this->make_search_request(), false));
	}
	
	public function parsing_search_response($json_response){
		if(!$json_response) {
			die('ERROR');
		}

		$search_result = json_decode($json_response, true);

		$result = array();
		if ($search_result) {
            foreach ($search_result['result']['prices'] as $search_row) {
                $result[] = $this->convert_search_result($search_row);
            }
        }
		
		return $result;
	}
	
	public function convert_search_result($data) {
		return array(
				'id' => $data['id'], 
				'name' => ($data['hotel']['russianName'] != "") ? $data['hotel']['russianName'] : $data['hotel']['englishName'],
				'tour_operator' => ($data['operator']['russianName'] != "") ? $data['operator']['russianName'] : $data['operator']['englishName'],
				'start_date' => $data['checkinDate'],
				'price' => str_replace(",", ".", $data['operatorPrice']),
				'country' => ($data['country']['russianName'] != "") ? $data['country']['russianName'] : $data['country']['englishName'],
				'city' => ($data['city']['russianName'] != "") ? $data['city']['russianName'] : $data['city']['englishName'],
				'duration' => $data['duration'],
				'api_id' => $this->api_id,
				'rating' => '' //$this->get_tophotels_rating($data['hotel']['englishName'], $data['country']['russianName'], true)
				);
	}
	
	public function get_offer_detail($offer_id) {
		
		if (!$offer_id) return array();
		
		$result = $this->post_request(self::api_url . self::url_for_details, http_build_query(array('id' => $offer_id)), false);
		$offer_details = json_decode($result, true);

		$template_result = array();
		
		foreach ($offer_details['hotels'] as $k => $hotel) {
			$hotel_desc = json_decode($this->post_request(self::api_url . self::url_for_hotel, http_build_query(array('id' => $hotel['hotel']['id'])), false), true);
			foreach ($hotel_desc['images'] as $i => $image) {
				$hotel_desc['images'][$i] = $this->get_image($image['guid'], self::image_width, self::image_height);
			}
			
			$offer_details['hotels'][$k]['description'] = $hotel_desc;
			
			$template_result[$k] = array(
						'images' => $hotel_desc['images'],
						'title' => $hotel['hotel']['russianName'],
						'content' => nl2br($hotel_desc['hotelDescription']) . '</br><br/>'. nl2br($hotel_desc['beachDescription']) . '</br><br/>',
						'tophotels_rating' => $this->get_tophotels_rating($hotel['hotel']['englishName'], $hotel['country']['russianName']),
						'bronni_rating' => $hotel['hotel']['rate'],
						'starts' => $hotel['star']['russianName']
					);
		}
		
		return array('content' => $template_result, 'airports' => $this->get_airports($offer_details));
	}
	
	public function get_image($guid, $w, $h) {
		return self::api_url . self::url_for_image . "ImageGuid=".$guid."&MaximumSize=".$w.",".$h;
	}
	
	public function get_airports($offer_details) {
		$result = array();

		foreach ($offer_details['flights'] as $air) {
			$result[] = $air['departureCity']['russianName'];
		}
		
		return $result;
	}
	
};


?>
