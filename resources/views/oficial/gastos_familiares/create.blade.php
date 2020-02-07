@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Registrar Gastos Familiares</h3>
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
<form method="post" action="{{url('oficial/gastos_familiares')}}">
  {{csrf_field()}}
  <div class="row">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="alimentacion">Alimentacion</label>
       <input type="number" step="any" min="0" name="alimentacion" class="form-control" value="{{old('alimentacion')}}">
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="energia_electrica">Energía Eléctrica</label>
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
      <label for="telefono">Telefono</label>
      <input type="number" step="any" min="0" name="telefono" class="form-control" value="{{old('telefono')}}">
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
      <label for="impuestos">Impuestos</label>
      <input type="number" step="any" min="0" name="impuestos" class="form-control" value="{{old('impuestos')}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="alquileres">Alquileres</label>
      <input type="number" step="any" min="0" name="alquileres" class="form-control" value="{{old('alquileres')}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="educacion">Educacion</label>
      <input type="number" step="any" min="0" name="educacion" class="form-control" value="{{old('educacion')}}">
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
      <label for="salud">Salud</label>
      <input type="number" step="any" min="0" name="salud" class="form-control" value="{{old('salud')}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="empleada">Empleada</label>
      <input type="number" step="any" min="0" name="empleada" class="form-control" value="{{old('empleada')}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="diversion">Diversion</label>
      <input type="number" step="any" min="0" name="diversion" class="form-control" value="{{old('diversion')}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vestimenta">Vestimenta</label>
      <input type="number" step="any" min="0" name="vestimenta" class="form-control" value="{{old('vestimenta')}}">
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
     <a href="{{url('/oficial/gastos_familiares')}}" class="btn btn-danger"> cancelar</a>
   </div>
 </div>

</div>
</form>
@push ('scripts')
<script>
  $('#liC3').addClass("treeview active");
  $('#liGastosFamiliares').addClass("active");
</script>
@endpush
@endsection
