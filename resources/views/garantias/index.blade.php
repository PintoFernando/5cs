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
 <h3>Garantias
  <a href="{{url('/garantias/create')}}" class="btn btn-success btn-lg pull-right" style="margin-top: -8px;">Añadir Garantia</a>
</h3>
</div>


@if(session('notification'))
<div class="alert alert-success">
   {{session('notification')}}
</div>
@endif

<!-- /.box-header -->
<div class="box-body">
  <table id="a_garantias" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Id</th>
       <th>Tipo Garantia</th>          
       <th>id Crédito</th>          
       <th>Acciones</th>               
     </tr>
   </thead>
   <tbody>
    @foreach ($garantia as $gara)
    <tr>
      <td>{{$gara->id_garantia}}</td>
      <td>{{$gara->tipo_garantia}}</td>
      <td>{{$gara->id_credito}}</td>

      <td> <a href="{{url('/garantias/'.$gara->id_garantia.'/edit')}}" rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-pencil"></i> 
      </a>
      <a href="" data-target="#modal-delete-{{$gara->id_garantia}}" rel="tooltip" title="Eliminar" data-toggle="modal" class="btn btn-danger btn-simple btn-xs">
         <i class="fa fa-times"></i> 
       </a>
    </td>
  </tr>
  @include('garantias.modal')
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
  $('#liAdmin_garantia').addClass("active");
</script>
@endpush
@endsection