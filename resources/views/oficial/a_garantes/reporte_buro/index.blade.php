@extends ('layouts.admin3')
@section ('contenido')

<div class="box-header">
 <h3>Reporte Buro
  <a href="{{url('/oficial/reporte_buro/create')}}" class="btn btn-success pull-right" 
  style="margin-top: -8px;">Añadir Reporte Buro</a>
</h3>
</div>

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
      <td> <a href="{{url('/oficial/reporte_buro/'.$reporte->id_reporte_buro.'/edit')}}" 
      rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-edit"></i> 
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
@push ('scripts')
<script>
  $('#liC1').addClass("treeview active");
  $('#liReporteBuro').addClass("active");
</script>
@endpush
@endsection