
 <section class="wrapper site-min-height">
 
 <div class="row mt">
  <div class="col-lg-6">
    <div id="pie-chart"></div>
 </div>
  <div class="col-lg-6">    
    <div id="column-chart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
 </div>
 </div>                      

 
</section>
 
<script type="text/javascript">
$(function () {
    $('#pie-chart').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Votacion por partidos 2015'
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
});


    </script>

<script src="app_cliente/js/charts/highcharts.js"></script>
<script src="app_cliente/js/charts/modules/exporting.js"></script>




               