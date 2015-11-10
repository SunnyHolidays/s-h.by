<?php
/**
 * @package Tourist_Search
 * @version 1.0
 */
/*
Plugin Name: Tourist Search
Plugin URI: http://docu.mdsws.merlinx.pl
Description: Plugin for search of recreation using API
Author: Flip
Version: 1.0 
*/

class tourist_search {
	
	//start date
	public $trp_depDateStart = "";
	
	//end date
	public $trp_depDateEnd = "";
	
	//number of adults
	public $par_adt = "";
	
	//single row
	public $row = array();
	
	public function post_xml($url, $xml){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST,   1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
	
		$response = curl_exec($ch);
		curl_close($ch);
		return $response;
	}
	
	public function make_request() {
		$xml = new XMLWriter();
		$xml->openMemory();
		$xml->startDocument('1.0', 'UTF-8');
		
			$xml->startElement('mds');
				$xml->startElement('auth');
					$xml->writeElement('login', 'login');
					$xml->writeElement('pass', '123');
				$xml->endElement();
		
				$xml->startElement('request');
					$xml->writeElement('type', 'offers');
					$xml->startElement('conditions');
					
						if ($this->par_adt != "") {
							$xml->writeElement('par_adt', $this->par_adt);
						}
						
						if (($this->trp_depDateStart != "") && ($this->trp_depDateEnd == "")) {
							$xml->writeElement('trp_depDate', $this->trp_depDateStart);
						} elseif (($this->trp_depDateStart != "") && ($this->trp_depDateEnd != "")) {
							$xml->writeElement('trp_depDate', $this->trp_depDateStart . ":" . $this->trp_depDateEnd);
						}
						
					$xml->endElement();
				$xml->endElement();
			$xml->endElement();
			
		$xml->endDocument();
		
		return $xml->outputMemory(true);		
	}
	
	public function parsing_response($xml_response_string){
		if(!$xml_response_string) {
			die('ERROR');
		}
		
		$search_result = get_object_vars(simplexml_load_string($xml_response_string));
		$result = array();
		
		for ($i = 0; $i < $search_result['count']; $i++) {
			$this->convert_result($search_result['ofr'][$i]);
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
					$this->row[$k] = $v;
				}
			}
		} else if (is_object($data)) {
			$this->convert_result(get_object_vars($data));
		}
	}
	
};

function tsearch() {
	$tourist_search = new tourist_search();
	
	$tourist_search->par_adt = registry()->request()->getParam('par_adt', "");
	$tourist_search->trp_depDateStart = registry()->request()->getParam('trp_depDateStart', "");
	$tourist_search->trp_depDateEnd = registry()->request()->getParam('trp_depDateEnd', "");
	
	$xml = $tourist_search->make_request();
	
	$response = $tourist_search->post_xml('http://merlinx.pl.test', $xml);
	$result = $tourist_search->parsing_response($response);
	
	return $result;
}

//add_action( 'get_search_form', 'tsearch' );


// tmp functions

function print_result($data) {
	
	if (is_array($data)) {
		foreach ($data as $k => $v) {
			if (is_array($v)) {
				print_result($v);
			} elseif (is_object($v)) {
				print_result(get_object_vars($v));
			} else {
				echo $k . ": " . $v . "<br/>";
			}
		}
	} else if (is_object($data)) {
		print_result(get_object_vars($data));
	}
	
}

function result_to_array($data) {

	$array_iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($data));
	foreach($array_iterator as $key=>$value)
			echo $key.' — '.$value."\n";
}

?>
