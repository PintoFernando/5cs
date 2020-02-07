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
 <h3>Reporte Buro
  <a href="{{url('/reporte_buro/create')}}" class="btn btn-success pull-right" 
  style="margin-top: -8px;">Añadir Reporte Buro</a>
</h3>
</div>

@if(session('notification'))
<div class="alert alert-success">
   {{session('notification')}}
</div>
@endif

<!-- /.box-header -->
<div class="box-body">
  <table id="o_reporte_buro" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Id</th>
       <th>Tiempo Máximo Mora</th>
       <th>Buro</th>               
       <th>Acciones</th>               
     </tr>
   </thead>
   <tbody>
    @foreach ($reporte_buro as $reporte)
    <tr>
      <td>{{$reporte->id_reporte_buro}}</td>
      <td>{{$reporte->tiempo_maximo_mora}}</td>
      <td>{{$reporte->nombre_buro}}</td>
      <td> <a href="{{url('/reporte_buro/'.$reporte->id_reporte_buro.'/edit')}}" 
      rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-edit"></i> 
      </a>

      <a href="" data-target="#modal-delete-{{$reporte->id_reporte_buro}}" rel="tooltip" title="Eliminar" data-toggle="modal" class="btn btn-danger btn-simple btn-xs">
         <i class="fa fa-times"></i> 
       </a>
    </td>
  </tr>
  @include('reporte_buro.modal')
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
  $('#liAdmin_reporte').addClass("active");
</script>
@endpush
@endsection