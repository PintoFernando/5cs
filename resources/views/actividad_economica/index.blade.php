@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12" style="float:right;">
    <div class="info-box bg-green">
      <span class="info-box-icon"><i class="fa fa-user"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">S. Seleccionado</span>
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
<div class="box-header">
 <h3>Actividad Económica
  <a href="{{url('/actividad_economica/create')}}" 
  class="btn btn-success pull-right" 
  style="margin-top: -8px;">Añadir Actividad Económica</a>
</h3>
</div>
</div>

@if(session('notification'))
<div class="alert alert-success">
 {{session('notification')}}
</div>
@endif
<!-- /.box-header -->
<div class="box-body">
  <table id="o_actividad_economica" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Id</th>
       <th>Ciudad</th>
       <th>Provincia</th>
       <th>Zona</th>
       <th>Dirección</th>
       <th>Teléfono</th>
       <th>Actividad Que Realiza</th>
       <th>Nit</th>
       <th>Horario de Trabajo</th>
       <th>Días de Trabajo</th>
       <th>Antiguedad de Trabajo</th>   
       <th>Acciones</th>               
     </tr>
   </thead>
   <tbody>
    @foreach ($actividad as $acti)
    <tr>
      <td>{{$acti->id_actividad_economica}}</td>
      <td>{{$acti->ciudad_ae}}</td>
      <td>{{$acti->provincia_ae}}</td>
      <td>{{$acti->zona_ae}}</td>
      <td>{{$acti->direccion_ae}}</td>
      <td>{{$acti->telefono_ae}}</td>
      <td>{{$acti->actividad_qrealiza}}</td>
      <td>{{$acti->nit_ae}}</td>
      <td>{{$acti->horario_trabajo_ae}}</td>
      <td>{{$acti->dias_trabajo_ae}}</td>
      <td>{{$acti->antiguedad_trabajo_ae}}</td>
      <td> 
        <a href="{{url('/actividad_economica/'.$acti->id_actividad_economica.'/edit')}}" rel="tooltip" title="Editar Datos Empresa" class="btn btn-success btn-simple btn-xs">
          <i class="fa fa-pencil"></i> 
        </a>
        <a href="" data-target="#modal-delete-{{$acti->id_actividad_economica}}" rel="tooltip" title="Eliminar" data-toggle="modal" class="btn btn-danger btn-simple btn-xs">
         <i class="fa fa-times"></i> 
       </a>
     </td>
   </tr>
   @include('actividad_economica.modal')
   @endforeach
 </tbody>                
</table>
</div>
<!-- /.box-body -->
@include('sweetalert::alert')
@push ('scripts')
<script>
  $('#liAdmin').addClass("treeview active");
  $('#liAdmin_actividad_economica').addClass("active");
</script>
@endpush
@endsection