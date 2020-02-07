@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
          <h3>Datos dirección</h3>
     </div>
</div>
@if(session('notification'))
<div class="alert alert-success">
   {{session('notification')}}
</div>
@endif
<div class="row">

     <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
  <div class="table-responsive">
    <table class="table">
      <tr >
        <td class="info">NÚMERO DE DIRECCIÓN:</td>
        <td>{{$direccion->direc_numero}}</td>
      </tr>
      <tr>
        <td class="info">CIUDAD:</td>
        <td>{{$direccion->ciudad}}</td>
      </tr>
      <tr>
        <td class="info">PROVINCIA:</td>
        <td>{{$direccion->provincia}}</td>
      </tr>
      <tr>
        <td class="info">lOCALIDAD:</td>
        <td>{{$direccion->localidad}} </td>
      </tr>
      <tr>
        <td class="info">ZONA:</td>
        <td>{{$direccion->zona}}</td>
      </tr>
      <tr>
        <td class="info">DISTRITO:</td>
        <td>{{$direccion->distrito}} </td>
      </tr>
      <tr>
        <td class="info">BARRIO:</td>
        <td>{{$direccion->barrio}} </td>
      </tr>
      <tr>
        <td class="info">CALLE PRINCIPAL</td>
        <td>{{$direccion->cll_principal}}</td>
      </tr>   
      <tr>
        <td class="info">CALLE SECUNDARIA</td>
        <td>{{$direccion->cll_secundaria}}</td>
      </tr>
      <tr>
        <td class="info">TIEMPO RESIDENCIA</td>
        <td>{{$direccion->tiempo_residencia}} </td>
      </tr>  
      <tr>
        <td class="info">TIPO DE VIVIENDA</td>
        <td>{{$tipo_vivienda}}</td>
      </tr>      
    </table>
  </div>
</div>

</div>
@include('sweetalert::alert')
@endsection