@extends ('layouts.admin3')
@section ('contenido')




<div class="box-header" >
<form >
@if(session('notification'))
<div class="alert alert-success">
   {{session('notification')}}
</div>
@endif

<!-- /.box-header -->
<div class="box-body">


  <table id="o_garante" class="table table-bordered table-striped" >
    <div id="div1">
    <thead>
      <tr>
      <th>Nº</th>
      <th>ID Persona</th>
       <th>Nombre</th>
       <th>Email</th>
       <th>Fecha Creacion</th>    
       <th>Actualizar</th>           
     </tr>
   </thead>
   <tbody>
  @foreach ($users as $us)
    <tr> 
       <td>{{$loop->iteration}}</td>   
       <td>{{$us->id_persona}}</td>
       <td>{{$us->name}}</td>
       <td>{{$us->email}}</td>
       <td>{{$us->created_at}}</td>
       <td><a href="{{url('/oficial/foto/'.$us->id_users.'/edituser')}}" rel="tooltip" title="Editar foto" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-pencil"></i> 
      </a></td>
       
  </tr>
  @endforeach
</tbody> 
</div>               
</table>
</form>
</div>
<!-- /.box-body -->

@include('sweetalert::alert')
@push ('scripts')
<script>
  $('#liArchivos').addClass("treeview active");
  $('#liFotos').addClass("active");
</script>
@endpush
@endsection
