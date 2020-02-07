@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12" style="float:right;">
    <div class="info-box bg-green">
      <span class="info-box-icon"><i class="fa fa-user"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">U. Seleccionado</span>
        <span class="info-box-number"> </span>

        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
          {{Session::get('id_persona_oficial','Usuario no seleccionado')}}
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
</div>


<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <h3>Registrar croquis</h3>
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
  <div class="form-group">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <p><strong>Click en la localzación del mapa para seleccionarlo. Mueve el cursor para cambiar la localización.</strong> </p>
    </div>
  </div>
</div>

 <!--map div-->
<div class="row">
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div  id="map-container"></div>
     </div>
</div>


<form method="post" action="{{url('/croquis')}}">
  {{csrf_field()}}
  <div class="row">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
        <label for="latitud">Latitud</label>
        <input type="text" id="lat" name="latitud" readonly="yes">
      </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
        <label for="longitud">Longitud</label>
        <input type="text" id="lng" name="longitud" readonly="yes">    
      </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
     <div class="form-group" class="form-control">
       <label for="id_categoria_croquis">Categoria Croquis</label>
       <select name="id_categoria_croquis"  class="form-control selectpicker" data-size="5" id="id_categoria_croquis" data-live-search="true" required>
        @foreach($categoria as $ca)
        <option value="{{$ca->id_categoria_croquis}}"> {{$ca->categoria}}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">            
    <div class="form-group">
      <button class="btn btn-primary" type="submit">Guardar</button>          
      <a href="{{url('/croquis')}}" class="btn btn-danger"> cancelar</a>
    </div>
  </div>
</div>
</form>

@push ('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVomCQZTYVQSRGPsG6cQPLsoZqYWdZq0w"></script>
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
      zoom: 17 //The zoom value.
    };

    //Create the map object.
    map = new google.maps.Map(document.getElementById('map-container'), options);

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
@endpush

@push ('scripts')
<script>
  $('#liAdmin').addClass("treeview active");
  $('#liAdmin_croquis').addClass("active");
</script>
@endpush
@endsection
