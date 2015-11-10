<?php
/* @var $airport Airports */
/* @var $country Countries */
/* @var $this RequestsController */
/* @var $model Requests */
/* @var $wrapper Wrapper */

Yii::app()->clientScript->registerScript(
    'resetManager',
    '$(function(){
    var def
    $("#assignModal").on("show", function () {
      def = $("#s2id_Requests_user_id span").text();
      $("body").addClass("modal-open");
    }).on("hidden", function () {
      $("body").removeClass("modal-open")
    });
    $("button.close,a.hideModal").on("click", function(){
        $("#assignModal").modal("hide");
        $("#s2id_Requests_user_id span").text(def);
    });
    $("a.saveModal").on("click", function(){
    $("#assignModal").modal("hide");
    });
    })'
);
?>


<?php
$wrapper = $this->beginWidget(
    'Wrapper',
    array(
        'widget' => array(
            'name' => 'activeForm',
            'id' => 'requests-form',
        ),
        'header' => $this->header,
        'icon' => 'icon-th',
    )
);
/* @var $form CActiveForm */
$form = $wrapper->getWidget();
?>

<div id="assignModal" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Назначить менеджера</h3>
    </div>
    <div class="modal-body">
        <div class="control-group">
            <?php echo $form->labelEx($model, 'user_id', array('class' => 'control-label'))?>
            <div class="controls">
                <?php
                $records = Users::model()->findAll('role_id=:role_id',array(':role_id'=>1));
                $users = array();
                $userList[] = 'Без менеджера';
                foreach ($records as $user) {
                    $userList[$user->id] = $user->first_name . " " . $user->last_name;
                }
                echo $form->dropDownList(
                    $model,
                    'user_id',
                    $userList,
                    array(
                        'class' => 'chzn-select',
                        'data-placeholder' => 'Менеджер'
                    )
                )?>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn hideModal">Отмена</a>
        <a href="#" class="btn btn-primary saveModal">Применить</a>
    </div>
</div>

<div class="control-group">
    <?php echo $form->labelEx($model, 'first_name', array('class' => 'control-label'))?>
    <div class="controls">
        <?php
        echo $form->textField($model, 'first_name');
        echo $form->error($model, "first_name", array('hideErrorMessage' => true));
        ?>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx(
        $model,
        'last_name',
        array(
            'class' => 'control-label'
        )
    )?>
    <div class="controls">
        <?php
        echo $form->textField($model, 'last_name');
        echo $form->error($model, "last_name", array('hideErrorMessage' => true));
        ?>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx(
        $model,
        'email',
        array(
            'class' => 'control-label'
        )
    )?>
    <div class="controls">
        <?php
        echo $form->textField($model, 'email');
        echo $form->error($model, "email", array('hideErrorMessage' => true));
        ?>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx(
        $model,
        'phone',
        array(
            'class' => 'control-label'
        )
    )?>
    <div class="controls">
        <?php
        echo $form->textField($model, 'phone');
        echo $form->error($model, "phone", array('hideErrorMessage' => true));
        ?>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx(
        $model,
        'comment',
        array(
            'class' => 'control-label'
        )
    )?>
    <div class="controls">
        <?php
        echo $form->textArea($model, 'comment');
        ?>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model, 'requestCountries', array('class' => 'control-label'))?>
    <div class="controls">
        <select class="chzn-select" style="width: 81%" id="Requests_requestCountries"
                data-placeholder="Выберите страну/курорт..." multiple
                name="Requests[requestCountries][]">
            <?php
            $countries = Countries::model()->findAll();
            foreach ($countries as $country):?>
                <option value="<?php echo  $country->id ?>" <?php
                    if (RequestCountries::model()->findByAttributes(
                        array('country_id' => $country->id, 'request_id' => $model->id)
                    )
                    ) {
                        echo 'selected';
                    }?> >
                    <?php echo $country->title?>
                </option>
            <?php endforeach?>
        </select>
        <?php
        echo $form->error($model, "requestCountries", array('hideErrorMessage' => true));
        ?>
    </div>
