<?php
/**
 * Created by JetBrains PhpStorm.
 * User: v.romanovsky
 * Date: 21.06.13
 * Time: 16:44
 */

class Wrapper extends CWidget
{

    public $icon = null;
    public $widget = array();
    public $title = true;
    public $header = 'Grid';
    public $footer = false;
    public $pager = true;
    public $filter = null;
    public $attributes = null;
    public $footerElements = null;
    public $headerElements = array();
    public $headerElementsDefaults = array(
        'close'=>false,
        'optionsButtons'=>null
    );
    private $handler;
    public $close = false;
    /**
     * @var IDataProvider the data provider for the view.
     */
    public $dataProvider;
    private function headerConstructor(){
       $this->headerElements = array_merge($this->headerElementsDefaults,$this->headerElements);
    }
    public function init()
    {

        if (!empty($this->widget['filter'])) {
            $this->filter = $this->widget['filter'];
        }
        if (!empty($this->widget['dataProvider'])) {
            $this->dataProvider = $this->widget['dataProvider'];
        }

        if (!empty($this->widget['attributes'])) {
            $this->attributes = $this->widget['attributes'];
        }
        $this->headerConstructor();
        $this->renderHeader();


    }
    public function getWidget(){
        return $this->handler;
    }
    private function renderHeader()
    {
        $widget = $this->widget;
        echo "<div class='widget-box'>
                <div class='widget-title'>
                    <span class='icon'>
                        <i class='{$this->icon}'>
                        </i>
                    </span>

                    <h5>{$this->header}</h5>";
        if($this->headerElements['close']){echo "<button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>";}
        echo $this->headerElements['optionsButtons'];
          echo"
              </div>
              <div class='widget-content nopadding'>";
        switch ($widget['name']) {
            case 'grid':
                $this->handler = $this->beginWidget(
                    'zii.widgets.grid.CGridView',
                    array(
                        'id' => $widget['id'],
                        'dataProvider' => $widget['dataProvider'],
                        'filter' => $this->filter,
                        'cssFile' => Yii::app()->baseUrl . '/css/custom.css',
                        'columns' => $this->widget['columns'],
                        'template' => "{items}{pager}",
                        'summaryText' => 'Показано {start}-{end} из {count} результатов',
                        'pager' => $this->pager ?
                            array(
                                'class' => 'LinkPager',
                                'header' => '',
                                'cssFile' => Yii::app()->baseUrl . '/css/custom.css',

                            ) : '',
                        'htmlOptions' => array('class' => 'grid-view table table-striped table-hover data-table dataTable '),
                        'beforeAjaxUpdate' => 'js:function(id){gridAjaxUpdate(id)}',
                        'afterAjaxUpdate' => 'js:function(id){adapt_grid()}'
                    )
                );

                break;
            case 'detailView' :
                $this->handler = $this->beginWidget(
                    'zii.widgets.CDetailView',
                    array(
                        'id' => $widget['id'],
                        'data' => $widget['model'],
                        'attributes' => $this->attributes,
                        'cssFile' => Yii::app()->baseUrl . '/css/custom.css',
                        'itemTemplate' => "<tr class=\"{class}\"><td>{label}</td><td>{value}</td></tr>\n",
                        'htmlOptions' => array(
                            'class' => 'details details-bordered details-striped details-hover'
                        ),

                    )
                );
                break;
            case 'listView':
                $this->handler = $this->beginWidget(
                    'zii.widgets.CListView',
                    array(
                        'id' => $widget['id'],
                        'dataProvider' => $widget['dataProvider'],
                        'itemView' => $widget['itemView'],
                        'cssFile' => Yii::app()->baseUrl . '/css/custom.css',
                        'summaryText' => $widget['summaryText'],
                        'template' => "<span class=\"label label-info\" style='float: right;margin: 10px'>{summary}</span>{items}{pager}",
                        'pager' => $this->pager ?
                            array(
                                'class' => 'LinkPager',
                                'header' => '',
                                'cssFile' => Yii::app()->baseUrl . '/css/custom.css',
                                'htmlOptions' => array('style' => 'margin: 10px')
                            ) : null,
                        'emptyText' => '<span class="listview-empty-text">Нет результатов.</span>'
                    )
                );
                break;
            case 'activeForm':
              $this->handler = $this->beginWidget(
                    'CActiveForm',
                    array(
                        'id'=>$widget['id'],
                        'action' => !empty($widget['action']) ? $widget['action'] : '',
                        'htmlOptions' => CMap::mergeArray(array(
                            'class' => 'form form-horizontal',
                        ),!empty($widget['htmlOptions'])?$widget['htmlOptions']:array()),
                        'enableClientValidation' => true,
                        'clientOptions' => array(
                            'validateOnSubmit' => true,
                            'validateOnType' => true,
                            'afterValidate' => empty($widget['validateFunction']) ? 'js:renderErrorMessage' : $widget['validateFunction'],
                            'afterValidateAttribute' => 'js:renderAttributeErrorMessage'
                        )
                    )
                );

                break;
            case 'detailViewEditable':
                $this->handler = $this->beginWidget(
                    'editable.EditableDetailView',
                    array(
                        'id' => $widget['id'],
                        'data' => $widget['model'],
                        'url' => $widget['url'],
                        'emptytext' => !empty($widget['emptytext'])?$widget['emptytext']:"Не задан",
                        'attributes' => $this->attributes,
                        'cssFile' => Yii::app()->baseUrl . '/css/custom.css',
                        'itemTemplate' => "<tr class=\"{class}\"><td>{label}</td><td>{value}</td></tr>\n",
                        'htmlOptions' => array(
                            'class' => 'details details-bordered details-striped details-hover'
                        ),

                    )
                );
                break;
            default:
//                echo 'Параметр "widget" не передан';
                $content = $this->widget['emptyWidgetContent'];
                if (!is_object($content)) {
                    echo $content;
                } else {
                    $content;
                }
                break;

        }
    }

    public function run()
    {
        if (!empty($this->widget['name'])) {
            $this->endWidget();
        }
        $widget = $this->widget;
        if ($this->footer and $widget['name']) {
            echo '<div class="dataTables_wrapper" role="grid">
    <div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-bl ui-corner-br ui-helper-clearfix">';
            echo $this->footerElements;
            echo'
    </div>
</div>';

        }
        echo '</div></div>';

    }

}