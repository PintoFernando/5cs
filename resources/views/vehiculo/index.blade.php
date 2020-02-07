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
 <h3>Listado de Vehiculos
  <a href="{{url('/vehiculo/create')}}" 
  class="btn btn-success pull-right" 
  style="margin-top: -8px;">Añadir Vehiculo</a>
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
     <th>Tipo</th>
     <th>Marca</th>
     <th>Modelo</th>
     <th>Placa</th>
     <th>Rua</th>
     <th>En garantia</th>
     <th>Valor</th>
     <th>Acción</th>    

   </thead>
   <tbody>
     @foreach ($vehiculos as $ve)
     <tr>
       <td>{{$ve->id_vehiculo}} </td>
       <td>{{$ve->tipo}} </td>
       <td>{{$ve->marca}} </td>
       <td>{{$ve->modelo}} </td>
       <td>{{$ve->placa}} </td>
       <td>{{$ve->rua}} </td>

       <td>@if($ve->en_garantia==1)
        Si
        @else
        No
        @endif
      </td>
      <td>{{$ve->valor}} </td>

      <td>
       <a href="{{url('/vehiculo/'.$ve->id_vehiculo.'/edit')}}" rel="tooltip" title="Editar Vehiculo" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-edit"></i> 
      </a>

      <a href="" data-target="#modal-delete-{{$ve->id_vehiculo}}" rel="tooltip" title="Eliminar" data-toggle="modal" class="btn btn-danger btn-simple btn-xs">
         <i class="fa fa-times"></i> 
       </a>

    </td>
  </tr>
  @include('vehiculo.modal')
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
  $('#liAdmin_vehiculos').addClass("active");
</script>
@endpush
@endsection