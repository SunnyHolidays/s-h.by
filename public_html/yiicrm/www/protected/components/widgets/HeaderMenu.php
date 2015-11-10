<?php
/**
 * Created by JetBrains PhpStorm.
 * User: v.romanovsky
 * Date: 28.06.13
 * Time: 18:04
 */
Yii::import('zii.widgets.CMenu');

class HeaderMenu extends CMenu
{
    public $items = array();

    protected function renderMenu($items)
    {
        if (count($items)) {
            echo CHtml::openTag('div', $this->htmlOptions) . "\n";
            $this->renderMenuRecursive($items);
            echo CHtml::closeTag('div');
        }
    }

    protected function renderMenuRecursive($items)
    {
        $count = 0;
        $n = count($items);
        foreach ($items as $item) {
            $count++;
            $options = isset($item['itemOptions']) ? $item['itemOptions'] : array();
            $class = array();
            if ($item['active'] && $this->activeCssClass != '') {
                $class[] = $this->activeCssClass;
            }
            if ($count === 1 && $this->firstItemCssClass !== null) {
                $class[] = $this->firstItemCssClass;
            }
            if ($count === $n && $this->lastItemCssClass !== null) {
                $class[] = $this->lastItemCssClass;
            }
            if ($this->itemCssClass !== null) {
                $class[] = $this->itemCssClass;
            }
            if ($class !== array()) {
                if (empty($options['class'])) {
                    $options['class'] = implode(' ', $class);
                } else {
                    $options['class'] .= ' ' . implode(' ', $class);
                }
            }


            $menu = $this->renderMenuItem($item);
            if (isset($this->itemTemplate) || isset($item['template'])) {
                $template = isset($item['template']) ? $item['template'] : $this->itemTemplate;
                echo strtr($template, array('{menu}' => $menu));
            } else {
                echo $menu;
            }

        }
    }

    protected function renderMenuItem($item)
    {
        $label = $this->linkLabelWrapper === null ? $item['label'] : CHtml::tag(
            $this->linkLabelWrapper,
            $this->linkLabelWrapperHtmlOptions,
            $item['label']
        );
        $item['linkOptions']['class'] = 'btn btn-large tip-bottom';
        $item['linkOptions']['data-original-title'] = $label;
        return CHtml::link(
            '<i class="' . $item['icon'] . '"></i>',
            $item['url'],
            isset($item['linkOptions']) ? $item['linkOptions'] : array()
        );

    }
}