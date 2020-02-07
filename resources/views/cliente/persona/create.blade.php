@extends ('layouts.admin3')
@section ('contenido')

<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     @if(count($errors)>0)
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

<form method="post" action="{{url('cliente/persona')}}">
  {{csrf_field()}}
  <div class="row">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="ci">Ci</label>
       <input type="text" name="ci" class="form-control" required>
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="nombre">Nombre</label>
     <input type="text" name="nombre" class="form-control" required>
   </div>
 </div>

 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="ap_paterno">Apellido Paterno</label>
   <input type="text" name="ap_paterno" class="form-control" required>
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="ap_materno">Apellido Materno</label>
   <input type="text" name="ap_materno" class="form-control" required>
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="ap_casada">Apellido casada</label>
   <input type="text" name="ap_casada" class="form-control" >
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="fec_nac">Fecha Nacimiento</label>
   <input type="date" name="fec_nac" class="form-control" required>
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="lugar_nac">Lugar Nacimiento</label>
   <input type="text" name="lugar_nac" class="form-control" required>
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group" class="form-control">
   <label for="genero">Género</label>
   <select name="genero"  class="form-control selectpicker" data-size="5" id="genero" data-live-search="true">
     <option value="Masculino">Masculino</option>
     <option value="Femenino">Femenino</option>
     <option value="Otro">Otro</option>    
   </select>
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="celular">Celular</label>
   <input type="text" name="celular" class="form-control"  >
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="dependientes">Dependientes</label>
   <input type="number" name="dependientes" min="0" class="form-control" required >
 </div>
</div>



<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group" class="form-control">
   <label for="id_profesion">Profesion</label>
   <select name="id_profesion"  class="form-control selectpicker" data-size="5" id="id_profesion" data-live-search="true">
     @foreach($profesiones as $pro)
     <option value="{{$pro->id_profesion}}"> {{$pro->profesion}}</option>
     @endforeach
   </select>
 </div>
</div>


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group" class="form-control">
   <label for="id_estado_civil">Estado Civil</label>
   <select name="id_estado_civil"  class="form-control selectpicker" data-size="5" id="id_estado_civil" data-live-search="true">
     @foreach($estados as $esta)
     <option value="{{$esta->id_estado_civil}}"> {{$esta->estado_civil}}</option>
     @endforeach
   </select>
 </div>
</div>


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group" class="form-control">
   <label for="id_nacionalidad">Nacionalidad</label>
   <select name="id_nacionalidad"  class="form-control selectpicker" data-size="5" id="id_nacionalidad" data-live-search="true">
     @foreach($nacionalidades as $na)
     <option value="{{$na->id_nacionalidad}}"> {{$na->nacionalidad}}</option>
     @endforeach
   </select>
 </div>
</div>


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <button class="btn btn-primary" type="submit">Guardar</button>
   <button class="btn btn-danger" type="reset">Cancelar</button>
 </div>
</div>

</div>
</form>
@endsection
