
[[ HTML::script('app_cliente/js/jquery.js') ]]
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=es"></script>

<script>
      function llenarMapa(){
      	
        var n=1;
        var options = {
            zoom: 13
            , center: new google.maps.LatLng(10.9830105, -74.7974388)
            , mapTypeId: google.maps.MapTypeId.ROADMAP
        };
     
        var map = new google.maps.Map(document.getElementById('map'), options);
     
        var place = new Array();
       
		@foreach(BarrioProveedor::groupBy('id_barrio')->get() as $item)
	           place['[[$item->barrio->NOMBRE]]'] = new google.maps.LatLng([[$item->barrio->COORDENADA_X]],[[$item->barrio->COORDENADA_Y]]);
	    @endforeach
       

console.log(place);
	
        for(var i in place){
            var marker = new google.maps.Marker({
                position: place[i]
                , map: map
                , title: i
                , icon: '../app_cliente/img/carrito.png'
            });
        }
    }
    </script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54374048-1', 'auto');
  ga('send', 'pageview');

</script>




            <div id="map" style="width:730px;height:500px"></div>
            
         


<script>llenarMapa();</script>
