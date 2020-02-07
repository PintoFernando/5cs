@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
 <div class="box-header">
   <h4>Lista de Socios
    <a href="{{url('/plataforma/persona/crud/create')}}" class="btn btn-success pull-right" style="margin-top: -8px;">Añadir persona</a>
  </h4>
</div>
</div>

@if(session('notification'))
<div class="alert alert-success">
 {{session('notification')}}
</div>
@endif
<!-- /.box-header -->
<div class="box-body">
  <table id="o_persona" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Id</th>
       <th>Ci</th>
       <th>Extensión de CI</th>
       <th>Número de Socio</th>      
       <th>Nombre</th>
       <th>Ap. paterno</th>
       <th>Ap. Materno</th>               
       <th>Ap. Casada</th>               
       <th>Fech. Nac.</th>               
       <th>Lugar Nac</th>               
       <th>Departamento de Nacimiento</th>               
       <th>Ciudad de Nacimiento</th>               
       <th>Provincia de Nacimiento</th>               
       <th>Genero</th>               
       <th>Celular</th>               
       <th>Dependientes</th>               
       <th>Estado Civil</th>               
       <th>Profesión</th>               
       <th>Nacionalidad</th>               
       <th>Acciones</th>               
     </tr>
   </thead>
   <tbody>
    @foreach ($personas as $pe)
    <tr>
      <td>{{$pe->id_persona}}</td>
      <td>{{$pe->ci}}</td>
      <td>{{$pe->extension}}</td>
      <td>{{$pe->num_socio}}</td>
      <td>{{$pe->nombre}}</td>
      <td>{{$pe->ap_paterno}}</td>
      <td>{{$pe->ap_materno}}</td>
      <td>{{$pe->ap_casada}}</td>
      <td>{{$pe->fec_nac}}</td>
      <td>{{$pe->lugar_nac}}</td>
      <td>{{$pe->departamento_nac}}</td>
      <td>{{$pe->ciudad_nac}}</td>
      <td>{{$pe->provincia_nac}}</td>
      <td>{{$pe->genero}}</td>
      <td>{{$pe->celular}}</td>
      <td>{{$pe->dependientes}}</td>
      <td>{{$pe->estado_civil}}</td>
      <td>{{$pe->profesion}}</td>
      <td>{{$pe->nacionalidad}}</td>

      <td> <a href="{{url('/plataforma/persona/crud/'.$pe->id_persona.'/edit')}}" rel="tooltip" title="Editar Persona" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-pencil"></i> 
      </a>

    </td>
  </tr>
  @endforeach
</tbody>                
</table>
</div>
<!-- /.box-body -->


@push ('scripts')
<script>
  $('#pLiDatos').addClass("treeview active");
  $('#pLiPersona').addClass("active");
</script>
@endpush

@endsection