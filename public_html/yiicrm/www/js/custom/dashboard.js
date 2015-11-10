/**
 * Created with JetBrains PhpStorm.
 * User: a.danilovich
 * Date: 24.10.13
 * Time: 13:04
 * To change this template use File | Settings | File Templates.
 */
$.create_dashboard = function () {

    var gridsterSettings = [];
    var base_grid;
    var base_opt = {
        max_size_x: 2,
        max_size_y:2,
        draggable: {
            start: function (event, ui) {
                $('.gridster .preview-holder').text('переместить виджет сюда').css('width', ui.helper.width()-40);
            }
        },
        serialize_params: function (w, wgd) {
            gridsterSettings = {
                'col': wgd.col,
                'row': wgd.row,
                'widget_name': wgd.el.attr('widget-name')
            };
            return gridsterSettings;
        }
    };

    // 380 px min width
    var c_width = $('.gridster').width();
    var dimension = (c_width < 800) ? 800 : ((c_width / 2)) - 20;
    var statsGrid, widgetsGrid;
    var is_reorganized = false;
    var one_col = false;
    var s_screen = !!(c_width < 800);// ? true : false;
    $.init_grid = function() {
        var stat_opt = {
            widget_base_dimensions: [100, 80],
            namespace: '#stats',
            min_cols: 8,
            min_rows: 1,
            extra_rows:0
        };
        var widgets_opt = {
            widget_base_dimensions: [dimension, 240],
            namespace: '#widgets',
            max_cols: 2
        };
        statsGrid = $('.gridster ul.stats').gridster($.extend({}, base_opt, stat_opt)).data('gridster').disable();
        widgetsGrid = $('.gridster ul.widgets').gridster($.extend({}, base_opt, widgets_opt)).data('gridster').disable();
        widgetsGrid.add_faux_rows(4);
        base_grid = widgetsGrid.serialize();
        if(s_screen){
            $.rebuild();
        }
    };
    $.move_widget = function(grid, $el, col, row ){
        var el_grid_data = $el.coords().grid;
        grid.remove_from_gridmap(el_grid_data);
        el_grid_data.row = row;
        el_grid_data.col = col;
        $el.attr('data-row', row).attr('data-col', col);//.attr('moved', 'moved');
        grid.update_widget_position(el_grid_data, $el);
        grid.$changed = grid.$changed.add($el);
    };
    $.rebuild = function(){
        var g_width = $('.gridster').width();
        var widgets = $('.gridster ul.widgets li.gs_w');
        if(g_width <= dimension * 1.3 || s_screen){
            var row = null;
            var offset = null;
            if(!one_col){
                $('.gridster ul.widgets li[data-col="1"]').each(function(){
                    var x = +$(this).attr('data-row');
                    if(row === null || x > row){
                        row = x;
                        offset = +$(this).attr('data-sizey');
                    }
                });
                row +=offset;
                $.each(widgets, function (index, el) {
                    var $el = $(el).css('width', '100%');
                    if($el.data('col') == 2){
                        $.move_widget(widgetsGrid, $el, 1, row);
                        row += (+$el.data('sizey'));
                    }

                });
                is_reorganized = true;
                widgetsGrid.recalculate_faux_grid();
                widgetsGrid.set_dom_grid_height();
            }

            s_screen = false;
            one_col = true;
        }else if(is_reorganized){
            $.each(base_grid, function(i, el){
                var $el = $('.gridster .widgets [widget-name='+el.widget_name+']').css('width', '');//.attr('data-row', el.row).attr('data-col', el.col);
                $.move_widget(widgetsGrid, $el, el.col, el.row);
            });
            widgetsGrid.recalculate_faux_grid();
            widgetsGrid.set_dom_grid_height();
            is_reorganized = false;
            one_col = false;
        }

    };
    $.init_grid();

    $("body").on('click', '.gridster .close',function () {
        var widget = $(this).parents('li.gs_w');
        var grid_tmp;
        $('button[widget-name="' + $(widget).attr('widget-name') + '"]').removeAttr('disabled').text('Добавить');
        if($(this).parents('ul').hasClass('stats')){
            grid_tmp = statsGrid;
        }else{
            grid_tmp = widgetsGrid;
        }
        grid_tmp.remove_widget(widget);
        base_grid = widgetsGrid.serialize();
        $(this).trigger('dashboard-changed');
    }).on('dashboard-changed', function (e) {
            if(!one_col){
                base_grid = widgetsGrid.serialize();
                var widgetData = $.merge($.merge([],base_grid), statsGrid.serialize());
                $.get(
                    $('#settings-url').val(),
                    {'settings': JSON.stringify(widgetData)}
                );
            }
        });

    $('#edit-layout').on('click', function () {
        if ($(this).attr('type') == 'start') {
            $('.gridster').addClass('editable');
            $(this).attr('type', 'stop');
            $('#' + $(this).attr('id') + ' i').removeClass('icon-edit').addClass('icon-ok');
            widgetsGrid.enable();
            statsGrid.enable();
            is_reorganized = true;
        } else  {
            $(this).attr('type', 'start');
            $('#' + $(this).attr('id') + ' i').removeClass('icon-ok').addClass('icon-edit');
            widgetsGrid.disable();
            statsGrid.disable();
            $('.gridster').removeClass('editable');
            $(this).trigger('dashboard-changed');
        }
    });

    $('.gridster .widgets').resize(function(){$.rebuild()});

    $('.add-widget-button').on('click', function () {
        var $this = $(this);
        var spinner = $('<img src="img/loading.gif">').insertAfter(this);
        $this.attr('disabled', 'disabled').text('Виджет добавлен');
        $.ajax({
            url: $('.widget-list').data('get-url'),
            data: {
                "name": $this.attr('widget-name')
            },
            success: function (response) {
                spinner.remove();
                var gridType;
                if ($this.attr('stat') != null) {
                    gridType = statsGrid;
                } else {
                    gridType = widgetsGrid;
                }
                gridType.add_widget(
                        $('<li/>')
                            .append(response), +$this.data('size-x'), +$this.data('size-y'))
                    .attr('type', $this.attr('type'))
                    .attr('widget-name', $this.attr('widget-name'))
                    .trigger('widgetAdded')
                    .trigger('dashboard-changed');
            }
        });
    });

    $(function () {
        $.each($('.gridster ul li.gs_w'), function (index, el) {
            $('button[widget-name="' + $(el).attr('widget-name') + '"]').attr('disabled', 'disabled').text('Виджет добавлен');
        })
    });

    $("#add-widget").on('click', function () {
        $('#widget-selector').modal();
    });

    $(document).trigger('widgetAdded');
};
