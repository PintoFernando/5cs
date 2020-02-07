@extends ('layouts.admin3')
@section ('contenido')

<div class="box-header">
 <h4>Datos Empresa
  
</h4>
</div>

@if(session('notification'))
<div class="alert alert-success">
   {{session('notification')}}
</div>
@endif
<!-- /.box-header -->
<div class="box-body">
  <table id="c_datos_empresa" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Id</th>
       <th>nombre_empresa</th>
       <th>actividad_empresa</th>
       <th>antiguedad_empresa</th>
       <th>ciudad_empresa</th>
       <th>provincia_empresa</th>
       <th>zona_empresa</th>
       <th>direccion_empresa</th>
       <th>telefono_empresa</th>
       <th>cargo_en_empresa</th>
       <th>antiguedad_en_cargo</th>
       <th>horario_trabajo</th>
       <th>dias_trabajo</th>
       <th>afp</th>
       <th>Tipo Contrato</th>
       <th>Acciones</th>               
     </tr>
   </thead>
   <tbody>
    @foreach ($datos as $dat)
    <tr>
      <td>{{$dat->id_datos_empresa}}</td>
      <td>{{$dat->nombre_empresa}}</td>
      <td>{{$dat->actividad_empresa}}</td>
      <td>{{$dat->antiguedad_empresa}}</td>
      <td>{{$dat->ciudad_empresa}}</td>
      <td>{{$dat->provincia_empresa}}</td>
      <td>{{$dat->zona_empresa}}</td>
      <td>{{$dat->direccion_empresa}}</td>
      <td>{{$dat->telefono_empresa}}</td>
      <td>{{$dat->cargo_en_empresa}}</td>
      <td>{{$dat->antiguedad_en_cargo}}</td>
      <td>{{$dat->horario_trabajo}}</td>
      <td>{{$dat->dias_trabajo}}</td>
      <td>{{$dat->nombre_afp}}</td>
      <td>{{$dat->nombre_tc}}</td>    

      <td>   </td>
  </tr>
  @endforeach
</tbody>                
</table>
</div>
<!-- /.box-body -->
@include('sweetalert::alert')
@endsection