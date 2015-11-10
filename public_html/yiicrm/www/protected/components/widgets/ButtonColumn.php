<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Frost
 * Date: 01.07.13
 * Time: 12:43
 */

class ButtonColumn extends CButtonColumn
{  public $deleteConfirmation='Вы уверены, что хотите удалить этот элемент?';
    protected function renderButton($id, $button, $row, $data)
    {
        if (isset($button['visible']) && !$this->evaluateExpression(
            $button['visible'],
            array('row' => $row, 'data' => $data)
        )
        ) {
            return;
        }
        $label = isset($button['label']) ? $button['label'] : $id;
        $url = isset($button['url']) ? $this->evaluateExpression(
            $button['url'],
            array('data' => $data, 'row' => $row)
        ) : '#';
        $options = isset($button['options']) ? $button['options'] : array();
        if (!isset($options['title'])) {
            $options['title'] = $label;
        }
        if(isset($button['icon']) && is_string($button['icon'])){
            echo CHtml::link('<i class="'.$button['icon'].'"></i>', $url, $options);
        }
        elseif (isset($button['imageUrl']) && is_string($button['imageUrl'])) {
            echo CHtml::link(CHtml::image($button['imageUrl'], $label), $url, $options);
        } else {
            echo CHtml::link($label, $url, $options);
        }
    }
}