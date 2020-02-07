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
   <h3>Cuenta documento por cobrar</h3>
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
<form method="post" action="{{url('/cuentas_documentos_cobrar')}}">
  {{csrf_field()}}
  <div class="row">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="nit">Nit</label>
       <input type="text" name="nit" class="form-control" value="{{old('nit')}}">
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="nombre_razon_social">Nombre Razon Social</label>
      <input type="text" name="nombre_razon_social" class="form-control" value="{{old('nombre_razon_social')}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="concepto">Concepto</label>
      <input type="text" name="concepto" class="form-control" value="{{old('concepto')}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="saldo">Saldo</label>
      <input type="number"  step="any" name="saldo" class="form-control" value="{{old('saldo')}}" required>
    </div>
  </div>          




  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">            
    <div class="form-group">
     <button class="btn btn-primary" type="submit">Guardar</button>
     <a href="{{url('/cuentas_documentos_cobrar')}}" class="btn btn-danger"> cancelar</a>
   </div>
 </div>
</div>
</form>
@push ('scripts')
<script>
  $('#liAdmin').addClass("treeview active");
  $('#liAdmin_cuentas_documentos').addClass("active");
</script>
@endpush
@endsection
