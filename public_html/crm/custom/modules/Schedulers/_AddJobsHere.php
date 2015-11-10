<?php
$job_strings[] = 'OpportunityReport';

function OpportunityReport(){


define('sugarEntry', TRUE);
require_once($_SERVER['DOCUMENT_ROOT'].'/include/nusoap/nusoap.php');


function report($data)
{
    $language = $_SERVER['DOCUMENT_ROOT']."/custom/include/language/ru_ru.lang.php";
    if (is_file($language)) {
        require_once($_SERVER['DOCUMENT_ROOT'].'/custom/include/language/ru_ru.lang.php');
        $stage=$GLOBALS['app_list_strings']['sales_stage_dom'];
    }
    else{
        $app_list_strings=array();
        require_once($_SERVER['DOCUMENT_ROOT'].'/include/language/ru_ru.lang.php');
        $stage=$app_list_strings['sales_stage_dom'];
    }
    $body="
<html>
<head>
<meta charset='UTF-8'>
        <style>
        table{
        width:100%;
        }
        tr:first-child td{
        text-align: center;
        font-weight: bold;
        }
        td{



        }
        </style>
        </head>
        <body>
        <p>
        Добрый день $data[name]
        <br>
        <br>

Обратите внимание, что по сделкам в списке ниже просрочен следующий шаг:
        </p>
        <table border=1>
            <tr>
                <td>
Название сделки
                </td>
                <td>
Контрагент
                </td>
                <td>
Стадия продаж
                </td>
                <td>
Дата след. шага
                </td>
                <td>
Следующий шаг
                </td>
             </tr>

";
    foreach ($data['opportunities'] as $key => $value) {
        $body.= "
                    <tr>
                <td><a href='http://".$_SERVER['HTTP_HOST']."/index.php?module=Opportunities&action=DetailView&record=".$data['opportunities'][$key]['id']."'>
" . $data['opportunities'][$key]['name'] . "</a>
                </td>
                <td>
" . $data['opportunities'][$key]['account'] . " " . $data['opportunities'][$key]['phone_office'] . "
                </td>
                <td>
" . $stage[$data['opportunities'][$key]['sales_stage']] . "
                </td>
                <td>
" . $data['opportunities'][$key]['next_step_date'] . "
                </td>
                <td>
" . $data['opportunities'][$key]['next_step'] . "
                </td>
             </tr>
        ";
    }
    $body.= "</table></body></html>";
    $subject="[CRM] Ваши сделки с просроченным следующим шагом"; // Тема письма
    $headers = 'From: '.$data['name'].' <'.$data['email'].'>' . "\r\n" . 'Reply-To: noreply@crm.sunnyholidays.by'."\r\n"."Content-type: text/html; charset=utf-8";
    $body;
    mail($data['email'], $subject, $body, $headers);
}

$soapclient = new nusoap_client("http://crm.sunnyholidays.by/soap.php?wsdl");
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
$get_entry_list = array(
    'session' => $session,
    'module_name' => 'Opportunities',
    'query' => 'opportunities_cstm.next_step_date_c <= "' . date("Y-m-d") . '" and opportunities.sales_stage not like "Closed%" and opportunities.assigned_user_id not like ""'
);
$opportunities_arr = $soapclient->call('get_entry_list', $get_entry_list);


$opportunities_arr = $opportunities_arr['entry_list'];
$opportunities = array();
$account_list = array();

foreach ($opportunities_arr as $key => $value) {
    if (empty($opportunities[$opportunities_arr[$key]['name_value_list'][0]['value']])) {
        $opportunities[$opportunities_arr[$key]['name_value_list'][0]['value']] = array();
    }
    $array = array(
        'id' => $opportunities_arr[$key]['name_value_list'][3]['value'],
        'name' => $opportunities_arr[$key]['name_value_list'][4]['value'],
        'account' => $opportunities_arr[$key]['name_value_list'][13]['value'],
        'sales_stage' => $opportunities_arr[$key]['name_value_list'][24]['value'],
        'next_step_date' => $opportunities_arr[$key]['name_value_list'][26]['value'],
        'next_step' => $opportunities_arr[$key]['name_value_list'][23]['value']
    );
    array_push($account_list, 'accounts.name="' . $array['account'] . '"');
    array_push($opportunities[$opportunities_arr[$key]['name_value_list'][0]['value']], $array);
}

$get_entry_list = array(
    'session' => $session,
    'module_name' => 'Employees',
    'query' => ''
);
$employees_arr = $soapclient->call('get_entry_list', $get_entry_list);


$employees_arr = $employees_arr['entry_list'];
$employees = array();
foreach ($employees_arr as $key => $value) {
    $name = trim($employees_arr[$key]['name_value_list'][9]['value'] . " " . $employees_arr[$key]['name_value_list'][10]['value']);
    $employees[$name]['email'] = $employees_arr[$key]['name_value_list'][40]['value'];
}
$account_list = implode(" or ", $account_list);
$get_entry_list = array(
    'session' => $session,
    'module_name' => 'Accounts',
    'query' => $account_list
);
$accounts_arr = $soapclient->call('get_entry_list', $get_entry_list);
$accounts_arr = $accounts_arr['entry_list'];
$accounts = array();

foreach ($accounts_arr as $key => $value) {
    $name = $accounts_arr[$key]['name_value_list'][4]['value'];
    $accounts[$name]['phone_office'] = $accounts_arr[$key]['name_value_list'][22]['value'];
}

foreach ($opportunities as $key => $value) {
    $data['email'] = $employees[$key]['email'];
    $data['name'] = $key;
    $data['opportunities'] = array();
    foreach ($opportunities[$key] as $key1 => $value1) {
        $account = $opportunities[$key][$key1]['account'];
        $opportunities[$key][$key1]['phone_office'] = $accounts[$account]['phone_office'];
        array_push($data['opportunities'], $opportunities[$key][$key1]);
    }

    report($data);
}


$soapclient->call('logout', array('session' => $session));


    return true;
}