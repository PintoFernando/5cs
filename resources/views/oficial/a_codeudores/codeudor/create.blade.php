@extends ('layouts.admin3')
@section ('contenido')

<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
  <h3>Codeudor</h3>
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
<!-- div usuario seleccionado-->
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
<!-- div usuario seleccionado-->
</div>



<form method="post" action="{{url('oficial/codeudor/')}}">
  {{csrf_field()}}
  <div class="row">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="ci">Ci</label>
       <input type="text" name="ci" class="form-control" value="{{old('ci')}}" required>
     </div>
   </div>

 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group" class="form-control">
   <label for="id_ext">Extension CI</label>
   <select name="id_ext"  class="form-control selectpicker" data-size="5" id="id_ext" data-live-search="true">
     @foreach($extensiones as $ext)
     <option value="{{$ext->id_ext}}"> {{$ext->extension}}</option>
     @endforeach
   </select>
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
       <input type="text" name="ap_paterno" class="form-control" value="{{old('ap_paterno')}}" required>
     </div>
   </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="ap_materno">Ap. Materno</label>
       <input type="text" name="ap_materno" class="form-control" value="{{old('ap_materno')}}" required>
     </div>
   </div>

   
   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="fec_nac">Fecha de Nacimiento</label>
       <input type="date" name="fec_nac" class="form-control" value="{{old('fec_nac')}}" required>
     </div>
   </div>


    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="lugar_nac">Lugar de Nacimiento</label>
       <input type="text" name="lugar_nac" class="form-control" value="{{old('lugar_nac')}}" >
     </div>
   </div>


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group" class="form-control">
   <label for="genero">G??nero</label>
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
   <input type="number" min="0" name="celular" class="form-control" required >
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
 <div class="form-group" class="form-control">
   <label for="ordinal_codeudor">N??mero de codeudor</label>
   <select name="ordinal_codeudor"  class="form-control selectpicker" data-size="5" id="ordinal_codeudor" data-live-search="true" required>
     <option value="1">Primero</option>
     <option value="2">Segundo</option>
     <option value="3">Tercero</option>    
     <option value="4">Cuarto</option>    
   </select>
 </div>
</div>
  

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <button class="btn btn-primary" type="submit">Guardar</button>
   <a href="{{url('/oficial/codeudor')}}" class="btn btn-danger"> cancelar</a>
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
