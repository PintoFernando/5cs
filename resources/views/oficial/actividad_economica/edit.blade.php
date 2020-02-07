@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Actividad :{{$actividad->id_actividad_economica}}</h3>
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

<form method="post" action="{{url('/oficial/actividad_economica/'.$actividad->id_actividad_economica.'/edit')}}">
  {{csrf_field()}}
  <div class="row">


   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="ciudad_ae">Ciudad</label>
     <input type="text" name="ciudad_ae" class="form-control" value="{{old('ciudad_ae',$actividad->ciudad_ae)}}">
   </div>
 </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="provincia_ae">Provincia</label>
     <input type="text" name="provincia_ae" class="form-control" value="{{old('provincia_ae',$actividad->provincia_ae)}}">
   </div>
 </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="zona_ae">Zona</label>
     <input type="text" name="zona_ae" class="form-control" value="{{old('zona_ae',$actividad->zona_ae)}}">
   </div>
 </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="direccion_ae">Dirección </label>
     <input type="text" name="direccion_ae" class="form-control" value="{{old('direccion_ae',$actividad->direccion_ae)}}">
   </div>
 </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="telefono_ae">Teléfono</label>
     <input type="text" name="telefono_ae" class="form-control" value="{{old('telefono_ae',$actividad->telefono_ae)}}">
   </div>
 </div>

 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="actividad_qrealiza">Actividad que realiza</label>
     <input type="text" name="actividad_qrealiza" class="form-control" value="{{old('actividad_qrealiza',$actividad->actividad_qrealiza)}}">
   </div>
 </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="nit_ae">Nit</label>
     <input type="text" name="nit_ae" class="form-control" value="{{old('nit_ae',$actividad->nit_ae)}}">
   </div>
 </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="horario_trabajo_ae">Horario de trabajo</label>
     <input type="text" name="horario_trabajo_ae" class="form-control" value="{{old('horario_trabajo_ae',$actividad->horario_trabajo_ae)}}">
   </div>
 </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="dias_trabajo_ae">Días de trabajo</label>
     <input type="text" name="dias_trabajo_ae" class="form-control" value="{{old('dias_trabajo_ae',$actividad->dias_trabajo_ae)}}">
   </div>
 </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="antiguedad_trabajo_ae">Antiguedad en trabajo</label>
     <input type="text" name="antiguedad_trabajo_ae" class="form-control" value="{{old('antiguedad_trabajo_ae',$actividad->antiguedad_trabajo_ae)}}">
   </div>
 </div>




<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <button class="btn btn-primary" type="submit">Guardar</button>
   <a href="{{url('/oficial/actividad_economica')}}" class="btn btn-default"> cancelar</a>
   <button class="btn btn-danger" type="reset">Restablecer</button>
 </div>
</div>
</div>
</form>
@push ('scripts')
<script>
  $('#liC1').addClass("treeview active");
  $('#liActividadEconomica').addClass("active");
</script>
@endpush
@endsection
