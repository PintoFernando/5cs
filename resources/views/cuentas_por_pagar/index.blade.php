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
 <h3>Cuentas por Pagar
  <a href="{{url('/cuentas_por_pagar/create')}}" 
  class="btn btn-success pull-right" 
  style="margin-top: -8px;">Añadir Cuentas</a>
</h3>
</div>

@if(session('notification'))
<div class="alert alert-success">
 {{session('notification')}}
</div>
@endif

<div class="box-dody">
 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="table-responsive">
   <table id="o_cuentas_pagar" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
     <th>Id</th>
     <th>Institución</th>
     <th>Tiempo</th>
     <th>Cuota Mensual</th>
     <th>Saldo</th>
     <th>Acción</th>

   </thead>
   <tbody>
     @foreach ($pagar as $pa)
     <tr>
       <td>{{$pa->id_cppagar}} </td>
       <td>{{$pa->institucion}} </td>
       <td>{{$pa->tiempo}} </td>
       <td>{{$pa->cuota_mensual}} </td>
       <td>{{$pa->saldo}} </td>
       <td>
         <a href="{{url('/cuentas_por_pagar/'.$pa->id_cppagar.'/edit')}}" rel="tooltip" title="Cuenta por pagar" class="btn btn-success btn-simple btn-xs">
          <i class="fa fa-edit"></i> 
        </a>


        <a href="" data-target="#modal-delete-{{$pa->id_cppagar}}" rel="tooltip" title="Eliminar" data-toggle="modal" class="btn btn-danger btn-simple btn-xs">
         <i class="fa fa-times"></i> 
       </a>

       
      </td>
    </tr>
    @include('cuentas_por_pagar.modal')
    @endforeach
  </tbody>
</table>
</div>
</div>
</div>
@include('sweetalert::alert')
@push ('scripts')
<script>
  $('#liAdmin').addClass("treeview active");
  $('#liAdmin_cuentas_pagar').addClass("active");
</script>
@endpush
@endsection