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
 
<center><div class="box-header">
 <h3>Dirección Domiciliaria del Solicitante</h3>
</div></center>

<!-- /.box-header -->
<div class="box-body">
  <table id="o_direccion" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Id</th>
       <th>Número de Dirección</th>
       <th>Ciudad</th>
       <th>Provincia</th>              
       <th>Localidad</th>               
       <th>Zona</th>                            
       <th>Calle Principal</th>                              
       <th>Calle Secundaria</th>                              
       <th>Tiempo de Residencia</th>                              
       <th>Tipo de Vivienda</th>                              
       <th>Acción</th>                              
     </tr>
   </thead>
   <tbody>
    @foreach ($dir as $dire)
    <tr>
      <td>{{$dire->id_direccion}}</td>
      <td>{{$dire->direc_numero}}</td>
      <td>{{$dire->ciudad}}</td>
      <td>{{$dire->provincia}}</td>
      <td>{{$dire->localidad}}</td>
      <td>{{$dire->zona}}</td>
      <td>{{$dire->cll_principal}}</td>
      <td>{{$dire->cll_secundaria}}</td>
      <td>{{$dire->tiempo_residencia}}</td>
      <td>{{$dire->tipo_vivienda}}</td>
      
      <td> <a href="{{url('/oficial/direccion/'.$dire->id_direccion.'/edit')}}" rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-pencil"></i> 
      </a>      
    </td>
  </tr>
  @endforeach
</tbody>                
</table>
<!--  Suma del total-->
</div>
<!-- /.box-body -->
@include('sweetalert::alert')
@push ('scripts')
<script>
  $('#liC1').addClass("treeview active");
  $('#liDireccion').addClass("active");
</script>
@endpush
@endsection