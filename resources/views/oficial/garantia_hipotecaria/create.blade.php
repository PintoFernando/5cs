@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Registrar Garantia Hipotecaria</h3>
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

<form method="post" action="{{url('oficial/garantia_hipotecaria')}}">
  {{csrf_field()}}
  <div class="row">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="nombre_ap_propietario">Nombres y apellidos de los dueños de la Garantia</label>
       <input type="text" name="nombre_ap_propietario" class="form-control" value="{{old('nombre_ap_propietario')}}">
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
     <div class="form-group" class="form-control">
       <label for="vivi_tipo">Si es hip. de vivienda Tipo</label>
       <select name="vivi_tipo"  class="form-control selectpicker" data-size="5" id="vivi_tipo" data-live-search="true" required>
         <option value="PROPIEDAD HORIZONTAL">PROPIEDAD HORIZONTAL</option>
         <option value="CASA">CASA</option>
         <option value="TERRENO">TERRENO</option>    
       </select>
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vivi_ubicacion_bien">Hubicación del bien</label>
      <input type="text" name="vivi_ubicacion_bien" class="form-control" value="{{old('vivi_ubicacion_bien')}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vivi_libro_ddrr">Libro DD.RR.</label>
      <input type="text" name="vivi_libro_ddrr" class="form-control" value="{{old('vivi_libro_ddrr')}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vivi_matricula">Matricula</label>
      <input type="text" name="vivi_matricula" class="form-control" value="{{old('vivi_matricula')}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vivi_partida">Partida</label>
      <input type="text" name="vivi_partida" class="form-control" value="{{old('vivi_partida')}}">
    </div>
  </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vivi_superficie">Superficie de Vivienda</label>
      <input type="number" step="any" name="vivi_superficie" class="form-control" value="{{old('vivi_superficie')}}">
    </div>
  </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vivi_designacion">Designación</label>
      <input type="text" name="vivi_designacion" class="form-control" value="{{old('vivi_designacion')}}">
    </div>
  </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vivi_linderos">Linderos</label>
      <input type="text" name="vivi_linderos" class="form-control" value="{{old('vivi_linderos')}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vivi_valor_comercial">Valor Comercial ($us)</label>
      <input type="number" min="0" step="any" name="vivi_valor_comercial" class="form-control" value="{{old('vivi_valor_comercial')}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vivi_valor_avaluo">Valor Avalúo ($us)</label>
      <input type="number" step="any" min="0" name="vivi_valor_avaluo" class="form-control" value="{{old('vivi_valor_avaluo')}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vivi_empresa_valuadora">Empresa Valuadora</label>
      <input type="text" name="vivi_empresa_valuadora" class="form-control" value="{{old('vivi_empresa_valuadora')}}">
    </div>
  </div>



  <div class="col-lg-12 col-sm-6 col-md-6 col-xs-12">
   <div class="callout callout-success">
    <h4 style="text-align: center;">Vehículo</h4>
  </div> 
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="vehi_tipo">Vehículo Tipo</label>
    <input type="text" name="vehi_tipo" class="form-control" value="{{old('vehi_tipo')}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="vehi_subtipo">Vehículo Sub Tipo</label>
    <input type="text" name="vehi_subtipo" class="form-control" value="{{old('vehi_subtipo')}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="vehi_marca">Marca Vehículo</label>
    <input type="text" name="vehi_marca" class="form-control" value="{{old('vehi_marca')}}">
  </div>
</div>



<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="vehi_modelo">Modelo Vehículo</label>
    <input type="text" name="vehi_modelo" class="form-control" value="{{old('vehi_modelo')}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="vehi_rua">Rua Vehículo</label>
    <input type="text" name="vehi_rua" class="form-control" value="{{old('vehi_rua')}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="vehi_placa">Placa de Vehículo</label>
    <input type="text" name="vehi_placa" class="form-control" value="{{old('vehi_placa')}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="vehi_clase">Clase Vehículo</label>
    <input type="text" name="vehi_clase" class="form-control" value="{{old('vehi_clase')}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="vehi_num_motor">Vehículo Número de motor</label>
    <input type="text" name="vehi_num_motor" class="form-control" value="{{old('vehi_num_motor')}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="vehi_chasis">Vehículo Chasis</label>
    <input type="text" name="vehi_chasis" class="form-control" value="{{old('vehi_chasis')}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="vehi_procedencia">Vehículo Procedencia</label>
    <input type="text" name="vehi_procedencia" class="form-control" value="{{old('vehi_procedencia')}}">
  </div>
</div>


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="vehi_cilindrada">Cilindrada Vehículo</label>
    <input type="text" name="vehi_cilindrada" class="form-control" value="{{old('vehi_cilindrada')}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="vehi_num_poliza"> Vehículo número de póliza</label>
    <input type="text" name="vehi_num_poliza" class="form-control" value="{{old('vehi_num_poliza')}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="vehi_color">Color Vehículo</label>
    <input type="text" name="vehi_color" class="form-control" value="{{old('vehi_color')}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="vehi_valor_comercial">Valor Comercial Vehículo ($us)</label>
    <input type="number"  step="any" name="vehi_valor_comercial" class="form-control" value="{{old('vehi_valor_comercial')}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="vehi_valor_avaluo">Valor Avalúo Vehículo ($us)</label>
    <input type="number" step="any" name="vehi_valor_avaluo" class="form-control" value="{{old('vehi_valor_avaluo')}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="vehi_empresa_valuadora">Empresa valuadora Vehículo</label>
    <input type="text" name="vehi_empresa_valuadora" class="form-control" value="{{old('vehi_empresa_valuadora')}}">
  </div>
</div>


<div class="col-lg-12 col-sm-6 col-md-6 col-xs-12">
   <div class="callout callout-success">
    <h4 style="text-align: center;">DPF</h4>
  </div> 
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="depo_nombres_titular_dpf1">Nombres apellidos de los titular 1 del DPF</label>
    <input type="text" name="depo_nombres_titular_dpf1" class="form-control" value="{{old('depo_nombres_titular_dpf1')}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="depo_nombres_titular_dpf2">Nombres apellidos de los titular 2 del DPF</label>
    <input type="text" name="depo_nombres_titular_dpf2" class="form-control" value="{{old('depo_nombres_titular_dpf2')}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="depo_entidad_emisora">Entidad Emisora del DPF</label>
    <input type="text" name="depo_entidad_emisora" class="form-control" value="{{old('depo_entidad_emisora')}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="depo_num_dpf">N° de DPF</label>
    <input type="text" name="depo_num_dpf" class="form-control" value="{{old('depo_num_dpf')}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="depo_monto">Monto DPF ($us)</label>
    <input type="number" step="any" min="0" name="depo_monto" class="form-control" value="{{old('depo_monto')}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="depo_fecha_apertura">DPF fecha de apertura</label>
    <input type="date"  name="depo_fecha_apertura" class="form-control" value="{{old('depo_fecha_apertura')}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label for="depo_fecha_vencimiento">DPF fecha de vencimiento</label>
    <input type="date"  name="depo_fecha_vencimiento" class="form-control" value="{{old('depo_fecha_vencimiento')}}">
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <button class="btn btn-primary" type="submit">Guardar</button>
   <a href="{{url('/oficial/persona')}}" class="btn btn-danger">Cancelar</a>
 </div>
</div>

</div>
</form>

@push ('scripts')
<script>
  $('#liGarantiaHipotecaria').addClass("active");
</script>
@endpush
@endsection
