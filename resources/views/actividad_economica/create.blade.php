@extends ('layouts.admin3')
@section ('contenido')

<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <h3>Registrar Actividad Económica</h3>
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
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

</div>



<form method="post" action="{{url('/actividad_economica/')}}">
  {{csrf_field()}}
  <div class="row">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="ciudad_ae">Ciudad actividad económica</label>
       <input type="text" name="ciudad_ae" class="form-control" value="{{old('ciudad_ae')}}" required>
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="provincia_ae">Provincia actividad económica</label>
     <input type="text" name="provincia_ae" class="form-control" value="{{old('provincia_ae')}}" required>
   </div>
 </div>

 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="zona_ae">Zona actividad económica</label>
   <input type="text" name="zona_ae" class="form-control" value="{{old('zona_ae')}}">
 </div>
</div>


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="direccion_ae">Dirección actividad económica</label>
   <input type="text" name="direccion_ae" class="form-control" value="{{old('direccion_ae')}}" required>
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="telefono_ae">Teléfono actividad económica</label>
   <input type="text" name="telefono_ae" class="form-control" value="{{old('telefono_ae')}}">
 </div>
</div>
<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="actividad_qrealiza">Actividad que realiza</label>
   <input type="text" name="actividad_qrealiza" class="form-control" value="{{old('actividad_qrealiza')}}" required>
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="nit_ae">NIT</label>
   <input type="text" name="nit_ae" class="form-control" value="{{old('nit_ae')}}">
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="horario_trabajo_ae">Horario de Trabajo:</label><br>
   <input type="text" name="horario_trabajo_ae" class="form-control" value="{{old('horario_trabajo_ae')}}" placeholder="8:00 a 12:00" required>             
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="dias_trabajo_ae">Días de trabajo:</label><br>
   <input type="text" name="dias_trabajo_ae" class="form-control" value="{{old('dias_trabajo_ae')}}" placeholder="Lunes a viernes" required>             
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="antiguedad_trabajo_ae">Tiempo que realiza la actividad</label><br>
   <input type="date" name="antiguedad_trabajo_ae" class="form-control" value="{{old('antiguedad_trabajo_ae')}}"  >          
 </div>
</div>


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <button class="btn btn-primary" type="submit">Guardar</button>
   <a href="{{url('/actividad_economica')}}" class="btn btn-danger"> cancelar</a>
 </div>
</div>

</div>
</form>
@push ('scripts')
<script>
  $('#liAdmin').addClass("treeview active");
  $('#liAdmin_actividad_economica').addClass("active");
</script>
@endpush
@endsection
