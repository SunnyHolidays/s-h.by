/**
 *
 * @param currencies
 * @param update_url
 */
$.order_math_editable = function(currencies, update_url){
    var am_p_val = $('#amount_paid-value'),
        disc_cur = $('#discount-currency'),
        disc = $('#discount-value'),
        pr = $('#price-value'),
        pr_c = $('.price-currency');
    var am_p_data = function(){ return {
        url: update_url,
        data: {
            name: 'amount_paid',
            pk: am_p_val.attr('data-pk'),
            scenario: 'update',
            value: am_p_val.editable('getValue', true)
        }
    };
    };
    var calc_perc = function(pr, disc){
        am_p_val.editable('setValue', (pr - (pr / 100 * disc))).editable('submit', am_p_data());
    };
    var calc = function(pr,disc){
        am_p_val.editable('setValue', (pr - disc)).editable('submit', am_p_data());
    };
    pr_c.on('save', function (e, params) {
        pr_c.each(function() {
            pr_c.editable('setValue', params.newValue);
        });
        var title = currencies[params.newValue];
        var currency = {0: '%'};
        currency[params.newValue] = title;
        disc_cur.editable('option', 'source', currency);
        if (disc_cur.editable('getValue', true) != 0) {
            disc_cur.editable('setValue', params.newValue).editable('submit', {
                url: update_url,
                data: {
                    name: 'discount_currency_id',
                    pk: disc_cur.attr('data-pk'),
                    scenario: 'update',
                    value: params.newValue
                }
            });
        }
    });

    disc_cur.on('save', function (e, params) {
        var price = pr.editable('getValue', true);
        var discount = disc.editable('getValue', true);
        if (disc_cur.editable('getValue', true) != 0) {
            calc_perc(price, discount);
        }else {
            calc(price, discount);
        }
    });

    pr.on('save', function (e, params) {
        var price = params.newValue;
        var discount = disc.editable('getValue', true);
        if (disc_cur.editable('getValue', true) == 0) {
            calc_perc(price, discount);
        }else {
            calc(price, discount);
        }
    });
    disc.on('save', function (e, params) {
        var price = pr.editable('getValue', true);
        var discount = params.newValue;
        if (disc_cur.editable('getValue', true) == 0) {
            calc_perc(price, discount);
        }else {
            calc(price, discount);
        }
    });
    am_p_val.on('save', function (e, params) {
        var price_currency = pr_c.editable('getValue', true);
        var price = pr.editable('getValue', true);
        var amount_paid = params.newValue;
        if (disc_cur.editable('getValue', true) == 0) {
            disc_cur.editable('setValue',price_currency).editable('submit', {
                url: update_url,
                data: {
                    name: 'discount_currency_id',
                    pk: disc_cur.attr('data-pk'),
                    scenario: 'update',
                    value: price_currency
                }
            });
        }
        disc.editable('setValue', (price - amount_paid)).editable('submit', {
            url: update_url,
            data: {
                name: 'discount',
                pk: disc.attr('data-pk'),
                scenario: 'update',
                value: disc.editable('getValue', true)
            }
        });
    });

    $('.editable-click:not(.without-search)').live('click', function () {
        $('select').select2();
    });

    $('.without-search').live('click', function () {
        $('select').select2({
            minimumResultsForSearch: 99
        });

    });

    $.createHotelsList = function(json){
        var res = [];
        $.each(json, function(i, e){
            res.push({id:i, text:e});
        });
        return res;
    };
    $.updateEditableList = function (new_key, selector, depend, fk, url) {
        $.ajax({
            beforeSend: function () {
                if ($.isArray(selector)) {
                    $.each(selector, function(i,el){
                        $.insertSpinner(el);
                    });
                } else {
                    $.insertSpinner(selector);
                }
            },
            url: url,
            data: {"id": new_key, "depend": depend, "key": fk},
            success: function (response) {
                var src = $.isEmptyObject($.parseJSON(response)) ? [[]] : $.createHotelsList($.parseJSON(response));
                if ($.isArray(selector)) {
                    $.each(selector, function (i, e) {
                        $(e).editable('option', 'source', [[]]);
                        $(e).editable('setValue', null);
                    });
                    $(selector[0]).editable('option', 'source', src );
                } else {
                    $(selector).editable('option', 'source', src);
                    $(selector).editable('setValue', null);
                }
                $('.spinner').remove();
            }
        });
    };
    var regions, hotelEditable, h_id, r_id;
    $.insertSpinner = function (selector) {
        $("<img class='spinner' src='img/loading.gif'>").insertAfter(selector);
    };
    $.fillSource = function(edit, sel){
        var src = edit.options.source;
        edit.container.options.input.sourceData = src;
        var opt = edit.input.options.select2;
        opt.data = src;
        $(sel).select2(opt);
    };
    $.saveSource = function(edit, r, sel){
        var resp = $.parseJSON(r.response);
        var pk = r.newValue;
        if (!$.isEmptyObject(resp)) {
            var src = edit.options.source;
            src.push(resp);
            $(sel).editable('option', 'source', src);
            pk = resp.id;
        }
        return pk;
    };
    $('a[rel^="EditableField_region_id_"]')
        .on('init', function (e, edit) {
            regions = edit;
        }).on('shown', function (e, edit) {
            if (arguments.length == 1) {
                $.fillSource(regions, '.chzn-regions');
            }
        }).on('save', function (e, r) {
            r_id = $.saveSource(regions, r, 'a[rel^="EditableField_region_id_"]');
        }).on('hidden', function (e, reason) {
            if (reason === 'save') {
                $(this).editable('setValue', r_id);
            }
        });
    $('a[rel^="EditableField_hotel_id_"]')
        .on('init', function (e, edit) {
            hotelEditable = edit;
        }).on('shown', function (e, edit) {
            if (arguments.length == 1) {
                $.fillSource(hotelEditable, '.chzn-hotels');
            }
        }).on('save', function (e, r) {
            h_id = $.saveSource(hotelEditable, r, 'a[rel^="EditableField_hotel_id_"]');
        }).on('hidden', function (e, reason) {
            if (reason === 'save') {
                $(this).editable('setValue', h_id);
            }
        });
};
/**
 *
 * @param symbols
 * @param h_data
 */
