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

<form method="post" action="{{url('cliente/datos_empresa/')}}">
  {{csrf_field()}}
  <div class="row">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="nombre_empresa">Nombre Empresa </label>
       <input type="text" name="nombre_empresa" class="form-control" value="{{old('nombre_empresa')}}" >
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="actividad_empresa">Actividad Empresa</label>
     <input type="text" name="actividad_empresa" class="form-control" value="{{old('actividad_empresa')}}" >
   </div>
 </div>

 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="antiguedad_empresa">Antiguedad de empresa</label>
   <input type="date" name="antiguedad_empresa" class="form-control" value="{{old('antiguedad_empresa')}}">
 </div>
</div>


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="ciudad_empresa">Ciudad Empresa</label>
   <input type="text" name="ciudad_empresa" class="form-control" value="{{old('ciudad_empresa')}}" >
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="provincia_empresa">Provincia Empresa</label>
   <input type="text" name="provincia_empresa" class="form-control" value="{{old('provincia_empresa')}}" >
 </div>
</div>
<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="zona_empresa">Zona Empresa</label>
   <input type="text" name="zona_empresa" class="form-control" value="{{old('zona_empresa')}}" >
 </div>
</div>
<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="direccion_empresa">Dirección Empresa</label>
   <input type="text" name="direccion_empresa" class="form-control" value="{{old('direccion_empresa')}}" >
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="telefono_empresa">Teléfono Empresa</label>
   <input type="number" min="0" name="telefono_empresa" class="form-control" value="{{old('telefono_empresa')}}" >
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="cargo_en_empresa">Cargo en empresa:</label><br>
   <input type="text" name="cargo_en_empresa" class="form-control" value="{{old('cargo_en_empresa')}}" >            	
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="antiguedad_en_cargo">Antiguedad en cargo:</label><br>
   <input type="date" name="antiguedad_en_cargo" class="form-control" value="{{old('antiguedaden_cargo')}}"  >             
 </div>
</div>


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="horario_trabajo">Horario Trabajo:</label><br>
   <input type="text" name="horario_trabajo" class="form-control" value="{{old('horario_trabajo')}}" placeholder="8:00 a 12:00" >             
 </div>
</div>


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="dias_trabajo">Días de trabajo:</label><br>
   <input type="text" name="dias_trabajo" class="form-control" value="{{old('dias_trabajo')}}" placeholder="Lunes a viernes" >             
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group" class="form-control">
     <label for="id_afp">Afp</label>
     <select name="id_afp"  class="form-control selectpicker" data-size="5" id="id_afp" data-live-search="true">
       @foreach($afp as $a)
       <option value="{{$a->id_afp}}"> {{$a->nombre_afp}}</option>
       @endforeach
   </select>
</div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group" class="form-control">
     <label for="id_tc">Tipo de contrato</label>
     <select name="id_tc"  class="form-control selectpicker" data-size="5" id="id_tc" data-live-search="true">
       @foreach($tipo_contrato as $tipo)
       <option value="{{$tipo->id_tc}}"> {{$tipo->nombre_tc}}</option>
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
