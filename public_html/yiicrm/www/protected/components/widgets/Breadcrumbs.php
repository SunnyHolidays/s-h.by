<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Frost
 * Date: 19.06.13
 * Time: 18:34
 */

class Breadcrumbs extends CWidget
{
    public $tagName = 'div';
    public $htmlOptions = array('id' => 'breadcrumb');
    public $encodeLabel = true;
    public $homeLink;
    public $links = array();
    public $activeLinkTemplate = '<a href="{url}">{label}</a>';
    public $activeLinkTemplateLast = '<a href="{url}" class="current" >{label}</a>';
    public $inactiveLinkTemplate = '<a>{label}</a>';
    public $inactiveLinkTemplateLast = '<a href="#" class="current" >{label}</a>';

    public function run()
    {
        if (empty($this->links)) {
            return;
        }

        echo CHtml::openTag($this->tagName, $this->htmlOptions) . "\n";
        $links = array();
        if ($this->homeLink === null) {
            $links[] = CHtml::link(
                '<i class="icon-home"></i>Home',
                array('/backend/'),
                array('class' => "tip-bottom")
            );
        } elseif ($this->homeLink !== false) {
            $links[] = $this->homeLink;
        }

        foreach ($this->links as $label => $url) {
            if (!is_array($label) and is_array($url)) {
                if ($url == end($this->links)) {
                    $links[] = CHtml::link($label, $url, array('class' => "current"));
                } else {
                    $links[] = CHtml::link($label, $url);
                }
            } elseif (!is_array($label)) {
                if ($url == end($this->links)) {
                    $links[] = CHtml::link($url, '#', array('class' => "current"));
                } else {
                    $links[] = CHtml::link($url);
                }

            }
        }
        echo implode('', $links);
        echo CHtml::closeTag($this->tagName);
    }
}