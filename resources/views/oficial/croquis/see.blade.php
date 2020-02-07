@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
          <h3>Croquis</h3>
     </div>
</div>

<div class="row">
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div  id="map-container"></div>
     </div>
</div>

<div >
  <a href="{{url('/oficial/croquis')}}" class="btn btn-danger"> Volver</a> 
</div>

@push ('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVomCQZTYVQSRGPsG6cQPLsoZqYWdZq0w"></script>

<script type="text/javascript">
	function init_map() {
    var var_location = new google.maps.LatLng({{$latitud}},{{$longitud}});
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
</script>
@endpush

@include('sweetalert::alert')
@push ('scripts')
<script>
  $('#liC1').addClass("treeview active");
  $('#liCroquis').addClass("active");
</script>
@endpush
@endsection