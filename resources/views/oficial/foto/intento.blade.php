
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

<h3> Crédito de Seguimiento: {{$idfoto}} </h3>

<form action="">
  
   
 
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
       <th>Titulo</th>
       <th>Fecha Creacion</th>
       <th>Acciones</th>               
     </tr>
   </thead>
   <tbody>
  @foreach ($seguimientofoto as $fo)
    <tr> 
       <td>{{$loop->iteration}}</td>   
      <td>{{$fo->descripcion}}</td>
      
    </form>
      <td>   {{$fo->created_at}}  </td> 
      
      <td> 
      <a href="{{url('/oficial/foto/'.$fo->id_seguimiento_foto.'/listafoto')}}" rel="tooltip" title="Ver Imagenes" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-eye "></i> 
      </a> 
    <!--  <a href="" data-target="#modal-delete-{{$fo->id_seguimiento_foto}}" rel="tooltip" title="Eliminar" data-toggle="modal" class="btn btn-danger btn-simple btn-xs">
                         <i class="fa fa-times"></i> 
      </a>-->
    </td>
  </tr>

  @include('oficial.foto.modal2')
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

