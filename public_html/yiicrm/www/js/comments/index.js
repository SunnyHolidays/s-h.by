
function addComment(selectors,url)
{
    $(selectors['addButton']).live('click', function () {
        $(selectors['cancelButton']).css('display','none');
        $('.save').removeClass('save').addClass(selectors['updateButton']).html('Редактировать');
        $(selectors['parentForm']).remove();
        $.ajax({
            type: 'post',
            url: url,
            success: function (response) {
                $(selectors['form']).html(response);
            }
        })
    });
}

function deleteComment(selectorDeleteButton,selectorListView,url)
{
    $(selectorDeleteButton).live('click', function () {
        $.ajax({
            type: 'post',
            url: url + $(this).attr('id').replace('dit_', ''),
            success: function (response) {
                $.fn.yiiListView.update(selectorListView);
            }
        })
    });
}

function updateComments(selectors,url,params)
{
    $('.'+selectors['updateButton']).live('click', function () {
        $(selectors['parentForm']).remove();
        $('.save').removeClass('save').addClass(selectors['updateButton']).html('Редактировать');
        var id = $(this).attr('id').replace('eit_', '');
        $.ajax({
            type: 'post',
            url: url + id +
                '&order_id=' + params['order_id'] +
                '&request_id=' + params['request_id'] +
                '&controller=' + params['controller'],
            success: function (response) {
                $('.editcomment_' + id).html(response);
                $('#eit_' + id).removeClass(selectors['updateButton']).addClass("save").html('Обновить');
                $('#cit_' + id).css('display', 'inline-block');
            }
        })
    });
}

function saveComment(selectorForm,idListView,url,urlUpdate)
{
    $(".save").live('click', function () {
        var id = $(this).attr('id').replace('eit_', '');
        $.ajax({
            type: 'post',
            url: url + id,
            data: $(selectorForm).serialize(),
            success: function (response) {
                $.fn.yiiListView.update('requests-view', {'url': urlUpdate});
            }
        })
    });
}

function cancelForm(selectors,urlUpdate)
{
    $(selectors['cancelButton']).on('click', function () {
        $(selectors['parentForm']).remove();
        $(selectors['cancelButton']).css('display', 'none');
        $('.save').removeClass('save').addClass(selectors['updateButton']).html('Редактировать');
    })
}
