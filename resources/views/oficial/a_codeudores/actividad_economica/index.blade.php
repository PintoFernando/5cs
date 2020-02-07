@extends ('layouts.admin3')
@section ('contenido')
<!-- div usuario seleccionado-->
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12" style="float:right;">
    <div class="info-box bg-light-blue">
      <span class="info-box-icon"><i class="fa fa-user text-orange"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Codeudor seleccionado</span>
        <span class="info-box-number"> </span>
        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
          {{Session::get('id_persona_oficial_codeudor','Codeudor no seleccionado')}}
        </span>
      </div>
    </div>
  </div>
  
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
    </div>
  </div>
</div>
<!-- div usuario seleccionado-->


<div class="box-header">
 <h4>Actividad Económica  
</h4>
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
    

      <td> <a href="{{url('/oficial/a_codeudores/actividad_economica/'.$acti->id_actividad_economica.'/edit')}}" rel="tooltip" title="Editar Datos Empresa" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-pencil"></i> 
      </a>
    </td>
  </tr>
  @endforeach
</tbody>                
</table>
</div>
<!-- /.box-body -->
@include('sweetalert::alert')
@push ('scripts')
<script>
  $('#liCodeudor').addClass("treeview active");
  $('#liCodeudor_sub_actividad').addClass("active");
</script>
@endpush
@endsection