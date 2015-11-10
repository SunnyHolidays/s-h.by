<?php
/**
 * Template Name: Send Mail
 */

$hasError = false;
if(!isset($_POST['country']) || count($_POST['country']) == 0) {
    $hasError = true;
} else {
    $country = $_POST['country'];
}
if(trim($_POST['period_from']) == '') {
    $hasError = true;
} else {
    $period_from = trim($_POST['period_from']);
}
if(trim($_POST['period_to']) == '') {
    $hasError = true;
} else {
    $period_to = trim($_POST['period_to']);
}
if(trim($_POST['duration']) == '') {
    $hasError = true;
} else {
    $duration = trim($_POST['duration']);
}
if(!isset($_POST['departure']) || count($_POST['departure']) == 0) {
    $hasError = true;
} else {
    $departure = $_POST['departure'];
}
if(trim($_POST['people']) == '') {
    $hasError = true;
} else {
    $people = trim($_POST['people']);
}
if(isset($_POST['children_number'])) {
    $children_number = trim($_POST['children_number']);
}
$children_birthday = array();
if(isset($_POST['children_birthday'])) {
    $children_birthday = $_POST['children_birthday'];
}
if(trim($_POST['money_amount']) == '') {
    $hasError = true;
} else {
    $money_amount = trim($_POST['money_amount']);
}
if(trim($_POST['category']) == '') {
    $hasError = true;
} else {
    $category = trim($_POST['category']);
}
$food = '';
if(trim($_POST['food']) != '') {
    $food = trim($_POST['food']);
}
$checkbox = array();
if(isset($_POST['checkbox'])) {
    $checkbox = $_POST['checkbox'];
}
if(trim($_POST['last_name']) == '') {
    $hasError = true;
} else {
    $name = trim($_POST['last_name']);
}
if(trim($_POST['mail']) == '') {
    $hasError = true;
} else {
    $mail = trim($_POST['mail']);
}
if(trim($_POST['phone']) == '') {
    $hasError = true;
} else {
    $phone = trim($_POST['phone']);
}
if(isset($_POST['subscribe'])) {
    $subscribe = 'Включить';
} else {
	$subscribe = 'Не включать';
}
if(isset($_POST['comment'])) {
	$comment = $_POST['comment'];
} else {
	$comment = '';
}

$checkboxes = array(
		'check1' => '1-я береговая линия', 
		'check2' => 'Для семей с детьми', 
		'check3' => 'Центр населенного пункта', 
		'check4' => 'Wifi internet', 
		'check5' => 'Корты', 
		'check6' => 'Сауна',
		'check7' => 'Ночная жизнь',
		'check8' => 'Анимация для взрослых',
		'check9' => 'Водные горки',
		'check10' => 'Анимация для детей',
		);

//Если ошибок нет, отправить email
if(!$hasError) {
		$emailTo = "sergey@sunnyholidays.by"; //Сюда введите Ваш email
        $subject="Заказ тура на sunnyholidays!"; // Тема письма
        $body = "Страны:
	";
	 foreach($country as $value){
		$body .= $value."
	";
	}
	$body .= "
Период:
	c: $period_from
	по: $period_to
Продолжительность: $duration
Вылет из:
	";
	foreach($departure as $value){
		$body .= $value."
	";
	}
	$body.="
Взрослых: $people
Детей: $children_number
Возраст детей:
	";
    foreach($children_birthday as $value){
       $body .= $value."
	";
    }
    $body.="
Бюджет: $money_amount
Категория: $category
Питания: $food
Условия:
    ";
    foreach($checkbox as $value){
        $body .= $checkboxes[$value]."
	";
    }
    $body.="
Имя: $name
Почта: $mail
Телефон: $phone
Подписка: $subscribe
Комментарий: $comment";
    
	$headers = 'From: Form <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $mail."\r\n"."Content-type: text/html; charset=utf-8";
    $mail_result = mail($emailTo, $subject, $body, $headers);
    
    $headers = 'From: Form <sunnyholidays.by>' . "\r\n" . "Content-type: text/html; charset=utf-8";
    $subject = 'Заказ на sunnyholidays.by';
    
    $mail_post = get_page_by_title('Mail for Client', OBJECT, 'post' );
    $body = $mail_post->post_content;
    
    $mail_result = mail($mail, $subject, $body, $headers);
    
    echo "ok";
} else {
    echo "error";
}

?>