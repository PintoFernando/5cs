@extends ('layouts.admin3')
@section ('contenido')

<!-- div usuario seleccionado-->
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12" style="float:right;">
    <div class="info-box bg-light-blue">
      <span class="info-box-icon"><i class="fa fa-user text-orange"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Codeudor seleccionado</span>
        <span class="info-box-number"> </span>
        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
          {{Session::get('id_persona_oficial_codeudor','Codeudor no seleccionado')}}
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
    </div>
  </div>
</div>
<!-- div usuario seleccionado-->

<div class="row">
  <div class="box-header">
   <h3>Codeudores
    <a href="{{url('/oficial/codeudor/create')}}" 
    class="btn btn-success btn-lg pull-right" 
    style="margin-top: -8px;">Añadir Codeudor</a>
  </h3>
</div>
</div>

@if(session('notification'))
<div class="row">
  <div class="alert alert-success">
   {{session('notification')}}
 </div>
</div>
@endif
<!-- /.box-header -->
<div class="box-body">
  <table id="o_codeudor" class="table table-bordered table-striped">
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
       <th>Departamento de Nacimiento</th>               
       <th>Ciudad de Nacimiento</th>               
       <th>Provincia de Nacimiento</th>               
       <th>Genero</th>               
       <th>Celular</th>               
       <th>Dependientes</th>               
       <th>Estado Civil</th>               
       <th>Profesión</th>               
       <th>Nacionalidad</th>               
       <th>Número de Garante</th>               
       <th>Acciones</th>               
     </tr>
   </thead>
   <tbody>
    @foreach ($persona as $pe)
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
      <td>{{$pe->departamento_nac}}</td>
      <td>{{$pe->ciudad_nac}}</td>
      <td>{{$pe->provincia_nac}}</td>
      <td>{{$pe->genero}}</td>
      <td>{{$pe->celular}}</td>
      <td>{{$pe->dependientes}}</td>
      <td>{{$pe->estado_civil}}</td>
      <td>{{$pe->profesion}}</td>
      <td>{{$pe->nacionalidad}}</td>  
      <td>{{$pe->ordinal_codeudor}}</td>  
      <td> <a href="{{url('/oficial/codeudor/'.$pe->id_persona.'/edit')}}" rel="tooltip" title="Editar codeudor" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-pencil"></i> 
      </a>

      <a href="{{url('/oficial/seleccionar/codeudor/'.$pe->id_persona.'/seleccionar')}}" rel="tooltip" title="Seleccionar Codeudor" class="btn btn-danger btn-simple btn-xs">
        <i class="fa fa-thumbs-o-up"></i> 
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
  $('#liCodeudor').addClass("treeview active");
  $('#liCodeudor_sub_codeudor').addClass("active");
</script>
@endpush
@endsection