</div>
<div class="row-fluid control-group">
    <?php echo $form->labelEx($model, 'date_departure', array('class' => 'control-label'))?>
    <div class="controls">
        <div class="input-prepend" id="date-departure">
                        <span class="add-on" style="width: 30px">
                            <i class="icon-calendar"></i>
                        </span>
            <?php
            echo $form->telField(
                $model,
                'date_departure',
                array('class' => 'juiDate', 'placeholder' => 'Заезд')
            );
            echo $form->error($model, "date_departure", array('hideErrorMessage' => true));
            ?>
        </div>
        <div class="input-prepend" id="date-return">
                        <span class="add-on" style="width: 30px">
                            <i class="icon-calendar"></i>
                        </span>
            <?php
            echo $form->telField($model, 'date_return', array('class' => 'juiDate', 'placeholder' => 'Выезд'));
            echo $form->error($model, "date_return", array('hideErrorMessage' => true));
            ?>
        </div>


    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model, 'duration', array('class' => 'control-label'))?>
    <div class="controls">
        <div class="input-prepend">
            <span class="add-on"  style="width: 28px">дн. </span>
            <?php
            echo $form->textField($model, 'duration');
            echo $form->error($model, "duration", array('hideErrorMessage' => true));
            ?>
        </div>
        <div class="slider" id="duration"></div>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model, 'requestAirports', array('class' => 'control-label'))?>
    <div class="controls" id="request-airports">
        <?php
        $airports = Airports::model()->findAll();
        ?>
        <select class="chzn-select" id="Requests_requestAirports" data-placeholder="Выберите место..." multiple
                style="width: 81%" name="Requests[requestAirports][]">
            <?php
            foreach ($airports as $airport):?>
                <option value="<?php echo  $airport->id ?>" <?php
                    if (RequestAirports::model()->findByAttributes(
                        array('airport_id' => $airport->id, 'request_id' => $model->id)
                    )
                    ) {
                        echo 'selected';
                    }?> >
                    <?php echo  $airport->title ?>
                </option>
            <?php endforeach ?>
        </select>
        <?php
        echo $form->error($model, "requestAirports", array('hideErrorMessage' => true));
        ?>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model, 'Взрослых/Детей *', array('class' => 'control-label'))?>
    <div class="controls" id="children-age">
        <?php echo $form->telField(
            $model,
            'adults',
            array(
                'class' => 'cSpinner',
                'style' => 'width: 38px; float: left;',
            )
        );
        echo $form->error($model, "adults", array('hideErrorMessage' => true));
        echo $form->telField(
            $model,
            'children',
            array(
                'class' => 'cSpinner',
                'style' => 'width: 38px; float: left;',

            )
        )?>
        <?php
        if ($model->child_age != null) {
            $model->child_age = explode(';', $model->child_age);
        } else {
            $model->child_age = array();
        }
        for ($i = 0; $i < count($model->child_age); $i++) {
            echo $form->telField($model, "child_age[$i]", array('class' => 'child-age span1', 'placeholder' => 'Возраст', 'style' => 'margin-right:10px; ',));
        }
        ?>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model, 'budget', array('class' => 'control-label'))?>
    <div class="controls">
        <div class="input-prepend">
            <span class="add-on">до $</span>
            <?php
            echo $form->textField($model, 'budget');
            echo $form->error($model, "budget", array('hideErrorMessage' => true));
            ?>

        </div>
        <div id="money" class="slider"></div>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model, 'category', array('class' => 'control-label'))?>
    <div class="controls">
        <div class="input-prepend">
            <span class="add-on" style="width: 28px"><i class="icon-star"></i></span>
            <?php
            echo $form->textField($model, 'category');
            echo $form->error($model, "category", array('hideErrorMessage' => true));
            ?>
        </div>
        <div id="category" class="slider"></div>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model, 'pension_type', array('class' => 'control-label'))?>
    <div class="controls">
        <?php echo $form->dropDownList(
            $model,
            'pension_type',
            array('Всё включено', 'Только завтраки', 'Двухразовое', 'Трёхразовое'),
            array(
                'class' => 'chzn-select',
                'data-placeholder' => 'Выберите тип...'
            )
        )?>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model, 'params', array('class' => 'control-label'))?>
    <div class="controls">
        <?php
        if (!is_array($model->params) and !empty($model->params)) {
            $model->params = explode(',', $model->params);
        }
        ?>
        <ul style="width: 100%; list-style: none">
            <?php echo $form->checkBoxList(
                $model,
                'params',
                array(
                    '1-я береговая линия',
                    'Центр курортной зоны',
                    'Корты',
                    'Для семей с детьми',
                    'Wifi internet',
                    'Сауна',
                    'Ночная жизнь',
                    'Анимация для взрослых',
                    'Водные горки',
                    'Анимация для детей'
                ),
                array(
                    'separator' => '',
                    'template' => '<li class="params-list">{input}&nbsp;{label}</li>'
                )
            )?>
        </ul>
    </div>

