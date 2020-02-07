@extends ('layouts.admin3')
@section ('contenido')

<div class="box-header">
 <h4>Ingreso Mensual
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
      <td> <a href="{{url('/oficial/ingreso_mensual/'.$ing->id_ingreso_mensual.'/edit')}}" rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
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
  $('#liC3').addClass("treeview active");
  $('#liIngresoMensual').addClass("active");
</script>
@endpush
@endsection