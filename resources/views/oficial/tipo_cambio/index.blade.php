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

<div class="box-header">
 <h3>Tipo de Cambio
  <a href="{{url('/oficial/tipo_cambio/create')}}" 
  class="btn btn-success pull-right" 
  style="margin-top: -8px;">Añadir</a>
</h3>
</div>

@if(session('notification'))
<div class="alert alert-success">
 {{session('notification')}}
</div>
@endif

<div class="row">
 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="table-responsive">
   <table id='o_vehiculo' class="table table-striped table-bordered table-condensed table-hover">
    <thead>
     <th>Id</th>
     <th>Tipo de cambio</th>
     <th>Acción</th>    

   </thead>
   <tbody>
     @foreach ($cambios as $ca)
     <tr>
       <td>{{$ca->id_tipo_cambio}} </td>
       <td>{{$ca->cambio}} </td>     
     

      <td>
       <a href="{{url('/oficial/tipo_cambio/'.$ca->id_tipo_cambio.'/edit')}}" rel="tooltip" title="Editar " class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-edit"></i> 
      </a>

    </td>
  </tr>
  @endforeach
</tbody>
</table>
</div>
</div>
</div>
@include('sweetalert::alert')

@push ('scripts')
<script>
  $('#liC1').addClass("treeview active");
  $('#liTipoCambio').addClass("active");
</script>
@endpush
@endsection