<?php

require_once 'search_api.php';

/**
 * @version 1.0
 */

/*
Class Name: merlinx_pl_api
API doc URL: http://docu.mdsws.merlinx.pl
API URL: http://mdsws.merlinx.pl/{version}/
request/responce type: xml
*/

class merlinx_pl_api extends search_api {
	
	//api url
	const api_url = 'http://merlinx.pl.test/?apitype=merlinx'; #'http://mdsws.merlinx.pl/2.3/';
	
	const url_for_hotel = 'http://merlinx.pl.test/?apitype=merlinx&'; #'http://data2.merlinx.pl/index.php?'
	
	//mapping keys of response to keys of output template
	protected $mapped_keys = array(
			'durationM' => 'duration',
			'startDate' => 'start_date',
			'tourOp' => 'tour_operator'
	);
	
	protected $login = 'login';
	protected $password = '123';
	
	//api identifier
	private $api_id = 'merlinx';
	
	//single row
	private $row = array();
	
	public function make_search_request() {
		$xml = new XMLWriter();
		$xml->openMemory();
		$xml->startDocument('1.0', 'UTF-8');
		
			$xml->startElement('mds');
				$xml->startElement('auth');
					$xml->writeElement('login', $this->login);
					$xml->writeElement('pass', $this->password);
				$xml->endElement();
		
				$xml->startElement('request');
					$xml->writeElement('type', 'offers');
					$xml->startElement('conditions');
					
						if ($this->destination != "") {
							$xml->writeElement('trp_destination', $this->destination);
						}
						
						if ($this->adt != "") {
							$xml->writeElement('par_adt', $this->adt);
						}
						
						if (($this->date_start != "") && ($this->date_end == "")) {
							$xml->writeElement('trp_depDate', $this->date_start);
						} elseif (($this->date_start != "") && ($this->date_end != "")) {
							$xml->writeElement('trp_depDate', $this->date_start . ":" . $this->date_end);
						}
						
					$xml->endElement();
				$xml->endElement();
			$xml->endElement();
			
		$xml->endDocument();
		
		return $xml->outputMemory(true);		
	}
	
	public function get_search_result() {
		return parent::get_search_result(self::api_url);
	}
	
	public function parsing_search_response($xml_response_string) {
		if(!$xml_response_string) {
			die('ERROR');
		}
		
		$search_result = get_object_vars(simplexml_load_string($xml_response_string));
		$result = array();
		$count = (isset($search_result['count']) && $search_result['count'] > 0) ? $search_result['count'] : count($search_result);
		
		for ($i = 0; $i < $count; $i++) {
			$this->convert_result($search_result['ofr'][$i]);
			$this->row['api_id'] = $this->api_id;
			$this->row['rating'] = $this->get_tophotels_rating($this->row['name'], $this->row['country'], true);
			$result[$i] = $this->row;
			$this->row = array();
		}
		
		return $result;
	}
	
	public function convert_result($data) {
		if (is_array($data)) {
			foreach ($data as $k => $v) {
				if (is_array($v)) {
					$this->convert_result($v);
				} elseif (is_object($v)) {
					$this->convert_result(get_object_vars($v));
				} else {
					$key = $this->check_mapped_keys($k);
					$this->row[$key] = $this->convert_mapped_value($key, $v);
				}
			}
		} else if (is_object($data)) {
			$this->convert_result(get_object_vars($data));
		}
	}
	
	public function convert_mapped_value($key, $val) {
		switch ($key) {
			case 'start_date':
				return substr($val, 0, 4) . '-' . substr($val, 4, 2) . '-' . substr($val, 6);
			case 'price':
				return $val.".00";
			default:
				return $val;
		}
	}
	
