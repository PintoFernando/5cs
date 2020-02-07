    function init_map() {
    var var_location = new google.maps.LatLng(-19.5891593,-65.7489705);
        var var_mapoptions = {
          center: var_location,
          zoom: 18
        };
 
    var var_marker = new google.maps.Marker({
      position: var_location,
      map: var_map,
      title:"Cooperativa de Ahorro y Crédito Societaria San Martín"});
 
        var var_map = new google.maps.Map(document.getElementById("map-container"),
            var_mapoptions);
 
    var_marker.setMap(var_map); 
 
      }
 
      google.maps.event.addDomListener(window, 'load', init_map);