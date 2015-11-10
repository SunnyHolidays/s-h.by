<?php

if(trim($_POST['country']) == '') {
    $hasError = true;
} else {
    $country = trim($_POST['country']);
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
if(trim($_POST['departure']) == '') {
    $hasError = true;
} else {
    $departure = trim($_POST['departure']);
}
if(trim($_POST['people']) == '') {
    $hasError = true;
} else {
    $people = trim($_POST['people']);
}
if(isset($_POST['children_number'])) {
    $children_number = trim($_POST['children_number']);
}
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
if(trim($_POST['food']) == '') {
    $hasError = true;
} else {
    $food = trim($_POST['food']);
}
if(!isset($_POST['checkbox'])) {
    $hasError = true;
} else {
    $checkbox = $_POST['checkbox'];
}
if(trim($_POST['name']) == '') {
    $hasError = true;
} else {
    $name = trim($_POST['name']);
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
    $subscribe = trim($_POST['subscribe']);
}


//Если ошибок нет, отправить email
if(!isset($hasError)) {
    $emailTo = ""; //Сюда введите Ваш email
        $subject=""; // Тема письма
        $body = "
                         Страна: $country\n\n
                         Период:\n
                                c: $period_from\n
                                по: $period_to\n\n
                         Продолжительность:   $duration\n\n
                         Вылет из:   $departure\n\n
                         Взрослых:   $people\n\n
                         Детей:   $children_number\n\n
                         Даты рождения детей:\n";
    foreach($children_birthday as $value){
       $body.="$value\n";
    }

    $body.="

                         \nБюджет:   $money_amount\n\n
                         Категория:   $category\n\n
                         Питания:   $food\n\n
                         Условия:   \n";
    foreach($checkbox as $value){
        $body.="$value\n";
    }

    $body.="             \nИмя:   $name\n\n
                         Почта:   $mail\n\n
                         Телефон:   $phone\n\n
                         Подписка   $subscribe\n\n
            ";//Тело письма
        $headers = 'From: My Site <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $mail."\r\n"."Content-type: text/plain; charset=utf-8";
    mail($emailTo, $subject, $body, $headers);
    echo "Запрос отправлен";
}
else{
    echo "Ошибка! Проверьте все поля.";
}


?>