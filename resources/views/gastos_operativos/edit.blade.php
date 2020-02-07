@extends ('layouts.admin3')
@section ('contenido')

<div class="row">
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
   <h3>Editar Gasto Operativo</h3>
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

  <form method="post" action="{{url('/gastos_operativos/'.$gastos->id_gastos_operativos.'/edit')}}">
    {{csrf_field()}}
<div class="row">
   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="combustible">Combustible</label>
       <input type="number" step="any" min="0" name="combustible" class="form-control" value="{{old('combustible',$gastos->combustible)}}">
     </div>
   </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="deposito_almacen">Deposito Almacen</label>
       <input type="number" step="any" min="0" name="deposito_almacen" class="form-control" value="{{old('deposito_almacen',$gastos->deposito_almacen)}}">
     </div>
   </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="energia_electrica">Energia Eléctrica</label>
       <input type="number" step="any" min="0" name="energia_electrica" class="form-control" value="{{old('energia_electrica',$gastos->energia_electrica)}}">
     </div>
   </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="agua">Agua</label>
       <input type="number" step="any" min="0" name="agua" class="form-control" value="{{old('agua',$gastos->agua)}}">
     </div>
   </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="gas">Gas</label>
       <input type="number" step="any" min="0" name="gas" class="form-control" value="{{old('gas',$gastos->gas)}}">
     </div>
   </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="telefono">Teléfono</label>
       <input type="number" step="any" min="0" name="telefono" class="form-control" value="{{old('telefono',$gastos->telefono)}}">
     </div>
   </div>

 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="impuestos">Impuestos</label>
       <input type="number" step="any" min="0" name="impuestos" class="form-control" value="{{old('impuestos',$gastos->impuestos)}}">
     </div>
   </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="alquiler">Alquiler</label>
       <input type="number" step="any" min="0" name="alquiler" class="form-control" value="{{old('alquiler',$gastos->alquiler)}}">
     </div>
   </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="cuidado_sereno">Cuidado Sereno</label>
       <input type="number" step="any" min="0" name="cuidado_sereno" class="form-control" value="{{old('cuidado_sereno',$gastos->cuidado_sereno)}}">
     </div>
   </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="transporte">Transporte</label>
       <input type="number" step="any" min="0" name="transporte" class="form-control" value="{{old('transporte',$gastos->transporte)}}">
     </div>
   </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="mantenimiento">Mantenimiento</label>
       <input type="number" step="any" min="0" name="mantenimiento" class="form-control" value="{{old('mantenimiento',$gastos->mantenimiento)}}">
     </div>
   </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="publicidad">Publicidad</label>
       <input type="number" step="any" min="0" name="publicidad" class="form-control" value="{{old('publicidad',$gastos->publicidad)}}">
     </div>
   </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="otros">Otros</label>
       <input type="number" step="any" min="0" name="otros" class="form-control" value="{{old('otros',$gastos->otros)}}">
     </div>
   </div>  

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="detalle">Detalle - Otros</label>      
       <textarea name="detalle" rows="2" class="form-control" value="" > {{old('detalle',$gastos->detalle)}} </textarea>      
     </div>
   </div>      
    
 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
     <div class="form-group">
       <button class="btn btn-primary" type="submit">Guardar</button>
       <a href="{{url('/gastos_operativos')}}" class="btn btn-default"> cancelar</a>
       <button class="btn btn-danger" type="reset">Restablecer</button>
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
