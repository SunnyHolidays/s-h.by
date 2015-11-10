<?php 
include('ep3gate.class.php');

 $ep3gate=new ep3gate(
        '12298',   // agent number
        'itaka',
    		'ep3'   // query string variable name (used to send paramaters to ibe) configurable to avoid conflict with existing parameters in your system
        ,'iso-8859-2'
        ,'iconv'
    );

 
	$ep3gate->setSearchType('PA');


print '<pre>';

/**
  * Używanie opcji z GATE - pobieranie danych w formacie tablicy.
  *
  * Aby pobrać dane należy wcześniej stworzyć obiekt ep3gate (można użyć
  * tego przy pomocy którego pobierana była treść strony)
  *
  * Do pobierania danych używana jest metoda: getPlainData(), która posiada
  * 2 parametry i zwraca dane z danego stepu w formacie tablicy.
  *
  * UWAGA : Nie ma ograniczeń co do ilości zapytań po "gołe" dane, ale trzeba
  *         pamiętać, że każde zapytanie do serwera powoduje opóźnienia
  *         w wyświetlaniu Państwa strony. (około 0,5 sek.)
  *         Wskazane jest, aby stworzyć cache dla pobieranych danych.
  *
  * UŻYCIE: Funkcja posiada 2 parametry:
      $deeplink - na podstawie tych danych pobierane są dane.
      Może być pusty (step1), w formie URL, lub tablicy (za komentowane
      przykłady: 1, 2 i 3)
     
      $onlyContent - nie pobieraj danych potrzebnych do stworzenia formularza
      wyszukania. DOMYŚLNIE pobiera.
     
      ZWRACANE WARTOŚCI - tablica, z kluczami:
     
      SF - aktualne kryteria wyszukania
      MI - dane ogólne (pochodzą z pierwszej wycieczki)
      V  - tablica z danymi (kraje i regiony, oferty), w pod kluczu
           SUB znajdują się regiony dla danego kraju
      PG - dane o stronicowaniu (do URL trzeba dokleić nr strony)
      JS - kod javasript, tu dane potrzebne do utworzenia listy 
           celi w formularzu
      UV - nie używane w polskiej wersji
     
  */
  

//var_export($ep3gate->getPlainData('?sp=2&a=1&sd=*3&ed=*30', true));

//var_export($ep3gate->getPlainData(Array('sp'=>3,'a'=>2,'sd'=>'*3','ed'=>'*22'), true));
//print '<a href="?ep3[]='.urlencode('?'.http_build_query(Array('sp'=>3,'a'=>2,'sd'=>'*3','ed'=>'*22'))).'">deeplink</a>'

/*
$out = $ep3gate->getPlainData('?sp=3&a=1&sd=*3&ed=*30', true);
//var_export();

foreach($out['V'] AS $row)
  print_r($row);
*/


$deeplink = '?sd=*3&ed=*30&sp=3&st=PA&ds=HRG,SSH,TCP';
$data = $ep3gate->getPlainData($deeplink, true);
print_r($data);

//print '<h3><a href="'.$data['V'][0]['url'].'&ep3[]='.urlencode('&sp=3').'">'.$data['MI']['htlCountry'].'</a></h3>';
//print '<img src="'.$data['V'][0]['hotelimage'].'" width="150"/><br /><a href="'.$data['V'][0]['url'].'">'.$data['V'][0]['htlName'].' od: '.$data['V'][0]['minprice'].'</a><br /><br />';
//print '<a href="'.$data['V'][1]['url'].'">'.$data['V'][1]['htlName'].' od: '.$data['V'][1]['minprice'].'</a><br />';
//print '<a href="'.$data['V'][2]['url'].'">'.$data['V'][2]['htlName'].' od: '.$data['V'][2]['minprice'].'</a><br />';


$out2 = $ep3gate->getPlainData('?sp=2&a=1&sd=*3&ed=*30', true);
foreach($out2['V'] AS $ctr){
  //print_r($ctr);
  if(is_array($ctr['SUB']) && count($ctr['SUB'])>0){
    print '<a href="'.$ctr['url'].'">'.$ctr['regDesc']. ' od: ';
    $price = 10000000;
    foreach($ctr['SUB'] AS $reg){
      $price = min($price, $reg['price']);
      //print '.'.$reg['price'].'.';
    }
    print $price.' PLN</a><br />';
  }
  else
    print '<a href="'.$ctr['url'].'">'.$ctr['regDesc']. '</a><br/>';
}

?>
