
 <section class="wrapper site-min-height">
 
 <div class="row mt">
 <div class="col-lg-6">
    <div id="pie-chart"></div>
 </div>
  <div class="col-lg-6">    
    <div id="column-chart"></div>
 </div>
 </div>                      

 
</section>
   


<script type="text/javascript">

/*$(function () {
    
    $('#pie-chart').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Votación 2015'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: [
                @foreach ($lista as $key => $item)
                   [ '[[$item->nombre]]', [[$item->votos]] ],
                @endforeach
            ]
        }]
    });

    $('#column-chart').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Votación 2015'
        },
        subtitle: {
            text: 'Source: <a href="http://en.wikipedia.org/wiki/List_of_cities_proper_by_population">Wikipedia</a>'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Population (millions)'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Population in 2008: <b>{point.y:.1f} millions</b>'
        },
        series: [{
            name: 'Population',
            data: [
                @foreach ($lista as $key => $item)
                   [ '[[$item->nombre]]', [[$item->votos]] ],
                @endforeach
            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#ffd777',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});*/
        </script>  

