var mapa; //objeto mapa de google maps
var markersArray = []; //todos los marcadores en un arreglo
function initializeGMEdit(latitud, longitud, marcadorUsuario) {
  var marcadorUsuarioMapas = marcadorUsuario;
  var myLatlng = new google.maps.LatLng(latitud, longitud); 
  var opcionesMapa = {
    center: myLatlng,
	zoom: 18,
	mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  mapa = new google.maps.Map(document.getElementById("googleMap"), opcionesMapa);
  var marker = new google.maps.Marker({
      position: myLatlng,
      map: mapa,
	  icon: marcadorUsuarioMapas
  });
  borraMarcador(marker);
  google.maps.event.addListener(mapa, 'click', function(event) {
	agregaMarcador(event.latLng, marcadorUsuarioMapas);
	var myLatLng = event.latLng;
	var latitud = myLatLng.lat();
	var longitud = myLatLng.lng();
	document.getElementById("latitud").value = latitud;
	document.getElementById("longitud").value = longitud;	
  });
}
function agregaMarcador(location, marcadorUsuarioMapas) {
  marker = new google.maps.Marker({
    position: location,
    map: mapa,
	icon: marcadorUsuarioMapas
  });
  markersArray.push(marker);
  borraMarcador(marker);
}
function borraMarcador(marker) {
  google.maps.event.addListener(marker, 'click', function() {
	marker.setMap(null);
	document.getElementById("latitud").value = '';
	document.getElementById("longitud").value = '';	
  });
}