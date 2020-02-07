@extends ('layouts.admin3')
@section ('contenido')

<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

  <h3>Detalle Conyugue</h3>

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


<form method="post" action="{{url('oficial/detalle_conyugue/')}}">
  {{csrf_field()}}
  <div class="row">   

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="ocupacion">Ocupación</label>
   <input type="text" name="ocupacion" class="form-control" value="{{old('ocupacion')}}">
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="cargo">Cargo</label>
   <input type="text" name="cargo" class="form-control" value="{{old('cargo')}}">
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="tiempo_trabajo">Tiempo trabajo</label>
   <input type="date" name="tiempo_trabajo" class="form-control" value="{{old('tiempo_trabajo')}}">
 </div>
</div>


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="nombre_institucion">Nombre Empresa/Institución</label>
   <input type="text" name="nombre_institucion" class="form-control" value="{{old('nombre_institucion')}}">
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="calle_principal">Calle Principal</label>
   <input type="text" name="calle_principal" class="form-control" value="{{old('calle_principal')}}">
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="calle_secundaria">Calle Secundaria</label>
   <input type="text" name="calle_secundaria" class="form-control" value="{{old('calle_secundaria')}}">
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="telefono">Teléfono Institución</label>
   <input type="text" name="telefono" class="form-control" value="{{old('telefono')}}">
 </div>
</div>
  
<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <button class="btn btn-primary" type="submit">Guardar</button>
   <a href="{{url('/oficial/detalle_conyugue')}}" class="btn btn-danger"> cancelar</a>
 </div>
</div>
</div>
</form>
@include('sweetalert::alert')
@push ('scripts')
<script>
  $('#liC1').addClass("treeview active");
  $('#liDetalleConyugue').addClass("active");
</script>
@endpush
@endsection
