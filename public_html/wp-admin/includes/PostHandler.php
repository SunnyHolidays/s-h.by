<?php

class PostHandler
{
    private $params;
    private $loginData;
    private $newPostData;

    function __construct($params)
    {
        $this->params = $params;
    }

    public function login()
    {
        $this->loginData = [
            "user" => $this->params->getUsername(),
            "passwrd" => $this->params->getPassword(),
            "cookielength" => $this->params->getCookieLength(),
            "frmLogin" => $this->params->getFrmLogin()
        ];
        $ch1 = curl_init();
        curl_setopt($ch1, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2");
        curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch1, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch1, CURLOPT_COOKIEJAR, $this->params->getCookie());
        curl_setopt($ch1, CURLOPT_COOKIEFILE, $this->params->getCookie());
        curl_setopt($ch1, CURLOPT_REFERER, $this->params->getloginUrl());
        curl_setopt($ch1, CURLOPT_URL, $this->params->getloginUrl());
        curl_setopt($ch1, CURLOPT_POSTFIELDS, http_build_query($this->loginData));
        curl_setopt($ch1, CURLOPT_POST, 1);
        $loginResult = curl_exec($ch1);
        curl_close($ch1);
        return $loginResult;
    }

    public function createPost($loginResult)
    {
        if ($loginResult) {
            preg_match_all('/\<a href="\/index.php\?action=logout;sesc=([a-z0-9]+)"\>Выйти\<\/a\>/', $loginResult, $matches);
            if (count($matches) > 0 && $matches[1]) {
                $this->newPostData = [
                    "topic" => $this->params->getTopic(),
                    "subject" => $this->params->getSubject(),
                    "icon" => $this->params->getIcon(),
                    "notify" => $this->params->getNotify(),
                    "goback" => $this->params->getGoBack(),
                    "num_replies" => $this->params->getNumReplies(),
                    "message" => $this->params->getMessage(),
                    "sc" => $matches[1][0],
                    "postmodify" => $this->params->getPostModify()
                ];
                $ch2 = curl_init();
                curl_setopt($ch2, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2");
                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($ch2, CURLOPT_FAILONERROR, 1);
                curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch2, CURLOPT_COOKIEJAR, $this->params->getCookie());
                curl_setopt($ch2, CURLOPT_COOKIEFILE, $this->params->getCookie());
                curl_setopt($ch2, CURLOPT_REFERER, $this->params->getNewPostUrl());
                curl_setopt($ch2, CURLOPT_URL, $this->params->getNewPostUrl());
                curl_setopt($ch2, CURLOPT_POSTFIELDS, http_build_query($this->newPostData));
                curl_setopt($ch2, CURLOPT_POST, 1);
                $postCreationResult = curl_exec($ch2);
                curl_close($ch2);
                return $postCreationResult;
            }
        }
        return null;
    }

    public function logout($loginResult)
    {
        if ($loginResult) {
            preg_match_all('/\<a href="\/index.php\?action=logout;sesc=([a-z0-9]+)"\>Выйти\<\/a\>/', $loginResult, $matches);
            if (count($matches) > 0 && $matches[1]) {
                $sc = $matches[1][0];
                $ch3 = curl_init();
                curl_setopt($ch3, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2");
                curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($ch3, CURLOPT_FAILONERROR, 1);
                curl_setopt($ch3, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch3, CURLOPT_COOKIEJAR, $this->params->getCookie());
                curl_setopt($ch3, CURLOPT_COOKIEFILE, $this->params->getCookie());
                curl_setopt($ch3, CURLOPT_REFERER, $this->params->getlogoutUrl().$sc);
                curl_setopt($ch3, CURLOPT_URL, $this->params->getlogoutUrl().$sc);
                $logoutResult = curl_exec($ch3);
                curl_close($ch3);
                return $logoutResult;
            }
        }
        return null;
    }
}