@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
          <h3>Datos De La Actividad Económica</h3>
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
        <td class="info">CIUDAD ACTIVIDAD ECONÓMICA:</td>
        <td>{{$datos->ciudad_ae}}</td>
      </tr>

      <tr >
        <td class="info">PROVINCIA ACTIVIDAD ECONÓMICA:</td>
        <td>{{$datos->provincia_ae}}</td>
      </tr>

      <tr>
        <td class="info">ZONA ACTIVIDAD ECONÓMICA:</td>
        <td>{{$datos->zona_ae}}</td>
      </tr>

      <tr >
        <td class="info">DIRECCIÓN ACTIVIDAD ECONÓMICA:</td>
        <td>{{$datos->direccion_ae}}</td>
      </tr>

      <tr>
        <td class="info">TELÉFONO ACTIVIDAD ECONÓMICA:</td>
        <td>{{$datos->provincia_ae}}</td>
      </tr>
      <tr>
        <td class="info">ACTIVIDAD QUE REALIZA:</td>
        <td>{{$datos->actividad_qrealiza}}</td>
      </tr>
      <tr>
        <td class="info">NIT:</td>
        <td>{{$datos->nit_ae}} </td>
      </tr>
      <tr>
        <td class="info">HORARIO DE TRABAJO ACTIVIDADA ECONÓMICO:</td>
        <td>{{$datos->horario_trabajo_ae}}</td>
      </tr>
      <tr>
        <td class="info">DÍAS TRABAJO:</td>
        <td>{{$datos->dias_trabajo_ae}} </td>
      </tr>
      <tr>
        <td class="info">ANTIGUEDAD EN TRABAJO:</td>
        <td>{{$datos->antiguedad_trabajo_ae}} </td>
      </tr>

    
      
    </table>
  </div>
</div>

</div>
@include('sweetalert::alert')
@endsection
