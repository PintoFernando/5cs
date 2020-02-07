@extends ('layouts.admin3')
@section ('contenido')
<div class="row">

  <div class="col-md-3 col-sm-6 col-xs-12" style="float:right;">
    <div class="info-box bg-yellow">
      <span class="info-box-icon"><i class="fa fa-user text-black"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Garante seleccionado</span>
        <span class="info-box-number"> </span>
        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
          {{Session::get('id_persona_oficial_garante','Usuario no seleccionado')}}
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
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
</div>

<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Datos Empresa Garante</h3>
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

<form method="post" action="{{url('/oficial/a_garantes/datos_empresa/'.$datos->id_datos_empresa.'/edit')}}">
  {{csrf_field()}}
  <div class="row">


   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="nombre_empresa">Nombre</label>
     <input type="text" name="nombre_empresa" class="form-control" value="{{old('nombre_empresa',$datos->nombre_empresa)}}">
   </div>
 </div>

 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="actividad_empresa">Actividad</label>
     <input type="text" name="actividad_empresa" class="form-control" value="{{old('actividad_empresa',$datos->actividad_empresa)}}">
   </div>
 </div>


  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="antiguedad_empresa">Antiguedad en la empresa</label>
     <input type="text" name="antiguedad_empresa" class="form-control" value="{{old('antiguedad_empresa',$datos->antiguedad_empresa)}}">
   </div>
 </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="ciudad_empresa">Ciudad</label>
     <input type="text" name="ciudad_empresa" class="form-control" value="{{old('ciudad_empresa',$datos->ciudad_empresa)}}">
   </div>
 </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="provincia_empresa">Provincia</label>
     <input type="text" name="provincia_empresa" class="form-control" value="{{old('provincia_empresa',$datos->provincia_empresa)}}">
   </div>
 </div>


   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="zona_empresa">Zona</label>
     <input type="text" name="zona_empresa" class="form-control" value="{{old('zona_empresa',$datos->zona_empresa)}}">
   </div>
 </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="direccion_empresa">Dirección</label>
     <input type="text" name="direccion_empresa" class="form-control" value="{{old('direccion_empresa',$datos->direccion_empresa)}}">
   </div>
 </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="telefono_empresa">Teléfono</label>
     <input type="text" name="telefono_empresa" class="form-control" value="{{old('telefono_empresa',$datos->telefono_empresa)}}">
   </div>
 </div>


  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="cargo_en_empresa">Cargo</label>
     <input type="text" name="cargo_en_empresa" class="form-control" value="{{old('cargo_en_empresa',$datos->cargo_en_empresa)}}">
   </div>
 </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="antiguedad_en_cargo">Antiguedad en cargo</label>
     <input type="text" name="antiguedad_en_cargo" class="form-control" value="{{old('antiguedad_en_cargo',$datos->antiguedad_en_cargo)}}">
   </div>
 </div>


   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="horario_trabajo">Horario Trabajo</label>
     <input type="text" name="horario_trabajo" class="form-control" value="{{old('horario_trabajo',$datos->horario_trabajo)}}">
   </div>
 </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="dias_trabajo">Días Trabajo</label>
     <input type="text" name="dias_trabajo" class="form-control" value="{{old('dias_trabajo',$datos->dias_trabajo)}}">
   </div>
 </div>

  <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
   <div class="form-group">
     <label>Afp</label>
     <select name="id_afp" class="form-control selectpicker" data-size="5" id="id_afp" data-live-search="true">
       @foreach ($afp as $af)
       @if($af->id_afp==$datos->id_afp)
       <option value="{{$af->id_afp}}" selected>{{$af->nombre_afp}}</option>
       @else
       <option value="{{$af->id_afp}}">{{$af->nombre_afp}}</option>
       @endif
       @endforeach
     </select> 
   </div>
 </div>

  <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
   <div class="form-group">
     <label>Tipo Contrato</label>
     <select name="id_tc" class="form-control selectpicker" data-size="5" id="id_tc" data-live-search="true">
       @foreach ($tipo as $ti)
       @if($ti->id_tc==$datos->id_tc)
       <option value="{{$ti->id_tc}}" selected>{{$ti->nombre_tc}}</option>
       @else
       <option value="{{$ti->id_tc}}">{{$ti->nombre_tc}}</option>
       @endif
       @endforeach
     </select> 
   </div>
 </div>




<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <button class="btn btn-primary" type="submit">Guardar</button>
   <a href="{{url('/oficial/a_garantes/datos_empresa')}}" class="btn btn-warning"> cancelar</a>
   <button class="btn btn-danger" type="reset">Restablecer</button>
 </div>
</div>
</div>
</form>
@push ('scripts')
<script>
  $('#liGarante').addClass("treeview active");
  $('#liGarante_sub_empresa').addClass("active");
</script>
@endpush
@endsection
