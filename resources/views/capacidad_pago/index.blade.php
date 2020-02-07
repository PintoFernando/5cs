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

<div class="row">
<div class="box-header">
 <h3>Amortización Coop. San Martin
  <a href="{{url('/capacidad_pago/create')}}" 
  class="btn btn-success pull-right" 
  style="margin-top: -8px;">Añadir Amortización Coop San Martin</a>
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
  <table id="buscar" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Id</th>
       <th>Porcentaje</th>             
       <th>Amortizacion Coop. San Martín</th>              
       <th>Acción</th>              
     </tr>
   </thead>
   <tbody>
    @foreach ($capacidad as $capa)
    <tr>
      <td>{{$capa->id_capacidad_pago}}</td>
      <td>{{$capa->porcentaje}}</td>
      <td>{{$capa->amortizacion_coop_san_martin}}</td>      
      <td> <a href="{{url('/capacidad_pago/'.$capa->id_capacidad_pago.'/edit')}}" rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-pencil"></i> 
      </a>  
       <a href="" data-target="#modal-delete-{{$capa->id_capacidad_pago}}" rel="tooltip" title="Eliminar" data-toggle="modal" class="btn btn-danger btn-simple btn-xs">
         <i class="fa fa-times"></i> 
       </a>    
    </td>
  </tr>
  @include('capacidad_pago.modal')
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
  $('#liAdmin_capacidad_pago').addClass("active");
</script>
@endpush
@endsection