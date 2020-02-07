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
 <h3>Inventario de Mercaderia
  <a href="{{url('/inventario_mercaderia/create')}}" 
  class="btn btn-success pull-right" 
  style="margin-top: -8px;">Añadir Inventario</a>
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
   <table id="o_inventario" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
     <th>Id</th>
     <th>Detalle</th>
     <th>Cantidad</th>
     <th>Unidad Medida</th>
     <th>Precio Unitario</th>
     <th>Total</th>
     <th>Acción</th>

   </thead>
   <tbody>
     @foreach ($inventario as $in)
     <tr>
       <td>{{$in->id_imercaderia}} </td>
       <td>{{$in->detalle}} </td>
       <td>{{$in->cantidad}} </td>
       <td>{{$in->unidad_medida}} </td>
       <td>{{$in->precio_unitario}} </td>
       <td>{{$in->total}} </td>
       <td>
         <a href="{{url('/inventario_mercaderia/'.$in->id_imercaderia.'/edit')}}" rel="tooltip" title="Editar Vehiculo" class="btn btn-success btn-simple btn-xs">
          <i class="fa fa-edit"></i> 
        </a>

        <a href="" data-target="#modal-delete-{{$in->id_imercaderia}}" rel="tooltip" title="Eliminar" data-toggle="modal" class="btn btn-danger btn-simple btn-xs">
         <i class="fa fa-times"></i> 
       </a>
      </td>
    </tr>
    @include('inventario_mercaderia.modal')
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
  $('#liAdmin_inventario_mercaderia').addClass("active");
</script>
@endpush
@endsection