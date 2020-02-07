@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Registrar Prestamo Bancario</h3>
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
<form method="post" action="{{url('/prestamo_bancario')}}">
  {{csrf_field()}}
  <div class="row">

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="importe_original">Importe Original</label>
     <input type="number" step="any" min="0" name="importe_original" class="form-control" value="{{old('importe_original')}}" >
   </div>
 </div>

 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="duracion_credito">Duración Crédito en Meses</label>
   <input type="number" min="0" name="duracion_credito" class="form-control" value="{{old('duracion_credito')}}" >
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="importe_ultimo_pago">Importe Último Pago</label>
   <input type="number" step="any" min="0" name="importe_ultimo_pago" class="form-control" value="{{old('importe_ultimo_pago')}}" required>
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="destino_credito">Destino del Crédito</label>
   <input type="text" name="destino_credito" class="form-control" value="{{old('destino_credito')}}" >
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="saldo">saldo</label>
   <input type="number" step="any" min="0" name="saldo" class="form-control" value="{{old('saldo')}}" required>
 </div>
</div>


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group" class="form-control">
   <label for="id_entidad_bancaria">Entidad Bancaria</label>
   <select name="id_entidad_bancaria"  class="form-control selectpicker" data-size="5" id="id_entidad_bancaria" data-live-search="true" >
     @foreach($entidad as $ent)
     <option value="{{$ent->id_entidad_bancaria}}"> {{$ent->nombre_entidad}}</option>
     @endforeach
   </select>
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group" class="form-control">
   <label for="id_tcredito">Tipo de crédito</label>
   <select name="id_tcredito"  class="form-control selectpicker" data-size="5" id="id_tcredito" data-live-search="true" >
     @foreach($tipo_credito as $cre)
     <option value="{{$cre->id_tcredito}}"> {{$cre->tipo_credito}}</option>
     @endforeach
   </select>
 </div>
</div>  


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <button class="btn btn-primary" type="submit">Guardar</button>
   <a href="{{url('/prestamo_bancario')}}" class="btn btn-danger">Cancelar</a>
 </div>
</div>

</div>
</form>
@push ('scripts')
<script>
  $('#liAdmin').addClass("treeview active");
  $('#liAdmin_prestamo').addClass("active");
</script>
@endpush
@endsection
