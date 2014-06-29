$(document).ready(function(){
        var map;
        var latitud;
        var longitud; 
        coordenadas();
        function localizame() {
            if (navigator.geolocation) { /* Si el navegador tiene geolocalizacion */
                
                navigator.geolocation.getCurrentPosition(coordenadas, errores);
            }else{
                alert('Oops! Tu navegador no soporta geolocalizaci�n. B�jate Chrome, que es gratis!');
            }
        }
        function coordenadas(position){
            latitud = $('#lat').val(); 
            longitud = $('#lng').val();
            cargarMapa();
        }
        
        function errores(err) {
            /*Controlamos los posibles errores */
            if (err.code == 0) {
              alert("Oops! Algo ha salido mal");
            }
            if (err.code == 1) {
              alert("Oops! No has aceptado compartir tu posici�n");
            }
            if (err.code == 2) {
              alert("Oops! No se puede obtener la posici�n actual");
            }
            if (err.code == 3) {
              alert("Oops! Hemos superado el tiempo de espera");
            }
        }
         
        function cargarMapa() {
            var nombreBoti = "Botillería Mayo"
            var latlon = new google.maps.LatLng(latitud,longitud); /* Creamos un punto con nuestras coordenadas */
            var myOptions = {
                zoom: 12,
                center: latlon, /* Definimos la posicion del mapa con el punto */
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: false
            };/*Configuramos una serie de opciones como el zoom del mapa y el tipo. */
            map = new google.maps.Map($("#map_canvas").get(0), myOptions); /*Creamos el mapa y lo situamos en su capa */
            
            var coorMarcador = new google.maps.LatLng(latitud,longitud); /*Un nuevo punto con nuestras coordenadas para el marcador (flecha) */
                
            var marcador = new google.maps.Marker({
				/*Creamos un marcador*/
                position: coorMarcador, /*Lo situamos en nuestro punto */
                map: map, /* Lo vinculamos a nuestro mapa */
                title: nombreBoti
            });
			
			/*var coorMarcador2 = new google.maps.LatLng(-33.490507,-70.61309);*/
			/*var marcador2 = new google.maps.Marker({*/
				/*Creamos un marcador*/
                /*position: coorMarcador2 ,*/ /*Lo situamos en nuestro punto */
                /*map: map,*/ /* Lo vinculamos a nuestro mapa */
                /*title: "D�nde estoy realmente?" 
            });*/
        }
        function geolocalizarManual(address){
                    manualLocation = true;
                    DeletePrintStore();
                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode({'address': address}, geocodeResult);      
           }
         function DeletePrintStore(){
                $('div').remove('#storeinformation');
        }
          function geocodeResult(results, status) {
                    if (status == 'OK' && results.length > 0) {
                        //si modificó la direccion manual
                        if(manualLocation){ 
                                    var mapOptions = {
                                        zoom: 12,
                                        center: results[0].geometry.location,
                                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                                        scrollwheel: false,
                                        mapTypeControl: false,
                                        mapTypeControlOptions: {
                                            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                                            position: google.maps.ControlPosition.BOTTOM_CENTER
                                        },
                                        panControl: true,
                                        panControlOptions: {
                                            position: google.maps.ControlPosition.RIGHT_BOTTOM
                                        },
                                        zoomControl: true,
                                        zoomControlOptions: {
                                            style: google.maps.ZoomControlStyle.LARGE,
                                            position: google.maps.ControlPosition.RIGHT_TOP
                                        },
                                        streetViewControl: true,
                                        streetViewControlOptions: {
                                            position: google.maps.ControlPosition.RIGHT_TOP
                                        }
                                    };
                                    map = new google.maps.Map($("#map_canvas").get(0), mapOptions);
                                    map.fitBounds(results[0].geometry.viewport);
                                    var markerOptions = {position: results[0].geometry.location}
                                    var marker = new google.maps.Marker(markerOptions);
                                    marker.setMap(map);
                                    var lat = map.getCenter().lat();
                                    var lng = map.getCenter().lng();
                                    $('#lat').val(lat);
                                    $('#lng').val(lng);
                                }
                       }
           }
         /* EDITAR BOTILLERIA*/
          $('#btn-comprobar').click(function(){
              direccion = $('#direccion-botilleria').val();
              geolocalizarManual(direccion);
          })
          $('#direccion-botilleria').keyup(function(e){
              if(e.keyCode == 13){
                  e.preventDefault(); // para FF standard
                  e.returnValue=false; // Para IE
                  direccion = $('#direccion-botilleria').val();
                  geolocalizarManual(direccion); 
                  return false;
              }
          })
       /* FIN EDITAR BOTILLERIA*/
});