@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Registrar ubicación de dirección</h3>
   @if (count($errors)>0)
   <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
  @endif
</div>
</div>

<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<p>Click en la localzación del mapa para seleccionarlo. Mueve el cursor para cambiar la localización.</p>

<!--map div-->
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div id="map"></div>
</div>
</div>
<form method="post" action="{{url('cliente/croquis')}}">
  {{csrf_field()}}
  <div class="row">

    <input type="text" id="lat" name="latitud" readonly="yes">
    <input type="text" id="lng" name="longitud" readonly="yes">                   


    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">            
      <div class="form-group">
        <hr>
       <button class="btn btn-primary" type="submit">Guardar</button>
       <button class="btn btn-danger" type="reset">Cancelar</button>
     </div>
   </div>
 </div>
</form>
</div>
</div>
<script type="text/javascript">
  
  //map.js

//Set up some of our variables.
var map; //Will contain map object.
var marker = false; ////Has the user plotted their location marker? 
        
//Function called to initialize / create the map.
//This is called when the page has loaded.
function initMap() {

    //The center location of our map.
    var centerOfMap = new google.maps.LatLng(-19.5892421, -65.7539573);

    //Map options.
    var options = {
      center: centerOfMap, //Set center.
      zoom: 16 //The zoom value.
    };

    //Create the map object.
    map = new google.maps.Map(document.getElementById('map'), options);

    //Listen for any clicks on the map.
    google.maps.event.addListener(map, 'click', function(event) {                
        //Get the location that the user clicked.
        var clickedLocation = event.latLng;
        //If the marker hasn't been added.
        if(marker === false){
            //Create the marker.
            marker = new google.maps.Marker({
                position: clickedLocation,
                map: map,
                draggable: true //make it draggable
            });
            //Listen for drag events!
            google.maps.event.addListener(marker, 'dragend', function(event){
                markerLocation();
            });
        } else{
            //Marker has already been added, so just change its location.
            marker.setPosition(clickedLocation);
        }
        //Get the marker's location.
        markerLocation();
    });
}
        
//This function will get the marker's current location and then add the lat/long
//values to our textfields so that we can save the location.
function markerLocation(){
    //Get location.
    var currentLocation = marker.getPosition();
    //Add lat and lng values to a field that we can save.
    document.getElementById('lat').value = currentLocation.lat(); //latitude
    document.getElementById('lng').value = currentLocation.lng(); //longitude
}
        
        
//Load the map when the page has finished loading.
google.maps.event.addDomListener(window, 'load', initMap);
</script>
@endsection
