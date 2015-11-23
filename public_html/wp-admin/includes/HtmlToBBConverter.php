<?php

class HtmlToBBConverter
{
    public $equivalents;

    function __construct()
    {
        $this->equivalents = array(
            new Equivalent('/\<br\>/', '[br]', '/\<\/br\>/', '[/br]'),
            new Equivalent('/\<em\>/', '[i]', '/\<\/em\>/', '[/i]'),
            new Equivalent('/\<code\>/', '[code]', '/\<\/code\>/', '[/code]'),
            new Equivalent('/\<address\>/', '[address]', '/\<\/address\>/', '[/address]'),
            new Equivalent('/\<b\>/', '[b]', '/\<\/b\>/', '[/b]'),
            new Equivalent('/\<i\>/', '[i]', '/\<\/i\>/', '[/i]'),
            new Equivalent('/\<strong\>/', '[b]', '/\<\/strong\>/', '[/b]'),
            new Equivalent('/\<h1\>/', '[b]', '/\<\/h1\>/', '[/b]'),
            new Equivalent('/\<h2\>/', '[b]', '/\<\/h2\>/', '[/b]'),
            new Equivalent('/\<h3\>/', '[b]', '/\<\/h3\>/', '[/b]'),
            new Equivalent('/\<h4\>/', '[b]', '/\<\/h4\>/', '[/b]'),
            new Equivalent('/\<h5\>/', '[b]', '/\<\/h5\>/', '[/b]'),
            new Equivalent('/\<h6\>/', '[b]', '/\<\/h6\>/', '[/b]'),
            new Equivalent('/\<pre\>/', '[pre]', '/\<\/pre\>/', '[/pre]'),
            new Equivalent('/\<blockquote\>/', '[quote]', '/\<\/blockquote\>/', '[/quote]'),
            new Equivalent('/\<del\>/', '[s]', '/\<\/del\>/', '[/s]'),
            new Equivalent('/\<u\>/', '[u]', '/\<\/u\>/', '[/u]'),
            new Equivalent('/\<ul\>/', '[list]', '/\<\/ul\>/', '[/list]'),
            new Equivalent('/\<ol\>/', '[list=1]', '/\<\/ol\>/', '[/list]'),
            new Equivalent('/\<li\>/', '[*]', '', ''),
            new Equivalent('/\<\/li\>/', '', '', ''),
            new Equivalent('/\<p\s+style="text-align:\s*right;"\s*\>/', '[right]', '/\<\/p\>/', '[/right]'),
            new Equivalent('/\<p\s+style="text-align:\s*left;"\s*\>/', '[left]', '/\<\/p\>/', '[/left]'),
            new Equivalent('/\<p\s+style="text-align:\s*center;"\s*\>/', '[right]', '/\<\/p\>/', '[/right]'),
            new Equivalent('/\<p\s+style="text-align:\s*justify;"\s*\>/', '[right]', '/\<\/p\>/', '[/right]'),
            new Equivalent('/\<span\s+style="color:\s*(?<colorName>#*[a-zA-Z0-9\,\.\(\)%\s]+);"\>/', "[color]", '/\<\/span\>/', '[/color]'),
            new Equivalent('/\<a\s+href="(?<urlName>[a-zA-Z0-9\._-à-ÿÀ-ß:\/\/\\\\#\?=]+)"(\s*title="(?<titleName>([^"]*))")?(\s*[^\>]+)*\>/', "[url]", '/\<\/a\>/', '[/url]'),
            new Equivalent('/\<img\s+src="(?<imgUrlName>[^"]+)"(\s+alt="(?<altName>([^"]*))")?(\s*[^\>]+)*(\s*\/\s*)\>/', '[img]', '', '')
        );
    }

    public function convertToBb($html)
    {
        $bb = $html;
        $bb = preg_replace('/\[[^\]]+\]/', '', $bb);
        foreach ($this->equivalents as $equivalent) {
            $searchPosition = 0;
            while (preg_match($equivalent->getHtmlOpenTag(), $bb, $openMatches, PREG_OFFSET_CAPTURE, $searchPosition)) {
                $openTag = $openMatches[0][0];
                $openIndex = $openMatches[0][1];
                $bbOpenTag = $equivalent->getBbOpenTag();
                if ($openMatches['colorName'] && $openMatches['colorName'][1] != -1) {
                    $bbOpenTag = '[color=' . $openMatches['colorName'][0] . ']';
                } else if ($openMatches['urlName'] && $openMatches['urlName'][1] != -1) {
                    $bbOpenTag = '[url=' . $openMatches['urlName'][0] . ']';
                    if ($openMatches['titleName'] && $openMatches['titleName'][1] != -1) {
                        $bbOpenTag = $bbOpenTag . $openMatches['titleName'][0];
                    }
                } else if ($openMatches['imgUrlName'] && $openMatches['imgUrlName'][1] != -1) {
                    $bbOpenTag = $bbOpenTag . $openMatches['imgUrlName'][0] . '[/img]';
                }
                if ($equivalent->getBbCloseTag() && strlen($equivalent->getBbCloseTag()) > 0) {
                    preg_match($equivalent->getHtmlCloseTag(), $bb, $closeMatches, PREG_OFFSET_CAPTURE, $openIndex + strlen($bbOpenTag));
                    $closeIndex = $closeMatches[0][1];
                    $closeTag = $closeMatches[0][0];
                    $bb = substr_replace($bb, $equivalent->getBbCloseTag(), $closeIndex, strlen($closeTag));
                }
                $bb = substr_replace($bb, $bbOpenTag, $openIndex, strlen($openTag));
                $searchPosition = $openIndex + strlen($bbOpenTag);
            }
        }
        return $bb;
    }
}