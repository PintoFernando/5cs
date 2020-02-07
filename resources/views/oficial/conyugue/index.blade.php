@extends ('layouts.admin3')
@section ('contenido')

<div class="box-header">
 <h4>Conyugue  
</h4>
</div>
@if(session('notification'))
<div class="alert alert-success">
   {{session('notification')}}
</div>
@endif
<!-- /.box-header -->
<div class="box-body">
  <table id="o_conyugue" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Id</th>
       <th>Ci</th>
       <th>Extensión ci</th>
       <th>Nombre</th>
       <th>Apellido Paterno</th>
       <th>Apellido Materno</th>
       <th>Fecha Nacimiento</th>
       <th>Lugar Nacimiento</th>
       <th>Género</th>
       <th>Celular</th>
       <th>Dependientes</th>
       <th>Número de socio</th>
       <th>Nacionalidad</th>     
       <th>Estado Civil</th>     
       <th>Profesión</th> 
       <th>Acciones</th>               
     </tr>
   </thead>
   <tbody>
    @foreach ($persona as $pe)
    <tr>
      <td>{{$pe->id_persona}}</td>
      <td>{{$pe->ci}}</td>
      <td>{{$pe->extension}}</td>
      <td>{{$pe->nombre}}</td>
      <td>{{$pe->ap_paterno}}</td>
      <td>{{$pe->ap_materno}}</td>
      <td>{{$pe->fec_nac}}</td>
      <td>{{$pe->lugar_nac}}</td>
      <td>{{$pe->genero}}</td>
      <td>{{$pe->celular}}</td>
      <td>{{$pe->dependientes}}</td>
      <td>{{$pe->num_socio}}</td>
      <td>{{$pe->nacionalidad}}</td>
      <td>{{$pe->estado_civil}}</td>
      <td>{{$pe->profesion}}</td> 
      
      <td> <a href="{{url('/oficial/conyugue/'.$pe->id_persona.'/edit')}}" rel="tooltip" title="Editar conyugue" class="btn btn-success btn-simple btn-xs">
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
  $('#liC1').addClass("treeview active");
  $('#liConyugue').addClass("active");
</script>
@endpush
@endsection