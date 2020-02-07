@extends ('layouts.admin3')
@section ('contenido')

<div class="row">

  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
  <h3>Datos Empresa </h3>
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

<form method="post" action="{{url('oficial/datos_empresa/')}}">
  {{csrf_field()}}
  <div class="row">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="nombre_empresa">Nombre</label>
       <input type="text" name="nombre_empresa" class="form-control" value="{{old('nombre_empresa')}}" required>
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="actividad_empresa">Actividad</label>
     <input type="text" name="actividad_empresa" class="form-control" value="{{old('actividad_empresa')}}" required>
   </div>
 </div>

 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="antiguedad_empresa">Antiguedad en la empresa</label>
   <input type="date" name="antiguedad_empresa" class="form-control" value="{{old('antiguedad_empresa')}}" required>
 </div>
</div>


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="ciudad_empresa">Ciudad</label>
   <input type="text" name="ciudad_empresa" class="form-control" value="{{old('ciudad_empresa')}}" required>
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="provincia_empresa">Provincia</label>
   <input type="text" name="provincia_empresa" class="form-control" value="{{old('provincia_empresa')}}" required>
 </div>
</div>
<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="zona_empresa">Zona</label>
   <input type="text" name="zona_empresa" class="form-control" value="{{old('zona_empresa')}}" required>
 </div>
</div>
<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="direccion_empresa">Dirección</label>
   <input type="text" name="direccion_empresa" class="form-control" value="{{old('direccion_empresa')}}" required>
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="telefono_empresa">Teléfono</label>
   <input type="text" name="telefono_empresa" class="form-control" value="{{old('telefono_empresa')}}">
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="cargo_en_empresa">Cargo</label><br>
   <input type="text" name="cargo_en_empresa" class="form-control" value="{{old('cargo_en_empresa')}}" required>            	
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="antiguedad_en_cargo">Antiguedad en cargo</label><br>
   <input type="date" name="antiguedad_en_cargo" class="form-control" value="{{old('antiguedaden_cargo')}}" required>             
 </div>
</div>



<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="horario_trabajo">Horario Trabajo:</label><br>
   <input type="text" name="horario_trabajo" class="form-control" value="{{old('horario_trabajo')}}" required>             
 </div>
</div>


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="dias_trabajo">Días de trabajo:</label><br>
   <input type="text" name="dias_trabajo" class="form-control" value="{{old('dias_trabajo')}}" required>             
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
   <a href="{{url('/oficial/datos_empresa')}}" class="btn btn-danger"> cancelar</a>
 </div>
</div>

</div>
</form>
@push ('scripts')
<script>
  $('#liC1').addClass("treeview active");
  $('#liDatosEmpresa').addClass("active");
</script>
@endpush
@endsection
