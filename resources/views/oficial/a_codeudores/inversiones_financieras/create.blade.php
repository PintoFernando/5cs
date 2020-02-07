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
   <h3>Registrar Inversiones Financieras</h3>
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

<form method="post" action="{{url('/oficial/a_codeudores/inversiones_financieras')}}">
  {{csrf_field()}}
  <div class="row">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="cantidad">Cantidad</label>
       <input type="number" name="cantidad" class="form-control" value="{{old('cantidad')}}">
     </div>
   </div>

     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="porcentaje_patrimonio_empre">% Patrimonio Empresarial</label>
       <input type="number" step="any" name="porcentaje_patrimonio_empre" class="form-control" value="{{old('porcentaje_patrimonio_empre')}}">
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="nit">NIT</label>
       <input type="text" name="nit" class="form-control" value="{{old('nit')}}">
     </div>
   </div>

     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="nombre_empresa">Nombre de la Empresa</label>
       <input type="text" name="nombre_empresa" class="form-control" value="{{old('nombre_empresa')}}" >
     </div>
   </div>

     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="valor_nominal">Valor Nominal</label>
       <input type="number" step="any" name="valor_nominal" class="form-control" value="{{old('valor_nominal')}}">
     </div>
   </div>

     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="valor_mercado">Valor de Mercado</label>
       <input type="number" step="any" name="valor_mercado" class="form-control" value="{{old('valor_mercado')}}" required>
     </div>
   </div> 

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="detalle">Detalle</label>
       <textarea class="form-control" rows="2" name="detalle" value="{{old('detalle')}}"> </textarea>      
     </div>
   </div>  


  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <button class="btn btn-primary" type="submit">Guardar</button>
     <a href="{{url('/oficial/a_codeudores/inversiones_financieras')}}" class="btn btn-danger">Cancelar</a>
  
   </div>
 </div>

</div>
</form>
@push ('scripts')
<script>
  $('#liCodeudor').addClass("treeview active");
  $('#liCodeudor_sub_inversion').addClass("active");
</script>
@endpush
@endsection
