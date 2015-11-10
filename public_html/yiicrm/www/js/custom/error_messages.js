function renderErrorMessage(form, data, hasError) {
    if (hasError) {
        for (var i in data) {
            $("#" + i).addClass("error_input");
            $(document).ready(function () {
                    var placement;
                    if (form.width() > 800 || $('div.modal')) {
                        placement = 'right';
                    } else {
                        placement = 'top';
                    }

                    if ($('#' + i).hasClass('chzn-select')) {
                        $('#s2id_' + i).tooltip({"placement": placement, "trigger": "manual", "title": data[i]}).tooltip('show');
                    } else {
                        $("#" + i).tooltip({"placement": placement, "trigger": "manual", "title": data[i]}).tooltip('show');
                    }
                    $('.tooltip').css('visibility', 'hidden');
                    $('.tooltip').addClass('tooltip-custom');
                    $('.tooltip.right').addClass('tooltip-custom-width').children('.tooltip-arrow').css('top', '50%');
                    showErrorMessage(data[i]);
                }
            );
        }
        return false;
    }
    else {
        form.children().removeClass("error_input");
        $(form.children()).tooltip("hide");
        if ($('#Orders_price:not(error_input)')) {
            $('#Orders_amount_paid').removeClass('error_input');
            $('#Orders_amount_paid').tooltip('hide');
        }
        return true;
    }
}
function renderAttributeErrorMessage(form, attribute, data, hasError) {
    if (hasError || $("#" + attribute.id + '_temporal').hasClass("error")) {
        $("#" + attribute.id).addClass("error_input");
                var placement;
                if (form.width() > 800 || $('div.modal')) {
                    placement = 'right';
                } else {
                    placement = 'top';
                }
                if($("#"+attribute.id).hasClass('chzn-select')){
                    $("#s2id_" + attribute.id).tooltip({"placement": placement, "trigger": "manual", "title": data[attribute.id]});
                }else{
                    $("#" + attribute.id).tooltip({"placement": placement, "trigger": "manual", "title": data[attribute.id]});
                }
                showAttributeErrorMessage(attribute.id,data[attribute.id])
    }
    else {
        $("#" + attribute.id).removeClass("error_input").tooltip('hide');
        $("#s2id_" + attribute.id).removeClass('error_input').tooltip('hide');
        if ($('#Orders_price:not(error_input)')) {
            $('#Orders_amount_paid').removeClass('error_input');
            $('#Orders_amount_paid').tooltip('hide');
        }
    }
}
function showErrorMessage(tooltipTitle) {
    $('.controls').find(':input').each(function () {
        var id = $(this).attr('id');
        if (typeof id !== "undefined") {

            var temporal_id = $(this).parent().prop('id', $(this).attr('id') + "_temporal").attr('id');
            var tooltipSelector = '#' + temporal_id + ' .tooltip';

            $('#' + id).live("focusin",function () {
                $('#' + temporal_id + ' .tooltip').css('visibility', 'visible');
                $('#' + temporal_id + ' .tooltip'+'.top').css('top', ($('#' + id).position().top - $('#' + temporal_id + ' .tooltip').height() - 10));
            }).live("focusout", function () {
                    $('#' + temporal_id + ' .tooltip').css('visibility', 'hidden');
                });
            if ($('#' + id).hasClass('chzn-select')) {
                $('#' + temporal_id + ' select').on('open',function () {
                    if ($("#" + id).hasClass("error_input")) {
                        $('#' + temporal_id + ' .tooltip').css('visibility', 'visible');
                    }
                }).on('close', function () {
                        $('#' + temporal_id + ' .tooltip').css('visibility', 'hidden');
                    })
            }
        }
    });
}
function showAttributeErrorMessage(id, tooltipTitle) {
    var timer;
    var tooltipSelector = '#' + id + '_temporal .tooltip';

    $('#' + id).live("focus focusin blur keyup",function () {
        if ($("#" + id).hasClass("error_input")) {
            clearInterval(timer);
            timer = setTimeout(function () {
                $('#' + id).attr('data-original-title', tooltipTitle).tooltip('fixTitle').tooltip('show');
                $(tooltipSelector).css('visibility', 'visible')
                $('.tooltip').addClass('tooltip-custom');
                $('.tooltip.right').addClass('tooltip-custom-width').children('.tooltip-arrow').css('top', '50%');
                $(tooltipSelector+'.top').css('top', ($('#' + id).position().top - $(tooltipSelector).height() - 10));
            }, 300);
        }
    }).live("focusout", function () {
            clearInterval(timer);
            timer = setTimeout(function () {
                $("#" + id).tooltip('hide');
                $(tooltipSelector).css('visibility', 'hidden')
            });
        });

    if ($('#' + id).hasClass('chzn-select')) {
        $('#' + id + '_temporal select').on('open',function () {
            if ($("#" + id).hasClass("error_input")) {
                $("#s2id_" + id).tooltip('show');
                $(tooltipSelector).css('visibility', 'visible')
            }
        }).on('close', function () {
                $("#s2id_" + id).tooltip('hide');
                $(tooltipSelector).css('visibility', 'hidden')
            })
    }
}

function tooltipPlacement() {
    $('.controls').find(':input').each(function () {
        var id = $(this).attr('id');
        if (typeof id !== "undefined") {
            var temporal_id = $(this).parent().prop('id', $(this).attr('id') + "_temporal").attr('id');
            $("#" + temporal_id + ' .tooltip.right').css({
                'top': $('#' + id + ',' + '#s2id_' +id).position().top,
                'left': $("#" + id + ',' + '#s2id_' + id).position().left + $('#' + id + ',' + '#s2id_' + id).outerWidth()
            });

            $("#" + temporal_id + ' .tooltip.top').css({
                'top': $('#' + id).position().top - $("#" + temporal_id + ' .tooltip').height() - 10,
                'left': $("#" + id).position().left + $('#' + id).outerWidth() / 2 - $('#' + temporal_id + ' .tooltip.top').outerWidth() / 2
            });
            $('#' + temporal_id + ' .tooltip.left').css('top', $('#' + id).position().top);

        }
    })
}

function customRenderErrorMessage(form, data, hasError) {
    var $form = $(form[0]);
    if (renderErrorMessage(form, data, hasError)) {
        $.ajax({
            beforeSend: function () {
                $('.global-modal').prepend(
                    $('<div/>').css({
                            'position': 'absolute',
                            'height': $('.global-modal').height(),
                            'width': $('.global-modal').width(),
                            'background-color': 'black',
                            'opacity': 0.4,
                            'z-index': '1000'
                        }
                    )
                ).spin('large');
            },
            type: 'post',
            url: $form.attr('action'),
            data: $form.serialize(),
            success: function (response) {
                if (response == '1') {
                    $.fn.yiiGridView.update($form.data('grid-name'), {
                        'url': $form.data('grid-route')
                    });
                }
                $(".global-modal").modal('hide');
            }
        });
        return false;
    } else {
        return false;
    }
}
