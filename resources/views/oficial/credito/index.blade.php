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

<div class="row">
<div class="box-header">
 <h3>Crédito
  <a href="{{url('/oficial/credito/create')}}" 
  class="btn btn-success pull-right" 
  style="margin-top: -8px;">Añadir Crédito</a>
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
  <table id="o_credito" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Id</th>
       <th>Fecha de Solicitud</th>
       <th>Monto Solicitado</th>
       <th>Interes Nominal</th>              
       <th>Plazo en Meses</th>               
       <th>Dia de Pago</th>                              
       <th>Tipo de Moneda</th>                              
       <th>Periodo de Pago</th>                              
       <th>Tasa de Amortización</th>                              
       <th>Tipo de Crédito</th>                              
       <th>Destino del Crédito</th>                              
       <th>Origen de fondos</th>                              
       <th>Acción</th>                              
     </tr>
   </thead>
   <tbody>
    @foreach ($creditos as $cre)
    <tr>
      <td>{{$cre->id_credito}}</td>
      <td>{{$cre->fecha_solicitud}}</td>
      <td>{{$cre->monto_solicitado}}</td>
      <td>{{$cre->interes_nominal}}</td>
      <td>{{$cre->plazo_meses}}</td>
      <td>{{$cre->dia_pago}}</td>
      <td>{{$cre->tipo_moneda}}</td>
      <td>{{$cre->periodo_pago}}</td>
      <td>{{$cre->amortizacion}}</td>
      <td>{{$cre->tipo_credito}}</td>
      <td>{{$cre->destino_credito}}</td>
      <td>{{$cre->nombre}}</td>
      
      <td> <a href="{{url('/oficial/credito/'.$cre->id_credito.'/edit')}}" rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
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
$('#liCredito').addClass("active");
</script>
@endpush
@endsection