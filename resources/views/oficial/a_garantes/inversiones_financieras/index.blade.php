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


<div class="box-header">
 <h3>Inversiones Financieras Garantes
  <a href="{{url('/oficial/a_garantes/inversiones_financieras/create')}}" 
  class="btn btn-success pull-right" 
  style="margin-top: -8px;">Añadir Inversion Financiera</a>
</h3>
</div>
<!-- /.box-header -->
<div class="box-body">
  <table id="o_financiera" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Id</th>
       <th>Cantidad</th>
       <th>Porcentaje Patrimonio Empresarial</th>
       <th>NIT</th>              
       <th>Nombre Empresa</th>               
       <th>Valor Nominal</th>               
       <th>Valor de Mercado</th>               
       <th>Detalle</th>               
       <th>Acción</th>               
                      
     </tr>
   </thead>
   <tbody>
    @foreach ($inversiones as $in)
    <tr>
      <td>{{$in->id_inversion_financiera}}</td>
      <td>{{$in->cantidad}}</td>
      <td>{{$in->porcentaje_patrimonio_empre}}</td>
      <td>{{$in->nit}}</td>
      <td>{{$in->nombre_empresa}}</td>
      <td>{{$in->valor_nominal}}</td>
      <td>{{$in->valor_mercado}}</td>
      <td>{{$in->detalle}}</td>
      
      <td> <a href="{{url('/oficial/a_garantes/inversiones_financieras/'.$in->id_inversion_financiera.'/edit')}}" rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
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
@push ('scripts')
<script>
  $('#liGarante').addClass("treeview active");
  $('#liGarante_sub_inversion').addClass("active");
</script>
@endpush
@endsection