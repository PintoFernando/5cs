@extends ('layouts.admin3')
@section ('contenido')
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
    </div>
  </div>
<!-- div usuario seleccionado-->
</div>




<div class="box-header" >
<a href="{{url('/oficial/foto/'.$id2.'/agregar')}} "  
 
  
  class="btn btn-success pull-middle" 
  
  style="margin-top: -8px;">Agregar Nueva Foto </a>

<h3> Crédito de Seguimiento: {{$idfoto}} </h3>



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
       <th>Fecha</th>
       
       <th>Foto</th>
       <th>Descripcion</th>
       <th>Acciones</th>               
     </tr>
   </thead>
   <tbody>
  @foreach ($fotos as $fo)
    <tr> 
       <td>{{$loop->iteration}}</td>   
      <td>{{$fo->created_at}}</td>
      
      <td>
						<img src="{{asset('images/fotos/'.$fo->archivo)}}" alt="{{ $fo->archivo}}" height="75px" width="75px" class="img-thumbnail">
          
			</td>
      </form>
      <td>   {{$fo->detalle}}  </td> 
      
      <td> 
      <a href="{{url('/oficial/foto/'.$fo->id_foto.'/'.$id2.'/edit')}}" rel="tooltip" title="Editar foto" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-pencil"></i> 
      </a>

      <a href="{{url('/oficial/foto/'.$fo->id_foto.'/descarga')}}" rel="tooltip" title="Descargar fotografía" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-download"></i> 
      </a>

      <a href="" data-target="#modal-delete-{{$fo->id_foto}}" rel="tooltip" title="Eliminar" data-toggle="modal" class="btn btn-danger btn-simple btn-xs">
                         <i class="fa fa-times"></i> 
      </a>
    </td>
  </tr>
  @include('oficial.foto.modal')
  
  @endforeach
</tbody> 
</div>               
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
