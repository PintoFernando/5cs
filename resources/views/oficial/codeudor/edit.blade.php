@extends ('layouts.admin3')
 @section ('contenido')
 <div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Editar Persona:{{$persona->id_persona}}</h3>
   @if (count($errors)>0)
   <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
  @endif
</div>
</div>

<form method="post" action="{{url('/oficial/codeudor/'.$persona->id_persona.'/edit')}}">
  {{csrf_field()}}
  <div class="row">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="ci">Ci</label>
      <input type="text" name="ci" class="form-control" value="{{old('ci',$persona->ci)}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
     <label>Extensión de CI</label>
     <select name="id_ext" class="form-control selectpicker" data-size="5" id="id_ext" data-live-search="true">
       @foreach ($extensiones as $ext)
       @if($ext->id_ext==$persona->id_ext)
       <option value="{{$ext->id_ext}}" selected>{{$ext->extension}}</option>
       @else
       <option value="{{$ext->id_ext}}">{{$ext->extension}}</option>
       @endif
       @endforeach
     </select> 
   </div>
 </div>


 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" class="form-control" value="{{old('nombre',$persona->nombre)}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="ap_paterno">Apellido Paterno</label>
    <input type="text" name="ap_paterno" class="form-control" value="{{old('ap_paterno',$persona->ap_paterno)}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="ap_materno">Apellido Materno</label>
    <input type="text" name="ap_materno" class="form-control" value="{{old('ap_materno',$persona->ap_materno)}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="ap_casada">Apellido Casada</label>
    <input type="text" name="ap_casada" class="form-control" value="{{old('ap_casada',$persona->ap_casada)}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="fec_nac">Fecha Nacimiento</label>
    <input type="text" name="fec_nac" class="form-control" value="{{old('fec_nac',$persona->fec_nac)}}">
  </div>
</div>


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="departamento_nac">Departamento Nacimiento</label>
    <input type="text" name="departamento_nac" class="form-control" value="{{old('departamento_nac',$persona->departamento_nac)}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="ciudad_nac">Ciudad Nacimiento</label>
    <input type="text" name="ciudad_nac" class="form-control" value="{{old('ciudad_nac',$persona->ciudad_nac)}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="provincia_nac">Provincia Nacimiento</label>
    <input type="text" name="provincia_nac" class="form-control" value="{{old('provincia_nac',$persona->provincia_nac)}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="genero">Género</label>
    <input type="text" name="genero" class="form-control" value="{{old('genero',$persona->genero)}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="celular">Celular</label>
    <input type="number" min="0" name="celular" class="form-control" value="{{old('celular',$persona->celular)}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="dependientes">Dependientes</label>
    <input type="number" min="0" name="dependientes" class="form-control" value="{{old('dependientes',$persona->dependientes)}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="num_socio">Número de Socio</label>
    <input type="number" min="0" name="num_socio" class="form-control" value="{{old('num_socio',$persona->num_socio)}}">
  </div>
</div>


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label>Profesion</label>
   <select name="id_profesion" class="form-control selectpicker" data-size="5" id="id_profesion" data-live-search="true">
     @foreach ($profesion as $pro)
     @if($pro->id_profesion==$persona->id_profesion)
     <option value="{{$pro->id_profesion}}" selected>{{$pro->profesion}}</option>
     @else
     <option value="{{$pro->id_profesion}}">{{$pro->profesion}}</option>
     @endif
     @endforeach
   </select> 
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label>Nacionalidad</label>
   <select name="id_nacionalidad" class="form-control selectpicker" data-size="5" id="id_nacionalidad" data-live-search="true">
     @foreach ($nacionalidad as $na)
     @if($na->id_nacionalidad==$persona->id_nacionalidad)
     <option value="{{$na->id_nacionalidad}}" selected>{{$na->nacionalidad}}</option>
     @else
     <option value="{{$na->id_nacionalidad}}">{{$na->nacionalidad}}</option>
     @endif
     @endforeach
   </select> 
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label>Estado Civil</label>
   <select name="id_estado_civil" class="form-control selectpicker" data-size="5" id="id_estado_civil" data-live-search="true">
     @foreach ($estados as $esta)
     @if($esta->id_estado_civil==$persona->id_estado_civil)
     <option value="{{$esta->id_estado_civil}}" selected>{{$esta->estado_civil}}</option>
     @else
     <option value="{{$esta->id_estado_civil}}">{{$esta->estado_civil}}</option>
     @endif
     @endforeach
   </select> 
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="ordinal_codeudor">Número de Codeudor</label>
    <input type="number" min="0" max="4" name="ordinal_codeudor" class="form-control" value="{{old('ordinal_codeudor',$codeudor->first()->ordinal_codeudor)}}">
  </div>
</div>


 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
     <button class="btn btn-primary" type="submit">Guardar</button>
     <a href="{{url('/oficial/codeudor')}}" class="btn btn-warning"> cancelar</a>
     <button class="btn btn-danger" type="reset">Restablecer</button>
   </div>
 </div>
</div>
</form>
@push ('scripts')
<script>
  $('#liConyugueGarante').addClass("treeview active");
  $('#liCodeudores').addClass("active");
</script>
@endpush
@endsection
