@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Registrar Maquinaria y Equipo</h3>
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
<form method="post" action="{{url('/maquinaria_equipo')}}">
  {{csrf_field()}}
  <div class="row">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="descripcion">Descripción</label>
       <input type="text" name="descripcion" class="form-control" value="{{old('descripcion')}}" >
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="marca">Marca</label>
      <input type="text" name="marca" class="form-control" value="{{old('marca')}}" >
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="modelo">Modelo</label>
      <input type="text" name="modelo" class="form-control" value="{{old('modelo')}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="anio">Año</label>
      <input type="number" name="anio" min="0" class="form-control" value="{{old('anio')}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="asegurado">Asegurado</label>
      <select name="asegurado" class="form-control selectpicker" data-size="5" id="asegurado" data-live-search="true" >
        <option value="1">Si</option>
        <option value="0">No</option>
      </select>
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="aseguradora">Aseguradora</label>
      <input type="text" name="aseguradora" class="form-control" value="{{old('aseguradora')}}" >
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="entidad_acreedora">Entidad Acreedora</label>
      <input type="text" name="entidad_acreedora" class="form-control" value="{{old('entidad_acreedora')}}" >
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="total">Total</label>
      <input type="number"  step="any" min="0" name="total" class="form-control" value="{{old('total')}}" required>
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">            
    <div class="form-group">
     <button class="btn btn-primary" type="submit">Guardar</button>
     <a href="{{url('/maquinaria_equipo')}}" class="btn btn-danger">Cancelar</a>
   </div>
 </div>
</div>
</form>
@push ('scripts')
<script>
  $('#liAdmin').addClass("treeview active");
  $('#liAdmin_maquinaria').addClass("active");
</script>
@endpush
@endsection
