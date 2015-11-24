<?php

include_once 'NewPostParams.php';
include_once 'PostHandler.php';
include_once 'Equivalent.php';
include_once 'HtmlToBBConverter.php';

const TOPIC_NUMBER = 3528534; //3528534 - тест, 2480301 - саннихолидэйс
const FORUM_USERNAME = 'Skeleos';
const FORUM_PASSWORD = 'sa375292884545';

class PostCreator
{
    static function create($subject, $content){
        $params = new NewPostParams();
        $htmlConverter = new HtmlToBBConverter();

        $params->setTopic(TOPIC_NUMBER);
        $params->setCookie(__DIR__ . '/cookie.txt');
        $params->setUsername(FORUM_USERNAME);
        $params->setPassword(FORUM_PASSWORD);

        $bbContent = $htmlConverter->convertToBb(iconv('utf-8', 'windows-1251', $content));
        $params->setSubject(iconv('utf-8', 'windows-1251', $subject));
        $params->setMessage($bbContent);

        $postHandler = new PostHandler($params);
        $loginResult = $postHandler->login();
        if (!$loginResult) {
            sleep(10);
            $loginResult = $postHandler->login();
        }
        $postHandler->createPost($loginResult);
        $postHandler->logout($loginResult);
    }
}