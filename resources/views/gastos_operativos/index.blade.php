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
 <h3>Gastos Operativos
  <a href="{{url('/gastos_operativos/create')}}" 
  class="btn btn-success pull-right" 
  style="margin-top: -8px;">Añadir Gastos Operativos</a>
</h3>
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
       <th>Detalle - Otros</th>  
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

      <td> <a href="{{url('/gastos_operativos/'.$gas->id_gastos_operativos.'/edit')}}" rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-pencil"></i> 
      </a>  

      <a href="" data-target="#modal-delete-{{$gas->id_gastos_operativos}}" rel="tooltip" title="Eliminar" data-toggle="modal" class="btn btn-danger btn-simple btn-xs">
         <i class="fa fa-times"></i> 
       </a>    
    </td>
  </tr>
  @include('gastos_operativos.modal')
  @endforeach
</tbody>                
</table>
<!--  Suma del total-->
</div>
<!-- /.box-body -->
@include('sweetalert::alert')
@push ('scripts')
<script>
  $('#liAdmin').addClass("treeview active");
  $('#liAdmin_gastos_operativos').addClass("active");
</script>
@endpush
@endsection