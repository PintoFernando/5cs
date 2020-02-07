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

<form method="post" action="{{url('cliente/actividad_economica/')}}">
  {{csrf_field()}}
  <div class="row">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="ciudad_ae">Ciudad actividad económica</label>
       <input type="text" name="ciudad_ae" class="form-control" value="{{old('ciudad_ae')}}" placeholder="Potosí">
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="provincia_ae">Provincia actividad económica</label>
     <input type="text" name="provincia_ae" class="form-control" value="{{old('provincia_ae')}}" placeholder="Tomás Frías">
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
   <input type="text" name="direccion_ae" class="form-control" value="{{old('direccion_ae')}}" placeholder="Calle costarica">
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="telefono_ae">Teléfono actividad económica</label>
   <input type="text" name="telefono_ae" class="form-control" value="{{old('telefono_ae')}}" placeholder="78451212">
 </div>
</div>
<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="actividad_qrealiza">Actividad que realiza</label>
   <input type="text" name="actividad_qrealiza" class="form-control" value="{{old('actividad_qrealiza')}}" placeholder="Comerciante">
 </div>
</div>
<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="nit_ae">NIT</label>
   <input type="text" name="nit_ae" class="form-control" value="{{old('nit_ae')}}" placeholder="4545454">
 </div>
</div>



<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="horario_trabajo_ae">Horario de Trabajo:</label><br>
   <input type="text" name="horario_trabajo_ae" class="form-control" value="{{old('horario_trabajo_ae')}}" placeholder="8:00 a 12:00" >             
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="dias_trabajo_ae">Días de trabajo:</label><br>
   <input type="text" name="dias_trabajo_ae" class="form-control" value="{{old('dias_trabajo_ae')}}" placeholder="Lunes a viernes" >             
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="antiguedad_trabajo_ae">Antiguedad_trabajo_ae:</label><br>
   <input type="date" name="antiguedad_trabajo_ae" class="form-control" value="{{old('antiguedad_trabajo_ae')}}"  >             
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
