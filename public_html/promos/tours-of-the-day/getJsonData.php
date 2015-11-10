<?php
header('Content-Type: application/json');
$params = http_build_query($_GET);
$preloaded = file_get_contents('http://www.itaka.pl/ru/strony/4466.php?'.$params);
echo $preloaded;