</div>

<div class="control-group">
    <?php echo $form->labelEx($model, 'date_next_step', array('class' => 'control-label'))?>
    <div class="controls">
        <div class="input-prepend">
                        <span class="add-on" style="width: 30px">
                            <i class="icon-calendar"></i>
                        </span>
            <?php
            echo $form->telField(
                $model,
                'date_next_step',
                array('class' => 'juiDate', 'placeholder' => '')
            );
            echo $form->error($model, "date_next_step", array('hideErrorMessage' => true));
            ?>
        </div>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model, 'description_next_step', array('class' => 'control-label'))?>
    <div class="controls">
        <?php
        echo $form->textArea($model, 'description_next_step');
        echo $form->error($model, "description_next_step", array('hideErrorMessage' => true));
        ?>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model, 'status', array('class' => 'control-label'))?>
    <div class="controls">
        <?php echo $form->dropDownList(
            $model,
            'status',
            $model->getStatus(),
            array(
                'class' => 'chzn-select',
                'data-placeholder' => 'Укажите статус...'
            )
        )?>
    </div>
    <div class="control-group">
        <div class="controls">
            <?php echo CHtml::submitButton(
                $model->isNewRecord ? 'Создать' : 'Сохранить',
                array(
                    'class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success'
                )
            ); ?>
        </div>
    </div>

<?php $this->endWidget(); ?>



<script type="text/javascript">
    $(document).ready(function () {
        $('#Requests_requestCountries').change(function () {
            $('.select2-choices').resize(function () {
                tooltipPlacement();
            })
        });
        $('.select2-search-field').css('width','250px');
        $("#category").slider({
            range: "min",
            min: 1,
            max: 5,
            value: <?php if($model->isNewRecord) {echo 3;
} else {echo $model->category;
}?>,
            step: 1,
            animate: "fast",
            slide: function (event, ui) {
                $("#Requests_category").val(ui.value + "");
            }
        });
        $("#Requests_category").val($("#category").slider("value"));

        $("#money").slider({
            range: "min",
            min: 100,
            max: 10000,
            value:<?php if($model->isNewRecord) {echo 500;
} else {echo $model->budget;
}?>,
            step: 50,
            animate: "slow",
            slide: function (event, ui) {
                $("#Requests_budget").val(ui.value);
            }
        });
        $("#Requests_budget").val($("#money").slider("value"));

        $("#duration").slider({
            range: true,
            min: 1,
            max: 21,
            values: <?php if($model->isNewRecord) {echo '[7,14]';
} else {echo '['.str_replace('-',',',$model->duration).']';
}?>,
            animate: "fast",
            slide: function (event, ui) {
                $("#Requests_duration").val(ui.values[ 0 ] + "-" + ui.values[ 1 ]);
            }
        });
        $("#Requests_duration").val($("#duration").slider("values", 0) + "-" + $("#duration").slider("values", 1));

    })

</script>

