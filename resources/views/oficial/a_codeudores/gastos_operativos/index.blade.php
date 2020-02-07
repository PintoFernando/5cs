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
 <h4>Gastos Operativos</h4>
</div>


@if(session('notification'))
<div class="alert alert-success">
   {{session('notification')}}
</div>
@endif

<!-- /.box-header -->
<div class="box-body">
  <table id="o_gastos_operativos" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Id</th>
       <th>Combustible</th>
       <th>Depósito Almacen</th>
       <th>Energía Eléctrica</th>
       <th>Agua</th>
       <th>Gas</th>
       <th>Teléfono</th>
       <th>Impuestos</th>
       <th>Alquiler</th>
       <th>Cuidado Sereno</th>
       <th>Transporte</th>
       <th>Mantenimiento</th>
       <th>Publicidad</th>
       <th>Otros</th>                  
       <th>Detalle</th>                  
       <th>Acciones</th>                  
     </tr>
   </thead>
   <tbody>
    @foreach ($gastos as $gas)
    <tr>
      <td>{{$gas->id_gastos_operativos}}</td>
      <td>{{$gas->combustible}}</td>
      <td>{{$gas->deposito_almacen}}</td>
      <td>{{$gas->energia_electrica}}</td>
      <td>{{$gas->agua}}</td>
      <td>{{$gas->gas}}</td>
      <td>{{$gas->telefono}}</td>
      <td>{{$gas->impuestos}}</td>
      <td>{{$gas->alquiler}}</td>
      <td>{{$gas->cuidado_sereno}}</td>
      <td>{{$gas->transporte}}</td>
      <td>{{$gas->mantenimiento}}</td>
      <td>{{$gas->publicidad}}</td>
      <td>{{$gas->otros}}</td> 
      <td>{{$gas->detalle}}</td> 
     
      <td> <a href="{{url('/oficial/a_codeudores/gastos_operativos/'.$gas->id_gastos_operativos.'/edit')}}" rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
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
  $('#liCodeudor').addClass("treeview active");
  $('#liCodeudor_sub_gastos_operativos').addClass("active");
</script>
@endpush
@endsection