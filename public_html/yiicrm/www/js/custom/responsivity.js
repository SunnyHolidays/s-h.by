function adapt_grid(){
    var $table = $('.grid-view.table').children('.items'), $this = $('.grid-view.table');
    if ($this.width() < $table.width() && !$this.hasClass('table-responsive')) {
        $this.addClass('table-responsive');
    } else if ($this.width() >= $table.width() && $this.hasClass('table-responsive')) {
        $this.removeClass('table-responsive');
    }
}

$(function () {
    adapt_grid();
    $('.grid-view.table').resize(function () {
        adapt_grid();
    });
});