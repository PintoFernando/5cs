@extends ('layouts.admin3')
@section ('contenido')

<!-- div usuario seleccionado-->
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12" style="float:right;">
    <div class="info-box bg-light-blue">
      <span class="info-box-icon"><i class="fa fa-user text-orange"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Codeudor seleccionado</span>
        <span class="info-box-number"> </span>
        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
          {{Session::get('id_persona_oficial_codeudor','Codeudor no seleccionado')}}
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
    </div>
  </div>
</div>
<!-- div usuario seleccionado-->


<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Registrar Amortización Coop. San Martín</h3>
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
</div>

<form method="post" action="{{url('oficial/a_codeudores/capacidad_pago')}}">
  {{csrf_field()}}
  <div class="row">

      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
     <div class="form-group" class="form-control">
       <label for="porcentaje">Porcentaje</label>
       <select name="porcentaje"  class="form-control selectpicker" data-size="5" id="porcentaje" data-live-search="true">         
         <option value="0.25">25%</option>
         <option value="0.4">40%</option>
         <option value="1">100%</option>
       </select>
     </div>
   </div>

      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="amortizacion_coop_san_martin">Amortización  Cooperativa San Martín</label>
       <input type="number" step="any" name="amortizacion_coop_san_martin" class="form-control" value="{{old('amortizacion_coop_san_martin')}}">
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
  $('#liCodeudor').addClass("treeview active");
  $('#liCodeudor_sub_capacidad_pago').addClass("active");
</script>
@endpush
@endsection