$.order_math_form = function(symbols, h_data){
    var symbol = $('.price-currency-symbol').html();
    var cur = $('#Orders_currency_id'),
        d_cur = $('#Orders_discount_currency_id'),
        d_cur_s = $('.discount-currency-symbol'),
        a_p = $('#Orders_amount_paid'),
        p = $('#Orders_price'),
        disc = $('#Orders_discount');

    var d_cur_val = function(){return !(d_cur.find('option:selected').val() == 0);};

    cur.live('change', function () {
        symbol = symbols[cur.val()];
        $('.price-currency-symbol').html(symbol);
        d_cur.find('option:eq(1)').val(cur.find(":selected").val()).text(cur.find(":selected").text()).change();

        if (d_cur_val()) {
            d_cur.find('option:eq(1)').attr('selected', 'selected').change();
            d_cur_s.html(symbol);
        }
    });
    d_cur.live('change', function () {
        if (d_cur.find('option:selected').val() == 0) {
            d_cur_s.html('%');
            a_p.val(p.val() - (p.val() / 100 * disc.val()));
        }
        else {
            d_cur_s.html(symbol);
            a_p.val(p.val() - disc.val());
        }
    });
    $('#Orders_travel_service_fee_currency_id').live('change', function () {
        $('.travel-service-fee-currency-symbol').html(symbols[$('#Orders_travel_service_fee_currency_id').val()]);
    });

    $('.calc').on("keyup change",function () {
        if (d_cur_val()) {
            a_p.val(p.val() - (p.val() / 100 * disc.val()));
        }
        else {
            a_p.val(p.val() - disc.val());
        }
    });

    a_p.on("keyup change",function () {
        if (!d_cur_val()) {
            d_cur.find('option:eq(1)').attr('selected', 'selected').change();
        }
        disc.val(p.val() - a_p.val());
    });

    $(".juiDate").datepicker({
        dateFormat: 'dd.mm.yy'
    });
    $('#orders-form .chzn-select').css('width','81%').select2();

    $('.open-dropdown').live('click', function () {
        $(this).parent().find("select").select2({
            minimumResultsForSearch: 99
        }).select2("open");

    });
    $('.select-without-search').css('width','81%').select2({
        minimumResultsForSearch: 99
    });

    $.createHotelsList = function(json){
        var res = [];
        $.each(json, function(i, e){
            res.push({id:i, text:e});
        });
        return res;
    };


    var populated_list = {
        data: $.createHotelsList(h_data),
        createSearchChoice:function(term, data){
            if ($(data).filter(function () {
                return this.text.localeCompare(term) === 0;
            }).length === 0) {
                return {id: term, text: term};
            }
        },
        initSelection:function(el, cb){
            var data = {id:el.val(), text:h_data[el.val()]};
            cb(data);
        },
        placeholder: "Выберите отель"
    };


    $('.chzn-hotels').css('width','81%').select2(populated_list);

    $.fn.getDependData = function(response, selector){
        if($.isArray(selector)){
            $.each(selector, function(i,e){
                if($(e).hasClass('chzn-hotels')){
                    populated_list.data = [];
                    $(e).select2(populated_list);
                    $(e).select2('val','');
                }else{
                    $(e+" option").remove();
                    $(e).append("<option></option>");
                    if(i==0){
                        $.fillSelect(e, response);
                    }
                }
            });
        }else{
            if($(selector).hasClass('chzn-hotels')){
                populated_list.data = $.createHotelsList($.parseJSON(response));
                $(selector).select2(populated_list);
                $(selector).select2('val','');
            }else{
                $(selector+" option").remove();
                $(selector).append("<option></option>");
                $.fillSelect(selector, response);
            }
        }
        $('#spinner').remove();
    };

    $.fillSelect = function(s, data){
        $.each($.parseJSON(data), function(i,el){
            $(s).append(
                "<option value="+i+">"+el+"</option>"
            );
        });
        $(s).select2();
    };

    $.fn.insertSpinner = function(selector){
        $("<img id='spinner' src='img/loading.gif'>").insertAfter(selector);
    };
};
