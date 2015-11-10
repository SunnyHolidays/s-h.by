function getChartBar(ticks,data,labels,color){
    return {
        chart: {
            type: 'column',
            margin: [ 50, 50, 100, 80]
        },
        title: {
            text: ''
        },
        xAxis: {
            title: {
                text: labels[0]
            },
            categories: ticks,
            labels: {
                rotation: -45,
                align: 'right',
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: labels[1]
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: '{series.name} : <b>{point.y:.1f}</b>'
        },
        series: [{
            name: labels[1],
            data: data,
            color: color,
            dataLabels: {
                enabled: true,
                rotation: 0,
                color: '#FFFFFF',
                align: 'right',
                x: -15,
                y: 22,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif',
                    textShadow: '0 0 3px black'
                }
            }
        }]
    };
};

function getChartLines(data,labels,color){
    return {
        chart: {
            type: 'spline',
            zoomType: 'x'
        },
        title: {
            text: ''
        },
        xAxis: {
            title: {
                text: labels[0]
            },
            type: 'datetime',
            dateTimeLabelFormats: {
                date: 'd',
                month: 'm',
                year: 'Y'
            },
//            tickInterval: 7 * 24 * 3600 * 1000,
            tickWidth: 0,
            gridLineWidth: 1

        },
        yAxis: {
            title: {
                text: labels[1]
            }
        },
        tooltip: {
            formatter: function() {
                return Highcharts.dateFormat('%d-%m-%Y',this.x+24*60*60*1000) +'<br>' + this.series.name + ' : ' + '<b>' + this.y + '</b>';
            }
        },
        series: [{
            showInLegend: false,
            name: labels[1],
            data: data,
            color: color,
            marker:{
                fillColor: '#FFFFFF',
                lineWidth: 2,
                lineColor: null
            }
        }]
    };
};

function initFlotCharts(selector)
{

}
