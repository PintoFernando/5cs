@extends ('layouts.admin3')
@section ('contenido')

<div class="box">
  <div class="box-header">
    <h3 class="box-title">Usuario</h3>  
  </div>

  @if(session('notification'))
  <div class="alert alert-success">
   {{session('notification')}}
 </div>
 @endif
 <!-- /.box-header -->
 <div class="box-body">
  <table id="p_user" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Rol</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $us)
      <tr>       

       <td>{{$us->name}}</td>
       <td>{{$us->email}}</td>
       <td>{{$us->rol}}</td>
       <td> <a href="{{url('/riesgos/user/'.$us->id_users.'/edit')}}" rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-pencil"></i> 
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
