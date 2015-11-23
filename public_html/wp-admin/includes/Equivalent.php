<?php

class Equivalent
{
    private $htmlOpenTag;
    private $htmlCloseTag;
    private $bbOpenTag;
    private $bbCloseTag;

    /**
     * @return mixed
     */
    public function getBbCloseTag()
    {
        return $this->bbCloseTag;
    }

    /**
     * @return mixed
     */
    public function getHtmlOpenTag()
    {
        return $this->htmlOpenTag;
    }

    /**
     * @return mixed
     */
    public function getHtmlCloseTag()
    {
        return $this->htmlCloseTag;
    }

    /**
     * @return mixed
     */
    public function getBbOpenTag()
    {
        return $this->bbOpenTag;
    }

    function __construct($htmlOpenTag, $bbOpenTag, $htmlCloseTag, $bbCloseTag)
    {
        $this->htmlOpenTag = $htmlOpenTag;
        $this->bbOpenTag = $bbOpenTag;
        $this->htmlCloseTag = $htmlCloseTag;
        $this->bbCloseTag = $bbCloseTag;
    }

    /**
     * @param mixed $htmlOpenTag
     */
    public function setHtmlOpenTag($htmlOpenTag)
    {
        $this->htmlOpenTag = $htmlOpenTag;
    }

    /**
     * @param mixed $htmlCloseTag
     */
    public function setHtmlCloseTag($htmlCloseTag)
    {
        $this->htmlCloseTag = $htmlCloseTag;
    }

    /**
     * @param mixed $bbOpenTag
     */
    public function setBbOpenTag($bbOpenTag)
    {
        $this->bbOpenTag = $bbOpenTag;
    }

    /**
     * @param mixed $bbCloseTag
     */
    public function setBbCloseTag($bbCloseTag)
    {
        $this->bbCloseTag = $bbCloseTag;
    }
}