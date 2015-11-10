<?php
/**
 * @var $this AttachmentsWidget
 */
?>
<div class="row-fluid">
    <?php if(!$this->inForm):?>
    <form id="fileupload" action="<?php echo Yii::app()->createUrl('backend/dashboard/upload') ?>" method="POST" enctype="multipart/form-data">
    <?php endif?>
        <div class="fileupload-buttonbar">
            <div>
                <span class="btn btn-small btn-success fileinput-button">
                    <i class="icon-plus icon-white"></i>
                    <span>Добавить файлы...</span>
                    <input type="file" name="files[]" multiple>
                </span>
                <button type="submit" class="btn btn-small btn-primary start">
                    <i class="icon-upload icon-white"></i>
                    <span>Начать загрузку</span>
                </button>
                <button type="reset" class="btn btn-small btn-warning cancel">
                    <i class="icon-ban-circle icon-white"></i>
                    <span>Отменит загрузку</span>
                </button>
                <button type="button" class="btn btn-small btn-danger delete">
                    <i class="icon-trash icon-white"></i>
                    <span>Удалить</span>
                </button>
                <input type="checkbox" id='remove-all' class="toggle" title="Удалить все">
                <span class="fileupload-process"></span>
            </div>
            <div class="fileupload-progress fade">
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="bar bar-success" style="width:0%;"></div>
                </div>
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <table role="presentation" class="table table-striped">
            <tbody class="files"></tbody>
        </table>
        <?php if(!$this->inForm):?>
        </form>
        <?php endif?>
</div>
<script id="template-upload" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-error"></strong>
        </td>

        <td>
            <div class="size">Processing...</div>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"
                 aria-valuenow="0">
                <div class="bar bar-success" style="width:0%;"></div>
            </div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
            <button class="btn btn-small btn-primary start" disabled>
                <i class="icon-upload icon-white"></i>
                <span>Загрузить</span>
            </button>
            {% } %}
            {% if (!i) { %}
            <button class="btn btn-small btn-warning cancel">
                <i class="icon-ban-circle icon-white"></i>
                <span>Отмена</span>
            </button>
            {% } %}
        </td>
    </tr>
    {% } %}
</script>
<script id="template-download" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <p class="name">
                {% if (file.url) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}"
                {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
            <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
            <button class="btn btn-small btn-danger delete" data-type="{%=file.deleteType%}"
                    data-url="{%=file.deleteUrl%}"
            {% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
            <i class="icon-trash icon-white"></i>
            <span>Удалить</span>
            </button>
            <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
            <button class="btn btn-small btn-warning cancel">
                <i class="icon-ban-circle icon-white"></i>
                <span>Отмена</span>
            </button>
            {% } %}
        </td>
    </tr>
    {% } %}
</script>
<?php
$cs = Yii::app()->clientScript;
$cs->registerScriptFile("http://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js");
$cs->registerScript(
    'fileUploader',
    "
    jQuery(function () {
        'use strict';
        var url = '". Yii::app()->createUrl('backend/attachments/upload', array('owner' => $this->model->getPrimaryKey(), 'type' => get_class($this->model)))."';
        var form = '".$this->form."'
        $('#'+form).fileupload({
            url: url
        });
        $('#'+form).addClass('fileupload-processing');
        $.ajax({
            url: url,
            dataType: 'json',
            context: $('#'+form)[0]
        }).always(function () {
                $(this).removeClass('fileupload-processing');
            }).done(function (result) {
                $(this).fileupload('option', 'done')
                    .call(this, $.Event('done'), {result: result});
            });
    });
    ", CClientScript::POS_END
);
?>
