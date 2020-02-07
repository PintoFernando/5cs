@extends ('layouts.admin3')
@section ('contenido')

<div class="box-header">
 <h3>Lista de archivos
  <a href="{{url('/oficial/archivo/create')}}" 
  class="btn btn-success pull-right" 
  style="margin-top: -8px;">Añadir archivo</a>
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
       <th>Archivo</th>
       <th>Acciones</th>               
     </tr>
   </thead>
   <tbody>
  @foreach ($archivos as $ar)
    <tr>    
      <td>{{$ar->id_archivo}}</td>
      <td>{{$ar->categoria}}</td>
      <td>
						<img src="{{asset('archivos/'.$ar->archivo)}}" alt="{{ $ar->archivo}}" height="75px" width="75px" class="img-thumbnail">
			</td>
      <td> 
      <a href="{{url('/oficial/archivo/'.$ar->id_archivo.'/edit')}}" rel="tooltip" title="Editar archivo" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-pencil"></i> 
      </a>

      <a href="{{url('/oficial/archivo/'.$ar->id_archivo.'/descarga')}}" rel="tooltip" title="Descargar Archivo" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-download"></i> 
      </a>

      <a href="" data-target="#modal-delete-{{$ar->id_archivo}}" rel="tooltip" title="Eliminar" data-toggle="modal" class="btn btn-danger btn-simple btn-xs">
                         <i class="fa fa-times"></i> 
      </a>
    </td>
  </tr>
  @include('oficial.archivo.modal')
  @endforeach
</tbody>                
</table>
</div>
<!-- /.box-body -->
@include('sweetalert::alert')
@push ('scripts')
<script>
  $('#liArchivos').addClass("treeview active");
  $('#liArchivo').addClass("active");
</script>
@endpush
@endsection