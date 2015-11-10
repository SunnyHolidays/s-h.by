<?php
/**
 * Created by JetBrains PhpStorm.
 * User: v.romanovsky
 * Date: 12.06.13
 * Time: 12:08
 */
class ApiController extends Controller
{

    private $format = 'json';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array();
    }


    public function actionIndex()
    {
        $api = "CRM API home page.<br>Allowed methods: list, view, create, update";
        echo CJSON::encode($api);
    }

    public function actionList()
    {
        $this->_checkAuth();
        switch ($_POST['model']) {
            case 'users':
                $models = Users::model()->findAll();
                break;
            case 'requests':
                $models = Requests::model()->findAll();
                break;
            case 'orders':
                $models = Orders::model()->findAll();
                break;
            default:
                $this->_sendResponse(
                    501,
                    sprintf('Ошибка: Операция <b>list</b> не разрешена для модели <b>%s</b>', $_POST['model'])
                );
                exit;
        }
        if (is_null($models)) {
            $this->_sendResponse(200, sprintf('Не найдено элементов для модели <b>%s</b>', $_POST['model']));
        } else {
            $rows = array();
            foreach ($models as $model) {
                $rows[] = $model->attributes;
            }

            $this->_sendResponse(200, $this->_getObjectEncoded($_POST['model'], $rows));
        }
    } /*
     * @access public
     * @return void
     */
    public function actionView()
    {
        $this->_checkAuth();
        if (!isset($_POST['id'])) {
            $this->_sendResponse(500, 'Ошибка: Парамерт <b>id</b> отсутствует');
        }

        switch ($_POST['model']) {
            case 'users':
                $model = Users::model()->findByPk($_POST['id']);
                break;
            case 'requests':
                $model = Requests::model()->findByPk($_POST['id']);
                break;
            case 'orders':
                $model = Orders::model()->findByPk($_POST['id']);
                break;
            default:
                $this->_sendResponse(
                    501,
                    sprintf('Ошибка: Операция <b>view</b> не разрешена для модели <b>%s</b>', $_POST['model'])
                );
                exit;
        }
        if (is_null($model)) {
            $this->_sendResponse(404, 'Не найдено элементов с id ' . $_POST['id']);
        } else {
            $this->_sendResponse(200, $this->_getObjectEncoded($_POST['model'], $model->attributes));
        }
    }

    /**
     * @access public
     * @return void
     */
    public function actionCreate()
    {
        $this->_checkAuth();
        $custom=false;
        switch ($_POST['model']) {

            case 'users':
                $model = new Users;
                break;
            case 'requests':
                $model = new Requests;
                $model->setAttributes($_POST['attributes']);
                $model->date = date('Y-m-d');
                $requestAirports = RequestAirports::updating($_POST['attributes']['requestAirports'], $model);
                $requestCountries = RequestCountries::updating($_POST['attributes']['requestCountries'], $model);
                $model->setRequestsAirports($requestAirports);
                $model->setRequestCountries($requestCountries);

                $model->source = 'sunnyholidays.by';
                if(isset($_POST['attributes']['child_age'])){
                    $model->setAttribute('child_age',$_POST['attributes']['child_age']);
                }
                else{
                    $model->child_age=null;
                }
                if(!$model->date_next_step){
                    $model->setAttribute('date_next_step', $model->date);
                }
                if(!$model->user_id){
                    $model->setAttribute('user_id',null);
                }
                $custom=true;
                break;
            case 'orders':
                $model = new Orders;
                break;
            default:
                $this->_sendResponse(
                    501,
                    sprintf('Ошибка: Операция <b>create</b> не разрешена для модели <b>%s</b>', $_POST['model'])
                );
                exit;
        }

        if(!$custom){
        foreach ($_POST['attributes'] as $var => $value) {
            if (!$model->setAttribute($var,$value)) {
                $this->_sendResponse(
                    500,
                    sprintf('Ошибка: Парамерт <b>%s</b> не разрешен для модели <b>%s</b>', $var, $_POST['model'])
                );
            }
        }}
        if ($model->save()) {

            $this->_sendResponse(200, $this->_getObjectEncoded($_POST['model'], $model->attributes));
        } else {

            $msg = "<h1>Ошибка</h1>";
            $msg .= sprintf("Не могу создать модель <b>%s</b>", $_POST['model']);
            $msg .= "<ul>";
            foreach ($model->errors as $attribute => $attr_errors) {
                $msg .= "<li>Аттрибут: $attribute</li>";
                $msg .= "<ul>";
                foreach ($attr_errors as $attr_error) {
                    $msg .= "<li>$attr_error</li>";
                }
                $msg .= "</ul>";
            }
            $msg .= "</ul>";
            $this->_sendResponse(500, $msg);
        }

        var_dump($_REQUEST);
    }

    /**
     * @access public
     * @return void
     */
    public function actionUpdate()
    {
        $this->_checkAuth();

        parse_str(file_get_contents('php://input'), $put_vars);

        switch ($_POST['model']) {
            case 'posts':
                $model = Users::model()->findByPk($_POST['id']);
                break;
            default:
                $this->_sendResponse(
                    501,
                    sprintf('Error: Mode <b>update</b> is not implemented for model <b>%s</b>', $_POST['model'])
                );
                exit;
        }
        if (is_null($model)) {
            $this->_sendResponse(
                400,
                sprintf(
                    "Error: Didn't find any model <b>%s</b> with ID <b>%s</b>.",
                    $_POST['model'],
                    $_POST['id']
                )
            );
        }

        foreach ($put_vars as $var => $value) {

            if ($model->hasAttribute($var)) {
                $model->$var = $value;
            } else {

                $this->_sendResponse(
                    500,
                    sprintf('Parameter <b>%s</b> is not allowed for model <b>%s</b>', $var, $_POST['model'])
                );
            }
        }
        if ($model->save()) {
            $this->_sendResponse(
                200,
                sprintf('The model <b>%s</b> with id <b>%s</b> has been updated.', $_POST['model'], $_POST['id'])
            );
        } else {
            $msg = "<h1>Error</h1>";
            $msg .= sprintf("Couldn't update model <b>%s</b>", $_POST['model']);
            $msg .= "<ul>";
            foreach ($model->errors as $attribute => $attr_errors) {
                $msg .= "<li>Attribute: $attribute</li>";
                $msg .= "<ul>";
                foreach ($attr_errors as $attr_error) {
                    $msg .= "<li>$attr_error</li>";
                }
                $msg .= "</ul>";
            }
            $msg .= "</ul>";
            $this->_sendResponse(500, $msg);
        }
    }

    /**
     * @param int $status
     * @param string $body
     * @param string $content_type
     * @access private
     * @return void
     */
    private function _sendResponse($status = 200, $body = '', $content_type = 'text/html')
    {
        $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
        header($status_header);
        header('Content-type: ' . $content_type);
        if ($body != '') {

            echo $body;
            exit;
        } else {
            $message = '';
            switch ($status) {
                case 401:
                    $message = 'You must be authorized to view this page.';
                    break;
                case 404:
                    $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
                    break;
                case 500:
                    $message = 'The server encountered an error processing your request.';
                    break;
                case 501:
                    $message = 'The requested method is not implemented.';
                    break;
            }

            $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];

            $body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
                        <html>
                            <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
                                <title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
                            </head>
                            <body>
                                <h1>' . $this->_getStatusCodeMessage($status) . '</h1>
                                <p>' . $message . '</p>
                                <hr />
                                <address>' . $signature . '</address>
                            </body>
                        </html>';

            echo $body;
            print_r($_SERVER);
            exit;
        }
    }

    /**
     * @param mixed $status
     * @access private
     * @return string
     */
    private function _getStatusCodeMessage($status)
    {
        $codes = Array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => '(Unused)',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported'
        );

        return (isset($codes[$status])) ? $codes[$status] : '';
    }

    /**
     * @access private
     * @return void
     */
    private function _checkAuth()
    {
        if (!(isset($_POST['login']) and isset($_POST['password']))) {
            $this->_sendResponse(401);
        }
        $login = $_POST['login'];
        $password = $_POST['password'];

        $user = Users::model()->findByAttributes(array('login' => $login));

        if ($user === null) {
            $this->_sendResponse(401, 'Error: Username is invalid');
        } elseif ($user->password !== crypt($password, $user->password)) {
            $this->_sendResponse(401, 'Error: User Password is invalid');
        }
    }

    /**
     * @param mixed $model
     * @param mixed $array Data to be encoded
     * @access private
     * @return string
     */
    private function _getObjectEncoded($model, $array)
    {
        if (isset($_POST['format'])) {
            $this->format = $_POST['format'];
        }

        if ($this->format == 'json') {
            return CJSON::encode($array);
        } elseif ($this->format == 'xml') {
            $result = '<?xml version="1.0">';
            $result .= "\n<$model>\n";
            foreach ($array as $key => $value) {
                $result .= "    <$key>" . utf8_encode($value) . "</$key>\n";
            }
            $result .= '</' . $model . '>';
            return $result;
        } else {
            return false;
        }
    }

}

