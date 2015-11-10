<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>IBE Autosuggest template1 EXAMPLE</title>
<?php

include('ep3gate.class.php');

$ep3gate=new ep3gate(
        '12298',   // agent number
        'itaka' // afiliate
    );

// Dodane pobieranie elementu "autosuggest" do listy pobieranych elementów.
$ep3gate->fetch(array('headercss', 'configcss', 'headerjs', 'searchform','autosuggest', 'content', 'footer'));

echo $ep3gate->getPart('headercss');
echo $ep3gate->getPart('configcss');
echo $ep3gate->getPart('headerjs');

?>

</head>
<body class="body">

<div style="margin: 10px;">
<?php

// Wyświetlanie kompletnego pola autosuggest wraz ze skryptem Javascript do obsługi zapytań kierowanych do katalogu Validate.
// echo $ep3gate->getPart('searchform');

echo $ep3gate->getPart('content');

?>
</div>

<?php

// Linia poniżej zamiast metody $ep3gate->printContents() 
echo $ep3gate->getPart('content');

?>
<?php 

//print $ep3gate->getPart('footer'); 

//potrzebne jeżęli jest używane pobieranie lastów
$footer = $ep3gate->getPart('footer');
?>
</body>
</html>
