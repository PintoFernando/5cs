@extends ('layouts.admin3')
@section ('contenido')

<div class="box">
  <div class="box-header">
    <h3 class="box-title">Listado de usuarios del sistema</h3>
    <a href="{{url('/user/crud/create')}}" style="float:right;"><button class="btn btn-success">Nuevo Usuario</button></a>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="a_user" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Id</th>
          <th>Nombre</th>
          <th>Correo</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $us)
        <tr>       

         <td>{{$us->id_users}}</td>
         <td>{{$us->name}}</td>
         <td>{{$us->email}}</td>
         <td> <a href="{{url('/user/crud/'.$us->id_users.'/edit')}}" rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
          <i class="fa fa-pencil"></i> 
        </a>

        <a href="" data-target="#modal-delete-{{$us->id_users}}" rel="tooltip" title="Eliminar" data-toggle="modal" class="btn btn-danger btn-simple btn-xs">
         <i class="fa fa-times"></i> 
       </a>
     </td>
   </tr>
   @include('user.crud.modal')
   @endforeach
 </tbody>                
</table>
</div>
<!-- /.box-body -->
</div>

@endsection
