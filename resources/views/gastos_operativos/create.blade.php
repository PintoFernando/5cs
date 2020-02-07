@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Registrar Gastos Operativos</h3>
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

<form method="post" action="{{url('/gastos_operativos')}}">
  {{csrf_field()}}
  <div class="row">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="combustible">Combustible</label>
       <input type="number" step="any" min="0" name="combustible" class="form-control" value="{{old('combustible')}}">
     </div>
   </div>

     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="deposito_almacen">Deposito Almacen</label>
       <input type="number" step="any" min="0" name="deposito_almacen" class="form-control" value="{{old('deposito_almacen')}}">
     </div>
   </div>

     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="energia_electrica">Energía Electrica</label>
       <input type="number" step="any" min="0" name="energia_electrica" class="form-control" value="{{old('energia_electrica')}}">
     </div>
   </div>

     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="agua">Agua</label>
       <input type="number" step="any" min="0" name="agua" class="form-control" value="{{old('agua')}}">
     </div>
   </div>

     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="gas">Gas</label>
       <input type="number" step="any" min="0" name="gas" class="form-control" value="{{old('gas')}}">
     </div>
   </div>

     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="telefono">Teléfono</label>
       <input type="number" step="any" min="0" name="telefono" class="form-control" value="{{old('telefono')}}">
     </div>
   </div>

     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="impuestos">Impuestos</label>
       <input type="number" step="any" min="0" name="impuestos" class="form-control" value="{{old('impuestos')}}">
     </div>
   </div>

     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="alquiler">Alquiler</label>
       <input type="number" step="any" min="0" name="alquiler" class="form-control" value="{{old('alquiler')}}">
     </div>
   </div>

     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="cuidado_sereno">Cuidado Sereno</label>
       <input type="number" step="any" min="0" name="cuidado_sereno" class="form-control" value="{{old('cuidado_sereno')}}">
     </div>
   </div>

     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="transporte">Transporte</label>
       <input type="number" step="any" min="0" name="transporte" class="form-control" value="{{old('transporte')}}">
     </div>
   </div>

     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="mantenimiento">Mantenimiento</label>
       <input type="number" step="any" min="0" name="mantenimiento" class="form-control" value="{{old('mantenimiento')}}">
     </div>
   </div>

     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="publicidad">Publicidad</label>
       <input type="number" step="any" min="0" name="publicidad" class="form-control" value="{{old('publicidad')}}">
     </div>
   </div>
  
  
     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="otros">Otros</label>
       <input type="number" step="any" min="0" name="otros" class="form-control" value="{{old('otros')}}">
     </div>
   </div>


   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="detalle">Detalle - Otros</label>
       <textarea class="form-control" rows="2" name="detalle" value="{{old('detalle')}}"> </textarea>      
     </div>
   </div>  





  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <button class="btn btn-primary" type="submit">Guardar</button>
     <a href="{{url('/gastos_operativos')}}" class="btn btn-danger"> cancelar</a>
   </div>
 </div>

</div>
</form>
@push ('scripts')
<script>
  $('#liAdmin').addClass("treeview active");
  $('#liAdmin_gastos_operativos').addClass("active");
</script>
@endpush
@endsection
