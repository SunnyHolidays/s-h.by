<?php

class NewPostParams
{
    private $loginUrl = 'http://forum.grodno.net/index.php?action=login2';
    private $logoutUrl = 'http://forum.grodno.net/index.php?action=logout;sesc=';
    private $newPostUrl = 'http://forum.grodno.net/index.php?action=post2';
    private $username;
    private $password;
    private $cookieLength = 9000;
    private $frmLogin = 'submitted';
    private $topic;
    private $subject;
    private $icon = 'xx';
    private $notify = 0;
    private $goBack = 1;
    private $num_replies = 980;
    private $message;
    private $postModify = 'submitted';
    private $cookie;

    /**
     * @return mixed
     */
    public function getLoginUrl()
    {
        return $this->loginUrl;
    }

    /**
     * @param mixed $loginUrl
     * @return NewPostParams
     */
    public function setLoginUrl($loginUrl)
    {
        $this->loginUrl = $loginUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogoutUrl()
    {
        return $this->logoutUrl;
    }

    /**
     * @param string $logoutUrl
     */
    public function setLogoutUrl($logoutUrl)
    {
        $this->logoutUrl = $logoutUrl;
    }

    /**
     * @return mixed
     */
    public function getNewPostUrl()
    {
        return $this->newPostUrl;
    }

    /**
     * @param mixed $newPostUrl
     * @return NewPostParams
     */
    public function setNewPostUrl($newPostUrl)
    {
        $this->newPostUrl = $newPostUrl;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     * @return NewPostParams
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return NewPostParams
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCookieLength()
    {
        return $this->cookieLength;
    }

    /**
     * @param mixed $cookieLength
     * @return NewPostParams
     */
    public function setCookieLength($cookieLength)
    {
        $this->cookieLength = $cookieLength;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFrmLogin()
    {
        return $this->frmLogin;
    }

    /**
     * @param mixed $frmLogin
     * @return NewPostParams
     */
    public function setFrmLogin($frmLogin)
    {
        $this->frmLogin = $frmLogin;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * @param mixed $topic
     * @return NewPostParams
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     * @return NewPostParams
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param mixed $icon
     * @return NewPostParams
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNotify()
    {
        return $this->notify;
    }

    /**
     * @param mixed $notify
     * @return NewPostParams
     */
    public function setNotify($notify)
    {
        $this->notify = $notify;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGoBack()
    {
        return $this->goBack;
    }

    /**
     * @param mixed $goBack
     * @return NewPostParams
     */
    public function setGoBack($goBack)
    {
        $this->goBack = $goBack;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumReplies()
    {
        return $this->num_replies;
    }

    /**
     * @param mixed $num_replies
     * @return NewPostParams
     */
    public function setNumReplies($num_replies)
    {
        $this->num_replies = $num_replies;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     * @return NewPostParams
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPostModify()
    {
        return $this->postModify;
    }

    /**
     * @param mixed $postModify
     * @return NewPostParams
     */
    public function setPostModify($postModify)
    {
        $this->postModify = $postModify;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCookie()
    {
        return $this->cookie;
    }

    /**
     * @param mixed $cookie
     * @return NewPostParams
     */
    public function setCookie($cookie)
    {
        $this->cookie = $cookie;
        return $this;
    }
}