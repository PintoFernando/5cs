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
 <h3>Efectivos en Caja
  <a href="{{url('/oficial/efectivos_caja/create')}}" 
  class="btn btn-success pull-right" 
  style="margin-top: -8px;">Añadir Efectivo en Caja</a>
</h3>
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
       <th>Efectivos en Caja</th>
       <th>Acciones</th>               
     </tr>
   </thead>
   <tbody>
    @foreach ($efectivo as $efe)
    <tr>
      <td>{{$efe->id_efectivos_caja}}</td>
      <td>{{$efe->caja}}</td>

      <td> <a href="{{url('/oficial/efectivos_caja/'.$efe->id_efectivos_caja.'/edit')}}" rel="tooltip" title="Editar Datos Empresa" class="btn btn-success btn-simple btn-xs">
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
  $('#liC2').addClass("treeview active");
  $('#liEfectivosCaja').addClass("active");
</script>
@endpush
@endsection