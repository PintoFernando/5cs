@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
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
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
</div>

<div class="box-header">
 <h3>Listado de Inmuebles
  <a href="{{url('/inmueble/create')}}" 
  class="btn btn-success pull-right" 
  style="margin-top: -8px;">Añadir Inmueble</a>
</h3>
</div>


@if(session('notification'))
<div class="alert alert-success">
 {{session('notification')}}
</div>
@endif

<!-- /.box-header -->
<div class="box-body">
  <table id="o_inmueble" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Id</th>
       <th>Ciudad</th>
       <th>Calle</th>
       <th>Numero</th>              
       <th>Zona</th>               
       <th>Numero Folio Real</th>               
       <th>Fecha de Registro</th>               
       <th>En Garantia</th>                              
       <th>Valor</th>                              
       <th>Acción</th>                              
     </tr>
   </thead>
   <tbody>
    @foreach ($inmuebles as $in)
    <tr>
      <td>{{$in->id_inmueble}}</td>
      <td>{{$in->ciudad}}</td>
      <td>{{$in->calle}}</td>
      <td>{{$in->numero}}</td>
      <td>{{$in->zona}}</td>
      <td>{{$in->num_folio_real}}</td>
      <td>{{$in->fecha_registro}}</td>
      <td>{{$in->en_garantia}}</td>
      <td>{{$in->valor}}</td>
      
      <td> <a href="{{url('/inmueble/'.$in->id_inmueble.'/edit')}}" rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-pencil"></i> 
      </a>

      <a href="" data-target="#modal-delete-{{$in->id_inmueble}}" rel="tooltip" title="Eliminar" data-toggle="modal" class="btn btn-danger btn-simple btn-xs">
         <i class="fa fa-times"></i> 
       </a>      
    </td>
  </tr>
  @include('inmueble.modal')
  @endforeach
</tbody>                
</table>
<!--  Suma del total-->
</div>
<!-- /.box-body -->
@include('sweetalert::alert')
@push ('scripts')
<script>
  $('#liAdmin').addClass("treeview active");
  $('#liAdmin_inmuebles').addClass("active");
</script>
@endpush
@endsection