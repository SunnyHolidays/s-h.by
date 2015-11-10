<?php
/**
 * Template Name: Send Mail
 */
function mergestring($data){
    $datatemp="";
    $iterator=0;
    foreach($data as $value){
        $iterator++;
        if($iterator>=2){
            $datatemp.=",";
        }
        $datatemp .= $value;
    }
    return $datatemp;
}
function parseOptions($data, $id, $separator){
    $bufArr=array();
    foreach($data as $value){
        $bufArr[]=explode($separator,$value);
    }
    unset($data);
    $data=array();
    foreach($bufArr as $value){
        $data[]=$value[$id];
    }
    return $data;
}
function Sugar($data){

    require_once('lib/nusoap.php');
    $soapclient = new nusoap_client("http://crm.sunnyholidays.by/soap.php");
    $result = $soapclient->call(
        'login',
        array(
            'user_auth' =>
            array(
                'user_name' => "vlad",
                'password' => md5("99749974"),
                'version' => '.01'
            ),
            'application_name' => 'SoapTest'
        )
    );

    $session = $result['id'];

    $set_entry_params = array(
        'session' => $session,
        'module_name' => 'Accounts',
        'name_value_list' => array(
            array('name' => 'name', 'value' =>  $data["name"]." ".$data["lname"]),
            array('name' => 'email1', 'value' =>  $data["mail"]),
            array('name' => 'phone_office', 'value' =>  $data["phone"]),
        ));
    $result = $soapclient->call('set_entry', $set_entry_params);

    $account = $result['id'];

    $set_entry_params = array(
        'session' => $session,
        'module_name' => 'Contacts',
        'name_value_list'=> array(
            array('name'=>'first_name','value'=>  $data["name"]),
            array('name'=>'last_name','value'=>  $data["lname"]),
            array('name'=>'account_id','value'=> $account),
            array('name' => 'phone_office', 'value' =>  $data["phone"]),
            array('name' => 'lead_source', 'value' =>  "Web Site"),
            array('name'=>'email1','value'=> $data["mail"])));

    $result = $soapclient->call('set_entry', $set_entry_params);

    //$contact =$result['id'] ;
    $buf["departure"]=parseOptions($data["departure"],1,';');
    $buf["country"]=parseOptions($data["country"],1,';');
    $country=mergestring($buf["country"]);
    $departure=mergestring($buf["departure"]);
    $cbirdtdays=mergestring($data["children_birthday"]);

    $date_closed= date('Y-m-d', strtotime(date("Y-m-d", strtotime($data["period_to"])) . " +1 week"));

    $money = filter_var($data["money_amount"], FILTER_SANITIZE_NUMBER_INT);


    if($data["children_number"]==0){
        $people=$data["people"]."взр.";
    }
    else{
        $people=$data["people"]."+". $data["children_number"]."(".$cbirdtdays.") ";
    }

    $set_entry_params = array(
        'session' => $session,
        'module_name' => 'Opportunities',
        'name_value_list'=> array(
            array('name'=>'name','value'=> $country.";".$data["duration"].";".$departure.";".$people),
            array('name'=>'amount','value'=> $money),
            array('name'=>'date_closed','value'=>$date_closed),
            array('name'=>'sales_stage','value'=>'Prospecting'),
            array('name'=>'lead_source','value'=>'Web Site'),
            array('name'=>'account_id','value'=>$account),
            array('name'=>'description','value'=>$data['body'])));
    $result = $soapclient->call('set_entry', $set_entry_params);

    $opportunity =$result['id'] ;
    $set_entry_params = array(
        'session' => $session,
        'module_name' => 'Notes',
        'name_value_list'=>array(
            array('name'=>'name','value'=>"Детали исходного запроса с сайта"),
            array('name'=>'description','value'=>$data['body']),
            array('name'=>'parent_type','value'=>'Opportunities'),
            array('name'=>'parent_id','value'=>$opportunity)));
    $result = $soapclient->call('set_entry', $set_entry_params);
    $soapclient->call('logout', array('session' => $session));
}
function Crm($data){
    $url = 'http://sunnyholidays.by/yiicrm/www/index.php';
    $login = 'admin';
    $password = 'admin';
    $buf["departure"]=parseOptions($data["departure"],0,';');
    $buf["country"]=parseOptions($data["country"],0,';');
    $params = array(
        'login'=>$login,
        'password'=>$password,
        'r' => 'api/create',
        'model' => 'requests',
        'attributes'=>array(
            'date_departure' => $data["period_from"],
            'date_return' => $data["period_to"],
            'duration' => str_replace('  дн.','',$data["duration"]),
            'adults' => $data["people"],
            'children' => $data["children_number"],
            'child_age' => implode(';',$data["children_birthday"]),
            'budget' => str_replace('до $','',$data["money_amount"]),
            'category' => $data["category"],
            'params' => str_replace('check','',implode(';',$data["checkbox"])),
            'first_name' => $data["name"],
            'last_name' => $data["lname"],
            'email' => $data["mail"],
            'phone' => $data["phone"],
            'status' => '1',
            'comment' => $data["comment"],
            'date_next_step' => date('Y-m-d'),
            'description_next_step' => '',
            'source' => 'sunnyholidays.by',
            'food' => $data["food"][0],
            'requestCountries' => $buf["country"],
            'requestAirports' => $buf["departure"],),
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_exec($ch);
    curl_close($ch);
    print_r($params);
}
array(
    array('name'=>'name','value'=>""),
    array('name'=>'description','value'=>""),
    array('name'=>'parent_type','value'=>'Accounts'),
    array('name'=>'parent_id','value'=>$_SESSION['accountid']));

$hasError = false;
if(!isset($_POST['country']) || count($_POST['country']) == 0) {
    $hasError = true;
} else {
    $data["country"] = $_POST['country'];
}
if(trim($_POST['period_from']) == '') {
    $hasError = true;
} else {
    $data["period_from"] = trim($_POST['period_from']);
}
if(trim($_POST['period_to']) == '') {
    $hasError = true;
} else {
    $data["period_to"] = trim($_POST['period_to']);
}
if(trim($_POST['duration']) == '') {
    $hasError = true;
} else {
    $data["duration"] = trim($_POST['duration']);
}
if(!isset($_POST['departure']) || count($_POST['departure']) == 0) {
    $hasError = true;
} else {
    $data["departure"] = $_POST['departure'];
}
if(trim($_POST['people']) == '') {
    $hasError = true;
} else {
    $data["people"] = trim($_POST['people']);
}
if(isset($_POST['children_number'])) {
    $data["children_number"] = trim($_POST['children_number']);
}
$data["children_birthday"] = array();
if(isset($_POST['children_birthday'])) {
    $data["children_birthday"] = $_POST['children_birthday'];
}
if(trim($_POST['money_amount']) == '') {
    $hasError = true;
} else {
    $data["money_amount"] = trim($_POST['money_amount']);
}
if(trim($_POST['category']) == '') {
    $hasError = true;
} else {
    $data["category"] = trim($_POST['category']);
}
$data["food"] = '';
if(trim($_POST['food']) != '') {
    $data["food"] = trim($_POST['food']);
}
$data["checkbox"] = array();
if(isset($_POST['checkbox'])) {
    $data["checkbox"] = $_POST['checkbox'];
}
if(trim($_POST['fname']) == '') {
    $hasError = true;
} else {
    $data["name"] = trim($_POST['fname']);
}
if(trim($_POST['lname']) == '') {
    $hasError = true;
} else {
    $data["lname"] = trim($_POST['lname']);
}
if(trim($_POST['mail']) == '') {
    $hasError = true;
} else {
    $data["mail"] = trim($_POST['mail']);
}
if(trim($_POST['phone']) == '') {
    $hasError = true;
} else {
    $data["phone"] = trim($_POST['phone']);
}
if(isset($_POST['subscribe'])) {
    $data["subscribe"] = 'Включить';
} else {
    $data["subscribe"] = 'Не включать';
}
if(isset($_POST['comment'])) {
    $data["comment"] = $_POST['comment'];
} else {
    $data["comment"] = '';
}

$data["checkboxes"] = array(
    'check0' => '1-я береговая линия',
    'check1' => 'Для семей с детьми',
    'check2' => 'Центр населенного пункта',
    'check3' => 'Wifi internet',
    'check4' => 'Корты',
    'check5' => 'Сауна',
    'check6' => 'Ночная жизнь',
    'check7' => 'Анимация для взрослых',
    'check8' => 'Водные горки',
    'check9' => 'Анимация для детей',
);

//Если ошибок нет, отправить email
if(!$hasError) {
    $buf["departure"]=parseOptions($data["departure"],1,';');
    $buf["country"]=parseOptions($data["country"],1,';');
    $buf['food']=explode(';',$data['food']);
    unset($data['food']);
    $data['food']=$buf['food'];
    $emailTo = "sergey@sunnyholidays.by"; //Сюда введите Ваш email
    $subject="Заказ тура на sunnyholidays!"; // Тема письма
    $body = "Страны:
	";
    foreach($buf["country"] as $value){
        $body .= $value."
	";
    }
    $body .= "
Период:
	c: ".$data["period_from"]."
	по: ".$data["period_to"]."
Продолжительность: ".$data["duration"]."
Вылет из:
	";
    foreach($buf["departure"] as $value){
        $body .= $value."
	";
    }
    $body.="
Взрослых: ".$data["people"]."
Детей: ".$data["children_number"]."
Возраст детей:
	";
    foreach($data["children_birthday"] as $value){
        $body .= $value."
	";
    }
    $body.="
Бюджет: ".$data["money_amount"]."
Категория: ".$data["category"]."
Питания: ".$data["food"][1]."
Условия:
    ";
    foreach($data["checkbox"] as $value){
        $body .= $data["checkboxes"][$value]."
	";
    }
    $body.="
Имя: ".$data["name"]." ".$data["lname"]."
Почта: ".$data["mail"]."
Телефон: ".$data["phone"]."
Подписка: ".$data["subscribe"]."
Комментарий: ".$data["comment"];
    $data['body']=$body;
    Sugar($data);
    Crm($data);
    $headers = 'From: Form <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $data["mail"]."\r\n"."Content-type: text/html; charset=utf-8";
    $mail_result = mail($emailTo, $subject, $body, $headers);

    $headers = 'From: Form <sunnyholidays.by>' . "\r\n" . "Content-type: text/html; charset=utf-8";
    $subject = 'Заказ на sunnyholidays.by';

    $mail_post = get_page_by_title('Mail for Client', OBJECT, 'post' );
    $body = $mail_post->post_content;

    $mail_result = mail($data["mail"], $subject, $body, $headers);

    if($data["subscribe"] == 'Включить'){
        include 'lib/MCAPI.class.php';
        $apiKey = '0c671a86abb1cf30bc1c94dc14e09d50-us6';
        $listId = '203c83f1a7';
        $mailchimpAPI = new MCAPI($apiKey);
        $mergeVars=array(
            'FNAME'=>$data["name"], 'LNAME'=>$data["lname"],'EMAIL'=>$data["mail"],'PHONE'=>$data["phone"],
        );

        $mailchimpAPI->listSubscribe($listId, $data['mail'], $mergeVars);
    }
    echo "ok";
} else {
    echo "error";
}

?>