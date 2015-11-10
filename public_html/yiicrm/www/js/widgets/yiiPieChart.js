function getPieOption(data) {
    return {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: ''
        },
        tooltip: {
            pointFormat: '<b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true,
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    format: '<b>{point.name}: {point.percentage:.1f} %</b>'
                }
            }
        },
        series: [
            {
                type: 'pie',
                data: data
            }
        ]
    }
};

function initChart(selector, data) {
    var con = $(selector);
    if(!$(con[0]).is('[data-highcharts-chart]') && $(selector).length){
        con.highcharts(
            getPieOption(data)
        );
    }
}