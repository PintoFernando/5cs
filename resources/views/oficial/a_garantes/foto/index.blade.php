@extends ('layouts.admin3')
@section ('contenido')

<div class="box-header">
 <h3>Fotografia
  <a href="{{url('/oficial/foto/create')}}" 
  class="btn btn-success pull-right" 
  style="margin-top: -8px;">Añadir Fotografía</a>
</h3>
</div>

<div class="box-header">
</div>
@if(session('notification'))
<div class="alert alert-success">
   {{session('notification')}}
</div>
@endif
<!-- /.box-header -->
<div class="box-body">
  <table id="o_garante" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Id</th>
       <th>Categoria</th>
       <th>Foto</th>
       <th>Acciones</th>               
     </tr>
   </thead>
   <tbody>
  @foreach ($fotos as $fo)
    <tr>    
      <td>{{$fo->id_foto}}</td>
      <td>{{$fo->categoria}}</td>
      <td>{{$fo->archivo}}</td>  
      <td> 
      <a href="{{url('/oficial/foto/'.$fo->id_foto.'/edit')}}" rel="tooltip" title="Editar foto" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-pencil"></i> 
      </a>
      <a href="" data-target="#modal-delete-{{$fo->id_foto}}" rel="tooltip" title="Eliminar" data-toggle="modal" class="btn btn-danger btn-simple btn-xs">
                         <i class="fa fa-times"></i> 
      </a>
    </td>
  </tr>
  @include('oficial.foto.modal')
  @endforeach
</tbody>                
</table>
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