@extends ('layouts.admin3')
@section ('contenido')

<div class="row">
  <div class="box-header">
   <h3>Entidad Bancaria
    <a href="{{url('/entidad_bancaria/create')}}" 
    class="btn btn-success pull-right" 
    style="margin-top: -8px;">Añadir Entidad Bancaria</a>
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
  <table id="a_afp" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Id</th>
       <th>Nombre Entidad</th> 
       <th>Acciones</th>               
     </tr>
   </thead>
   <tbody>
    @foreach ($entidad as $ent)
    <tr>
      <td>{{$ent->id_entidad_bancaria}}</td>
      <td>{{$ent->nombre_entidad}}</td>
      <td> 
        <a href="{{url('/entidad_bancaria/'.$ent->id_entidad_bancaria.'/edit')}}" rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
          <i class="fa fa-pencil"></i> 
        </a>
        <a href="" data-target="#modal-delete-{{$ent->id_entidad_bancaria}}" rel="tooltip" title="Eliminar" data-toggle="modal" class="btn btn-danger btn-simple btn-xs">
         <i class="fa fa-times"></i> 
       </a>
     </td>
   </tr>
   @include('entidad_bancaria.modal')
   @endforeach
 </tbody>                
</table>
</div>
<!-- /.box-body -->
@include('sweetalert::alert')
@push ('scripts')
<script>
  $('#liAdmin_sistema').addClass("treeview active");
  $('#liAdmin_sistema_entidad').addClass("active");
</script>
@endpush
@endsection