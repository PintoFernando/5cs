@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Registrar Dirección</h3>
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
 
<form method="post" action="{{url('plataforma/direccion')}}">
  {{csrf_field()}}
  <div class="row">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="direc_numero">Número de Casa</label>
       <input type="number" name="direc_numero" class="form-control" value="{{old('direc_numero')}}">
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="ciudad">Ciudad</label>
      <input type="text" name="ciudad" class="form-control" value="{{old('ciudad')}}" required>
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="provincia">Provincia</label>
      <input type="text" name="provincia" class="form-control" value="{{old('provincia')}}" required>
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="localidad">Localidad</label>
      <input type="text" name="localidad" class="form-control" value="{{old('localidad')}}">
    </div>
  </div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="zona">Zona</label>
      <input type="text" name="zona" class="form-control" value="{{old('zona')}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="cll_principal">Calle Principal</label>
      <input type="text" name="cll_principal" class="form-control" value="{{old('cll_principal')}}" required>
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="cll_secundaria">Calle Secundaria</label>
      <input type="text" name="cll_secundaria" class="form-control" value="{{old('cll_secundaria')}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="tiempo_residencia">Tiempo de Residencia</label>
      <input type="date" name="tiempo_residencia" class="form-control" value="{{old('tiempo_residencia')}}" required>
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group" class="form-control">
     <label for="id_tipo_vivienda">Tipo de Vivienda</label>
     <select name="id_tipo_vivienda"  class="form-control selectpicker" data-size="5" id="id_tipo_vivienda" data-live-search="true" required>
       @foreach($tipo as $ti)

       <option value="{{$ti->id_tipo_vivienda}}"> {{$ti->tipo_vivienda}}</option>
       @endforeach
   </select>
</div>
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
@push ('scripts')
<script>
  $('#pLiDatos').addClass("treeview active");
  $('#pLiDireccion').addClass("active");
</script>
@endpush
@endsection