	public function get_offer_detail($offer_id) {
		
		if (!$offer_id) return array();
		
		$xml = new XMLWriter();
		$xml->openMemory();
		$xml->startDocument('1.0', 'UTF-8');
			$xml->startElement('mds');
				$xml->startElement('auth');
					$xml->writeElement('login', $this->login);
					$xml->writeElement('pass', $this->password);
				$xml->endElement();
			
				$xml->startElement('request');
					$xml->writeElement('type', 'details');
					$xml->startElement('conditions');
						$xml->writeElement('ofr_id', $offer_id);
					$xml->endElement();
				$xml->endElement();
			$xml->endElement();
		$xml->endDocument();
		
		$request = $xml->outputMemory(true);
		
		$api_url_tmp = 'http://merlinx.pl.test/?apitype=merlinx&ofr_id='.$offer_id;  // tmp, only for local version
		$offer_details = $this->parsing_search_response($this->post_request($api_url_tmp, $request));
		
		foreach ($offer_details as $k => $offer) {
			$hotel_desc = $this->post_request(self::url_for_hotel, http_build_query(array('htlCode' => $offer['code'], 'tourOp' => $offer['tour_operator'], 'login' => '', 'password' => '')), false);
			$hotel_desc = iconv("windows-1250", "UTF-8//IGNORE", $hotel_desc);
			$hotel_desc = get_object_vars(simplexml_load_string($hotel_desc));
			
			$template_result = array();
			if (is_array($hotel_desc['hotelData'])) {
				for ($i = 0; $i < count($hotel_desc['hotelData']); $i++) {
					$template_result[] = $this->get_hotel_detail(get_object_vars($hotel_desc['hotelData'][$i]));
				}
			} else {
				$template_result[] = $this->get_hotel_detail(get_object_vars($hotel_desc['hotelData']));
			}
		}
		
		
		return array('content' => $template_result, 'airports' => $this->get_airports($offer_id));
	}
	
	public function get_hotel_detail($hotel) {
		
		$images = get_object_vars($hotel['images']->pictures);
		$texts =  get_object_vars($hotel['texts']);
		$content = '';
		
		foreach ($texts['text'] as $text_obj) {
			$t = get_object_vars($text_obj);
			$content .= $t['subject'].":"."<br/>". nl2br($t['content']) . "<br/><br/>";
			if ($t['subject'] == 'Region') {
				$region = explode(',', $t['content']);
			}
		}
		
		$title = $hotel['hotel'];
		if (strtoupper(substr($title, 0, 5)) == "HOTEL") {
			$title = substr($title, 7);
		}
		
		return array(
				'images' => $images['picture'],
				'title' => $title,
				'content' => $content,
				'tophotels_rating' => $this->get_tophotels_rating($title, $region[0])
				);
	}
	
	public function get_airports($offer_id) {
		$xml = new XMLWriter();
		$xml->openMemory();
		$xml->startDocument('1.0', 'UTF-8');
			$xml->startElement('mds');
				$xml->startElement('auth');
					$xml->writeElement('login', $this->login);
					$xml->writeElement('pass', $this->password);
				$xml->endElement();
				
				$xml->startElement('request');
					$xml->writeElement('type', 'filters');
					$xml->startElement('conditions');
					
				/* #need testing on real api
  						$xml->writeElement('par_adt', $adt);
						$xml->writeElement('ofr_tourOp', $tour_op);
						$xml->writeElement('trp_depDate', $dep_date); */
					
						$xml->writeElement('ofr_id', $offer_id);
						
						$xml->writeElement('filters', 'trp_depDate,trp_depDesc,trp_depCode,trp_duration');
					$xml->endElement();
				$xml->endElement();
			$xml->endElement();
		$xml->endDocument();
		
		$request = $xml->outputMemory(true);
		
		$api_url_tmp = 'http://merlinx.pl.test/?apitype=merlinx&filters=1'; // tmp, only for local version
		
		$air_details = get_object_vars(simplexml_load_string($this->post_request($api_url_tmp, $request)));
		
		$result = array();
		$arr_result = array();
		foreach ($air_details['fdef'] as $fdef) {
			$item = get_object_vars($fdef);
			
			$values = array();
			foreach ($item['f'] as $value) {
				$arr_value = get_object_vars($value);
				$arr_result[$item['@attributes']['id']][] = $arr_value['@attributes']['id'];
			}
		}
		
		foreach ($arr_result as $k => $air) {
			if ($k == 'trp_depDesc') {
				foreach ($air as $a_name) {
					$result[] = $a_name;
				}
			}
		}

		return $result;
	}
		
};


?>
