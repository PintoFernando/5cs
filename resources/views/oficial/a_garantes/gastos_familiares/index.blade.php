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
 <h3>Gastos Familiares Garante
  <a href="{{url('/oficial/a_garantes/gastos_familiares/create')}}" 
  class="btn btn-success pull-right" 
  style="margin-top: -8px;">Añadir Gastos Familiares</a>
</h3>
</div>

<!-- /.box-header -->
<div class="box-body">
  <table id="o_gastos_familiares" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Id</th>
       <th>Alimentacion</th>
       <th>Energía Eléctrica</th>
       <th>Agua</th>              
       <th>Telefóno</th>               
       <th>Gas</th>               
       <th>Impuestos</th>               
       <th>Alquileres</th>               
       <th>Educacion</th>               
       <th>Transporte</th>               
       <th>Salud</th>               
       <th>Empleada</th>               
       <th>Diversion</th>               
       <th>Vestimenta</th>               
       <th>Otros gastos</th> 
       <th>Total</th>      
       <th>Acciones</th>               
     </tr>
   </thead>
   <tbody>
    @foreach ($gastos as $gas)
    <tr>
      <td>{{$gas->id_gastos_familiares}}</td>
      <td>{{$gas->alimentacion}}</td>
      <td>{{$gas->energia_electrica}}</td>
      <td>{{$gas->agua}}</td>
      <td>{{$gas->telefono}}</td>
      <td>{{$gas->gas}}</td>
      <td>{{$gas->impuestos}}</td>
      <td>{{$gas->alquileres}}</td>
      <td>{{$gas->educacion}}</td>
      <td>{{$gas->transporte}}</td>
      <td>{{$gas->salud}}</td>
      <td>{{$gas->empleada}}</td>
      <td>{{$gas->diversion}}</td>
      <td>{{$gas->vestimenta}}</td>
      <td>{{$gas->otros}}</td>
      <td>{{$total_gastos}}</td>
     
      <td> 
        <a href="{{url('/oficial/a_garantes/gastos_familiares/'.$gas->id_gastos_familiares.'/edit')}}" rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
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
  $('#liGarante_sub_gastos_familiares').addClass("active");
</script>
@endpush
@endsection