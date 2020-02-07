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

<div class="box-header">
 <h3>Datos Empresa
  <a href="{{url('/oficial/datos_empresa/create')}}" 
  class="btn btn-success pull-right" 
  style="margin-top: -8px;">Añadir Dato Empresa</a>
</h3>
</div>



@if(session('notification'))
<div class="alert alert-success">
   {{session('notification')}}
</div>
@endif
<!-- /.box-header -->
<div class="box-body">
  <table id="o_datos_empresa" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Id</th>
       <th>Nombre</th>
       <th>Actividad</th>
       <th>Antiguedad en la empresa</th>
       <th>Ciudad</th>
       <th>Provincia</th>
       <th>Zona</th>
       <th>Dirección</th>
       <th>Teléfono</th>
       <th>Cargo</th>
       <th>Antiguedad en el cargo</th>
       <th>Horario de Trabajo</th>
       <th>Dias trabajo</th>
       <th>Afp</th>
       <th>Tipo Contrato</th>
       <th>Acciones</th>               
     </tr>
   </thead>
   <tbody>
    @foreach ($datos as $dat)
    <tr>
      <td>{{$dat->id_datos_empresa}}</td>
      <td>{{$dat->nombre_empresa}}</td>
      <td>{{$dat->actividad_empresa}}</td>
      <td>{{$dat->antiguedad_empresa}}</td>
      <td>{{$dat->ciudad_empresa}}</td>
      <td>{{$dat->provincia_empresa}}</td>
      <td>{{$dat->zona_empresa}}</td>
      <td>{{$dat->direccion_empresa}}</td>
      <td>{{$dat->telefono_empresa}}</td>
      <td>{{$dat->cargo_en_empresa}}</td>
      <td>{{$dat->antiguedad_en_cargo}}</td>
      <td>{{$dat->horario_trabajo}}</td>
      <td>{{$dat->dias_trabajo}}</td>
      <td>{{$dat->nombre_afp}}</td>
      <td>{{$dat->nombre_tc}}</td>  

      <td> <a href="{{url('/oficial/datos_empresa/'.$dat->id_datos_empresa.'/edit')}}" rel="tooltip" title="Editar Datos Empresa" class="btn btn-success btn-simple btn-xs">
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
  $('#liC1').addClass("treeview active");
  $('#liDatosEmpresa').addClass("active");
</script>
@endpush
@endsection