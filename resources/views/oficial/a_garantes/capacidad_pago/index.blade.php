@extends ('layouts.admin3')
@section ('contenido')

<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12" style="float:right;">
    <div class="info-box bg-yellow">
      <span class="info-box-icon"><i class="fa fa-user text-black"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Garante seleccionado</span>
        <span class="info-box-number"> </span>
        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
          {{Session::get('id_persona_oficial_garante','Usuario no seleccionado')}}
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
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
</div>


<!-- /.box-header -->
<div class="box-body">
  <table id="buscar" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Id</th>
       <th>Porcentaje</th>             
       <th>Amortizacion Coop. San Martín</th>              
       <th>Acción</th>              
     </tr>
   </thead>
   <tbody>
    @foreach ($capacidad as $capa)
    <tr>
      <td>{{$capa->id_capacidad_pago}}</td>
      <td>{{$capa->porcentaje}}</td>
      <td>{{$capa->amortizacion_coop_san_martin}}</td>      
      <td> <a href="{{url('/oficial/a_garantes/capacidad_pago/'.$capa->id_capacidad_pago.'/edit')}}" rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
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
  $('#liGarante').addClass("treeview active");
  $('#liGarante_sub_capacidad_pago').addClass("active");
</script>
@endpush
@endsection