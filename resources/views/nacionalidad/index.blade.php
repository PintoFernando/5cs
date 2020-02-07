@extends ('layouts.admin3')
@section ('contenido')

<div class="row">
<div class="box-header">
 <h3>Nacionalidad
  <a href="{{url('/nacionalidad/create')}}" 
  class="btn btn-success pull-right" 
  style="margin-top: -8px;">Añadir Nacionalidad</a>
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
  <table id="a_nacionalidad" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Id</th>
       <th>Nombre</th> 
       <th>Acciones</th>               
     </tr>
   </thead>
   <tbody>
    @foreach ($nacionalidad as $naci)
    <tr>
      <td>{{$naci->id_nacionalidad}}</td>
      <td>{{$naci->nacionalidad}}</td>
      <td> 
        <a href="{{url('/nacionalidad/'.$naci->id_nacionalidad.'/edit')}}" rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
          <i class="fa fa-pencil"></i> 
        </a>
        <a href="" data-target="#modal-delete-{{$naci->id_nacionalidad}}" rel="tooltip" title="Eliminar" data-toggle="modal" class="btn btn-danger btn-simple btn-xs">
         <i class="fa fa-times"></i> 
       </a>
     </td>
   </tr>
   @include('nacionalidad.modal')
   @endforeach
 </tbody>                
</table>
</div>
<!-- /.box-body -->
@include('sweetalert::alert')
@push ('scripts')
<script>
  $('#liAdmin_sistema').addClass("treeview active");
  $('#liAdmin_sistema_nacionalidad').addClass("active");
</script>
@endpush
@endsection