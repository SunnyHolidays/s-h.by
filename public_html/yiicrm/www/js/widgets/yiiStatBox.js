function getPopover(popoverSelectorID, popoverContentSelectorID) {
    $(popoverSelectorID).popover({
        container:'body',
        trigger: 'hover',
        placement: 'bottom',
        html: 'true',
        content: function () {
            return $(popoverContentSelectorID).html();
        },
        delay: {show: 500, hide: 100}
    });

    $(popoverSelectorID).hover(function () {
        $(this).popover('show');
    }, function () {
        $(this).popover('hide');
    });
};

var color;

function getPeity(inLastMonth,inMonth,divIdSelector){
    if (inLastMonth > inMonth) {
        color = "#FF2200";
    } else {
        color = "#459D1C";
    }
    $(divIdSelector).peity("bar", {
        colour: color
    });
};