@extends ('layouts.admin3')
@section ('contenido')



<div class="box-header">
 <h3>Detalle Conyugue
  <a href="{{url('/detalle_conyugue/create')}}" 
  class="btn btn-success pull-right" 
  style="margin-top: -8px;">Añadir Detalle Conyugue</a>
</h3>
</div>
@if(session('notification'))
<div class="alert alert-success">
   {{session('notification')}}
</div>
@endif
<!-- /.box-header -->
<div class="box-body">
  <table id="o_detalle_conyugue" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Id</th>
       <th>Ocupación</th>
       <th>Cargo</th>
       <th>Tiempo Trabajo</th>
       <th>Nombre Institución</th>
       <th>Calle Principal</th>
       <th>Calle Secundaria</th>
       <th>Teléfono</th>
       <th>Acciones</th>               
     </tr>
   </thead>
   <tbody>
    @foreach ($detalle as $de)
    <tr>
      <td>{{$de->id_detalle_persona}}</td>
      <td>{{$de->ocupacion}}</td>
      <td>{{$de->cargo}}</td>
      <td>{{$de->tiempo_trabajo}}</td>
      <td>{{$de->nombre_institucion}}</td>
      <td>{{$de->calle_principal}}</td>
      <td>{{$de->calle_secundaria}}</td>
      <td>{{$de->telefono}}</td> 
      <td> <a href="{{url('/detalle_conyugue/'.$de->id_detalle_persona.'/edit')}}" rel="tooltip" title="Editar " class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-pencil"></i> 
      </a>

      <a href="" data-target="#modal-delete-{{$de->id_detalle_persona}}" rel="tooltip" title="Eliminar" data-toggle="modal" class="btn btn-danger btn-simple btn-xs">
         <i class="fa fa-times"></i> 
       </a>
    </td>
  </tr>
  @include('detalle_conyugue.modal')
  @endforeach
</tbody>                
</table>
</div>
<!-- /.box-body -->
@include('sweetalert::alert')
@push ('scripts')
<script>
  $('#liAdmin').addClass("treeview active");
  $('#liAdmin_detalle_conyugue').addClass("active");
</script>
@endpush
@endsection