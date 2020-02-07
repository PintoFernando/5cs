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
 <h3>Cuentas documentos por cobrar
  <a href="{{url('/oficial/cuentas_documentos_cobrar/create')}}" 
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
               <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
               <th>Id</th>
               <th>Nit</th>
               <th>Nombre Razón Social</th>
               <th>Concepto</th>
               <th>Saldo</th>            
               <th>Acción</th>
               
                    </thead>
                    <tbody>
               @foreach ($cuentas as $cue)
                    <tr>
               <td>{{$cue->id_cuentas_docu}} </td>
               <td>{{$cue->nit}} </td>
               <td>{{$cue->nombre_razon_social}} </td>
               <td>{{$cue->concepto}} </td>
               <td>{{$cue->saldo}} </td>
              
               <td>
                     <a href="{{url('/oficial/cuentas_documentos_cobrar/'.$cue->id_cuentas_docu.'/edit')}}" rel="tooltip" title="Cuenta documentos por cobrar" class="btn btn-success btn-simple btn-xs">
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
  $('#liC2').addClass("treeview active");
  $('#liCuentasDocumentosCobrar').addClass("active");
</script>
@endpush
@endsection