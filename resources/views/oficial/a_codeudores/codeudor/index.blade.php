@extends ('layouts.admin3')
@section ('contenido')

<!-- div usuario seleccionado-->
<div class="row">
<div class="col-md-3 col-sm-6 col-xs-12" style="float:right;">
    <div class="info-box bg-green">
      <span class="info-box-icon"><i class="fa fa-user"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">U. Seleccionado</span>
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
  style="margin-top: -8px;">Registrar Codeudor</a>
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
       <th>Número de codeudor</th>     
       <th>Acciones</th>               
     </tr>
   </thead>
   <tbody>
    @foreach ($persona as $pe)
    <tr>
      <td>{{$pe->id_persona}}</td>
      <td>{{$pe->ci}}</td>
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
      <td>{{$pe->ordinal_codeudor}}</td>  
      <td> <a href="{{url('/oficial/codeudor/'.$pe->id_persona.'/edit')}}" rel="tooltip" title="Editar codeudor" class="btn btn-success btn-simple btn-xs">
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
  $('#liConyugueGarante').addClass("treeview active");
  $('#liCodeudores').addClass("active");
</script>
@endpush
@endsection