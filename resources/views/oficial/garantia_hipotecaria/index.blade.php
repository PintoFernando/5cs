@extends ('layouts.admin3')
@section ('contenido')
<div class="box-header">
 <h4>Garantia Hipotecaria
  <a href="{{url('/oficial/garantia_hipotecaria/create')}}" class="btn btn-success pull-right" style="margin-top: -8px;">Añadir Garantia Hipotecaria</a>
</h4>
</div>

@if(session('notification'))
<div class="alert alert-success">
 {{session('notification')}}
</div>
@endif
<!-- /.box-header -->
<div class="box-body">
  <table id="o_garantia_hipotecaria" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Id</th>
       <th>Nombres Dueños de la Garantia</th>              
       <th>Tipo Propiedad</th>              
       <th>Ubicación Bien</th>              
       <th>Libro DD.RR.</th>              
       <th>Matricula</th>              
       <th>Partida</th>              
       <th>Valor Comercial vivienda</th>              
       <th>Valor de Avalúo vivienda</th>              
       <th>Empresa Valuadora</th>              
       <th>Tipo vehículo</th>              
       <th>Vehiculo Subtipo</th>              
       <th>Marca Vehículo</th>              
       <th>Modelo Vehículo</th>              
       <th>RUA</th>              
       <th>Placa</th>              
       <th>Clase</th>              
       <th>Vehículo número de motor</th>              
       <th>Vehículo Chasis</th>              
       <th>Vehículo Procedencia</th>              
       <th>Vehículo Cilindrada</th>              
       <th>Vehículo número de póliza</th>              
       <th>Vehículo color</th>              
       <th>Valor Comercial Vehículo</th>              
       <th>Valor avalúo Vehículo</th>              
       <th>Empresa Valuadora vehiculo</th>                            
       <th>Nombre Apellido titular 1 DPF</th>              
       <th>Nombre Apellido titular 2 DPF</th>              
       <th>Entidad Emisora del DPF</th>              
       <th>N° DPF</th>              
       <th>Monto</th>              
       <th>Fecha Apertura</th>              
       <th>Fecha Vencimiento</th>              
       <th>Acciones</th>               
     </tr>
   </thead>
   <tbody>
    @foreach ($hipotecaria as $hipo)
    <tr>
      <td>{{$hipo->id_garantia_hipotecaria}}</td>  
      <td>{{$hipo->nombre_ap_propietario}}</td>  
      <td>{{$hipo->vivi_tipo}}</td>  
      <td>{{$hipo->vivi_ubicacion_bien}}</td>  
      <td>{{$hipo->vivi_libro_ddrr}}</td>  
      <td>{{$hipo->vivi_matricula}}</td>  
      <td>{{$hipo->vivi_partida}}</td> 
      <td>{{$hipo->vivi_valor_comercial}}</td>  
      <td>{{$hipo->vivi_valor_avaluo}}</td>  
      <td>{{$hipo->vivi_empresa_valuadora}}</td>  
      <td>{{$hipo->vehi_tipo}}</td>  
      <td>{{$hipo->vehi_subtipo}}</td>  
      <td>{{$hipo->vehi_marca}}</td>  
      <td>{{$hipo->vehi_modelo}}</td>  
      <td>{{$hipo->vehi_rua}}</td>  
      <td>{{$hipo->vehi_placa}}</td>  
      <td>{{$hipo->vehi_clase}}</td>  
      <td>{{$hipo->vehi_num_motor}}</td>  
      <td>{{$hipo->vehi_chasis}}</td>  
      <td>{{$hipo->vehi_procedencia}}</td>  
      <td>{{$hipo->vehi_cilindrada}}</td>  
      <td>{{$hipo->vehi_num_poliza}}</td>  
      <td>{{$hipo->vehi_color}}</td>  
      <td>{{$hipo->vehi_valor_comercial}}</td>  
      <td>{{$hipo->vehi_valor_avaluo}}</td>  
      <td>{{$hipo->vehi_empresa_valuadora}}</td>  
      <td>{{$hipo->depo_nombres_titular_dpf1}}</td>  
      <td>{{$hipo->depo_nombres_titular_dpf2}}</td>  
      <td>{{$hipo->depo_entidad_emisora}}</td>  
      <td>{{$hipo->depo_num_dpf}}</td>  
      <td>{{$hipo->depo_monto}}</td>
      <td>{{$hipo->depo_fecha_apertura}}</td>
      <td>{{$hipo->depo_fecha_vencimiento}}</td>
      <td> <a href="{{url('/oficial/garantia_hipotecaria/'.$hipo->id_garantia_hipotecaria.'/edit')}}" rel="tooltip" title="Editar Persona" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-pencil"></i> 
      </a>
      </td>
  </tr>
  @endforeach
</tbody>                
</table>
</div>
<!-- /.box-body -->

@include('sweetalert::alert')
@push ('scripts')
<script>
  $('#liGarantiaHipotecaria').addClass("active");
</script>
@endpush
@endsection