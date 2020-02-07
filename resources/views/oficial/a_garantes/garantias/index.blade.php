@extends ('layouts.admin3')
@section ('contenido')

<div class="box-header">
 <h4>Garantias
  <a href="{{url('/oficial/garantias/create')}}" class="btn btn-success pull-right" style="margin-top: -8px;">Añadir Garantia</a>
</h4>
</div>

<!-- /.box-header -->
<div class="box-body">
  <table id="o_garantias" class="table table-bordered table-striped">
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

      <td> <a href="{{url('/oficial/garantias/'.$gara->id_garantia.'/edit')}}" rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
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
@push ('scripts')
<script>
  $('#liC1').addClass("treeview active");
  $('#liGarantia').addClass("active");
</script>
@endpush
@endsection