function getModalForm(btn) {
    var $btn = $(btn);
    var text = $btn.text();
    $.ajax({
        beforeSend: function () {
            $btn.css('height', $btn.height()).text('').spin('small');
        },
        url: $btn.data('get-form'),
        success: function (response) {
            $('.global-modal').html(response).modal('show');
            $btn.spin().text(text);
        }
    })
}

function updateModalForm(lnk) {
    var $lnk = $(lnk);
    var $icon = $($lnk[0].children[0]);
    var ic_class = $icon.attr('class');
    $.ajax({
        beforeSend: function () {
            $icon.removeClass(ic_class).addClass('icon-spin').spin('tiny');
        },
        url: $lnk.attr("href"),
        success: function (response) {
            $(".global-modal").html(response).modal();
            $icon.spin(false).removeClass('icon-spin').addClass(ic_class);
        }
    });
    return false;
}

(function ($) {
    $.fn.spin = function (opts, color) {
        var presets = {
            "tiny": { lines: 8, length: 2, width: 2, radius: 3 },
            "small": { lines: 8, length: 4, width: 3, radius: 5 },
            "large": { lines: 10, length: 8, width: 4, radius: 8 }
        };
        if (Spinner) {
            return this.each(function () {
                var $this = $(this),
                    data = $this.data();

                if (data.spinner || opts == null) {
                    data.spinner.stop();
                    delete data.spinner;
                }
                if (opts !== false) {
                    if (typeof opts === "string") {
                        if (opts in presets) {
                            opts = presets[opts];
                        } else {
                            opts = {};
                        }
                        if (color) {
                            opts.color = color;
                        }
                    }
                    data.spinner = new Spinner($.extend({color: $this.css('color')}, opts)).spin(this);
                }
            });
        } else {
            throw "Spinner class not available.";
        }
    };
})(jQuery);

function gridAjaxUpdate(id){
    $('#'+id+' .items tbody').css('opacity',.5).spin('large');
}

$(document).ready(function(){
    $('#requests-form input[type=checkbox],#requests-form input[type=radio],#requests-form input[type=file]').uniform();
    $('#Requests_adults').spinner({
        min: 0,
        max: 5,
        editable: false,
        create: function () {
            if ($(this).val() == "")
                $(this).val(0);
        }
    });

    $('#Requests_children').spinner({
        min: 0,
        max: 5,
        editable: false,
        create: function () {
            if ($(this).val() == "") {
                $(this).val(0);
            }
        }
    }).bind('spin spinchange', function (event, ui) {
            var errTooltip = $("#children-age .tooltip");
            if ($(this).val() < ui.value) {
                $("#children-age .tooltip").remove();
                $('#children-age').append(
                    $('<input/>',{
                            type: 'tel',
                            'id':'Requests_child_age_' + (ui.value - 1),
                            'placeholder':'Возраст',
                            'class':'child-age span1',
                            'style':'margin-right:10px',
                            'name':'Requests[child_age][' + (ui.value - 1) + ']'
                        }
                    )
                );
                if (errTooltip.length != 0) {
                    $(".child-age :last").tooltip({"placement": "right", "trigger": "manual", "title": "От 1-го до 17-ти лет"}).tooltip('show');
                }
            } else if (ui.value < $(this).val()) {

                $("#children-age .tooltip").remove();
                $(".child-age :last").remove();
                if (errTooltip.length != 0) {
                    $(".child-age :last").tooltip({"placement": "right", "trigger": "manual", "title": "От 1-го до 17-ти лет"}).tooltip('show');
                }
            }
        });

    $("#requests-form").submit(function () {
        var inp = $("[name*=child_age]");
        $.each(inp, function (key, value) {
            if ($(value).css('display') == 'none')
                $(value).remove();
        });
    });

    $(".juiDate").datepicker({
        dateFormat: 'dd.mm.yy'
    });

    $('.cSpinner').spinner({
        max: 5,
        min: 0
    });

    $('#requests-form .chzn-select').select2();

    $("[name*=child_age]").live('change', function () {
        if ($.hasError()) {
            $("[name*=child_age]").last().tooltip({"placement": "right", "trigger": "manual", "title": "От 1-го до 17-ти лет"}).tooltip('show');
        } else {
            $("[name*=child_age]").last().tooltip('hide');
            return true;
        }
    });

    $('#requests-form :submit').live('click', function () {
        if ($.hasError()) {
            $("[name*=child_age]").last().tooltip({"placement": "right", "trigger": "manual", "title": "От 1-го до 17-ти лет"}).tooltip('show');
            return false;
        }
    });

    $.hasError = function(){
        var hasError = false;
        $.each($("[name*=child_age]"), function (i, o) {

            if ($(o).val() > 17 || $(o).val() < 1 || !$.isNumeric($(o).val()) || $(o).val()[0] == 0)
                hasError = true;
        });
        return hasError;
    };
});
