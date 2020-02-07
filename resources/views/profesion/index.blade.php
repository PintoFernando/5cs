@extends ('layouts.admin3')
@section ('contenido')

<div class="row">
  <div class="box-header">
   <h3>Profesión
    <a href="{{url('/profesion/create')}}" 
    class="btn btn-success pull-right" 
    style="margin-top: -8px;">Añadir Profesion</a>
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
       <th>Profesion</th> 
       <th>Acciones</th>               
     </tr>
   </thead>
   <tbody>
    @foreach ($profesiones as $pro)
    <tr>
      <td>{{$pro->id_profesion}}</td>
      <td>{{$pro->profesion}}</td>
      <td> 
        <a href="{{url('/profesion/'.$pro->id_profesion.'/edit')}}" rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
          <i class="fa fa-pencil"></i> 
        </a>
        <a href="" data-target="#modal-delete-{{$pro->id_profesion}}" rel="tooltip" title="Eliminar" data-toggle="modal" class="btn btn-danger btn-simple btn-xs">
         <i class="fa fa-times"></i> 
       </a>
     </td>
   </tr>
   @include('profesion.modal')
   @endforeach
 </tbody>                
</table>
</div>
<!-- /.box-body -->
@include('sweetalert::alert')
@push ('scripts')
<script>
  $('#liAdmin_sistema').addClass("treeview active");
  $('#liAdmin_sistema_profesion').addClass("active");
</script>
@endpush
@endsection