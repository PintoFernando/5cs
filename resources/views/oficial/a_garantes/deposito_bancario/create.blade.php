@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Registrar Deposito Bancario Garante</h3>
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
<div class="row">

  <div class="col-md-3 col-sm-6 col-xs-12" style="float:right;">
    <div class="info-box bg-yellow">
      <span class="info-box-icon"><i class="fa fa-user text-black"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Garante seleccionado</span>
        <span class="info-box-number"> </span>
        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
          {{Session::get('id_persona_oficial_garante','Usuario no seleccionado')}}
        </span>
      </div>
    </div>
  </div>


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
<!-- div usuario seleccionado-->
</div>
<form method="post" action="{{url('oficial/a_garantes/deposito_bancario')}}">
  {{csrf_field()}}
  <div class="row">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="numero_cuenta">Número de Cuenta</label>
       <input type="number" min="0" name="numero_cuenta" class="form-control" value="{{old('numero_cuenta')}}">
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="saldo">Saldo</label>
      <input type="number" step="any" name="saldo" class="form-control" value="{{old('saldo')}}">
    </div>
  </div>


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group" class="form-control">
     <label for="id_entidad_bancaria">Entidad Bancaria</label>
     <select name="id_entidad_bancaria"  class="form-control selectpicker" data-size="5" id="id_entidad_bancaria" data-live-search="true" required>
       @foreach($entidad as $en)
       <option value="{{$en->id_entidad_bancaria}}"> {{$en->nombre_entidad}}</option>
       @endforeach
   </select>
</div>
</div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="detalle">Detalle</label>
      <input type="text"  name="detalle" class="form-control" value="{{old('detalle')}}">
    </div>
  </div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group" class="form-control">
     <label for="id_tipo_deposito">Tipo de Depósito</label>
     <select name="id_tipo_deposito"  class="form-control selectpicker" data-size="5" id="id_tipo_deposito" data-live-search="true" required>
       @foreach($tipo as $ti)

       <option value="{{$ti->id_tipo_deposito}}"> {{$ti->nombre_deposito}}</option>
       @endforeach
   </select>
</div>
</div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <button class="btn btn-primary" type="submit">Guardar</button>
     <a href="{{url('/oficial/a_garantes/deposito_bancario')}}" class="btn btn-danger"> cancelar</a>
   </div>
 </div>

</div>
</form>
@push ('scripts')
<script>
$('#liGarante').addClass("treeview active");
$('#liGarante_sub_deposito').addClass("active");
</script>
@endpush
@endsection
