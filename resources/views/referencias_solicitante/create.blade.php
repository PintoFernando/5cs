@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Registrar Referencia Solicitante</h3>
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

<div class="body">
<form method="post" action="{{url('/referencias_solicitante')}}">
  {{csrf_field()}}
  <div class="row">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="ap_paterno">Apellido Paterno</label>
       <input type="text" name="ap_paterno" class="form-control"  value="{{old('ap_paterno')}}">
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="ap_materno">Apellido Materno</label>
      <input type="text" step="any" name="ap_materno" class="form-control" value="{{old('ap_materno')}}">
    </div>
  </div>

  
<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="nombre">Nombre</label>
      <input type="text" name="nombre" class="form-control" value="{{old('nombre')}}">
    </div>
  </div>


  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="parentesco">Parentesco</label>
      <input type="text" name="parentesco" class="form-control" value="{{old('parentesco')}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="celular">celular</label>
      <input type="number" name="celular" min="0" class="form-control" value="{{old('celular')}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="telefono">Teléfono</label>
      <input type="number" name="telefono" min="0" class="form-control" value="{{old('telefono')}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <button class="btn btn-primary" type="submit">Guardar</button>
     <a href="{{url('/referencias_solicitante')}}" class="btn btn-danger"> cancelar</a>
   </div>
 </div>
 
</div>
</form>
</div>

@push ('scripts')
<script>
$('#liAdmin').addClass("treeview active");
$('#liAdmin_referencias').addClass("active");
</script>
@endpush
@endsection