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

<form method="post" action="{{url('cliente/conyugue/')}}">
  {{csrf_field()}}
  <div class="row">
      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
           <label for="ci">Ci</label>
           <input type="text" name="ci" class="form-control" value="{{old('ci')}}" required>
       </div>
   </div>
   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
       <label for="nombre">Nombre</label>
       <input type="text" name="nombre" class="form-control" value="{{old('nombre')}}" required>
   </div>
   </div>
   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
       <label for="ap_paterno">Ap. Paterno</label>
       <input type="text" name="ap_paterno" class="form-control" value="{{old('ap_paterno')}}"  required>
   </div>
   </div>
   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
       <label for="ap_materno">Ap. Materno</label>
       <input type="text" name="ap_materno" class="form-control" value="{{old('ap_materno')}}" >
   </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
       <label for="ap_casada">Ap. Casado</label>
       <input type="text" name="ap_casada" class="form-control" value="{{old('ap_casada')}}" >
   </div>
   </div>
   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
       <label for="fec_nac">Fecha Nacimiento:</label><br>
       <input type="date" name="fec_nac" required>            	
   </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group" class="form-control">
     <label for="id_nacionalidad">País de origen</label>
     <select name="id_nacionalidad"  class="form-control selectpicker" data-size="5" id="id_nacionalidad" data-live-search="true">
       @foreach($nacionalidad as $na)

       <option value="{{$na->id_nacionalidad}}"> {{$na->nacionalidad}}</option>
       @endforeach
   </select>
</div>
</div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
       <label for="lugar_nac">Lugar De Nacimiento</label><br>
       <input type="text" name="lugar_nac" >              
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
       <input type="number" min="0" name="celular" class="form-control" value="{{old('celular')}}" >
   </div>
   </div>
   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
       <label for="dependientes">Num. Dependientes</label>
       <input type="number" min="0" max="20" name="dependientes" class="form-control" value="{{old('dependientes')}}" >
   </div>
   </div>
   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group" class="form-control">
       <label for="estado_civil">Estado civil</label>
       <select name="estado_civil" required>
           <option value="Casado">Casado</option>
           <option value="Soltero">Soltero</option>
           <option value="Divorciado">Divorciado</option>
           <option value="Concuvino(a)">Concuvino(a)</option>
       </select>

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
<div class="form-group">
   <button class="btn btn-primary" type="submit">Guardar</button>
   <button class="btn btn-danger" type="reset">Cancelar</button>
</div>
</div>

</div>
</form>
@endsection
