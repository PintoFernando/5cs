@extends ('layouts.admin3')
@section ('contenido')

<!-- div usuario seleccionado-->
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12" style="float:right;">
    <div class="info-box bg-light-blue">
      <span class="info-box-icon"><i class="fa fa-user text-orange"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Codeudor seleccionado</span>
        <span class="info-box-number"> </span>
        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
          {{Session::get('id_persona_oficial_codeudor','Codeudor no seleccionado')}}
        </span>
      </div>
    </div>
  </div>
  
  <div class="col-md-3 col-sm-6 col-xs-12" style="float:right;">
    <div class="info-box bg-green">
      <span class="info-box-icon"><i class="fa fa-user"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">S. Seleccionado</span>
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
</div>
<!-- div usuario seleccionado-->
<div class="box-header">
 <h4>Ingreso mensual
  <a href="{{url('/oficial/a_codeudores/ingreso_mensual/create')}}" class="btn btn-success pull-right" style="margin-top: -8px;">Añadir Ingreso Mensual</a>
</h4>
</div>
<!-- /.box-header -->
<div class="box-body">
  <table id="o_venta_comercializacion" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Id</th>
       <th>Mes</th>
       <th>Año</th>
       <th>Prestatario</th>              
       <th>Conyugue</th>              
       <th>Otros</th>              
       <th>Codeudores</th>              
       <th>Total Ingreso</th>              
       <th>Descripcion</th>              
       <!--<th>Acción</th>  -->             
     </tr>
   </thead>
   <tbody>
    @foreach ($ingreso as $ing)
    <tr>
      <td>{{$ing->id_ingreso_mensual}}</td>
      <td>{{$ing->mes}}</td>
      <td>{{$ing->anio}}</td>
      <td>{{$ing->prestatario}}</td>
      <td>{{$ing->conyugue}}</td>
      <td>{{$ing->otros}}</td>
      <td>{{$ing->codeudores}}</td>
      <td>{{$ing->total_ingreso}}</td>
      <td>{{$ing->descripcion}}</td>
      <td> <a href="{{url('/oficial/a_codeudores/ingreso_mensual/'.$ing->id_ingreso_mensual.'/edit')}}" rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-pencil"></i> 
      </a>
    </td>
  </tr>
  @endforeach
</tbody>                
</table>
<!--  Suma del total-->
</div>
<!-- /.box-body -->
@include('sweetalert::alert')
@include('sweetalert::alert')
@push ('scripts')
<script>
  $('#liCodeudor').addClass("treeview active");
  $('#liCodeudor_sub_ingresos').addClass("active");
</script>
@endpush
@endsection