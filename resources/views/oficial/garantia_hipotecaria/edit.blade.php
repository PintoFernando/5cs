 @extends ('layouts.admin3')
 @section ('contenido')
 <div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Editar Garantia Hipotecaria</h3>
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

<form method="post" action="{{url('/oficial/garantia_hipotecaria/'.$garantia->id_garantia_hipotecaria.'/edit')}}">
  {{csrf_field()}}
  <div class="row">

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="nombre_ap_propietario">Nombre Apellido dueño de la garantia</label>
      <input type="text" name="nombre_ap_propietario" class="form-control" value="{{old('nombre_ap_propietario',$garantia->nombre_ap_propietario)}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vivi_tipo">Tipo vivienda</label>
      <input type="text" name="vivi_tipo" class="form-control" value="{{old('vivi_tipo',$garantia->vivi_tipo)}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vivi_ubicacion_bien">Ubicación Del Bien</label>
      <input type="text" name="vivi_ubicacion_bien" class="form-control" value="{{old('vivi_ubicacion_bien',$garantia->vivi_ubicacion_bien)}}">
    </div>
  </div>


  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vivi_libro_ddrr">Libro DD.RR.</label>
      <input type="text" name="vivi_libro_ddrr" class="form-control" value="{{old('vivi_libro_ddrr',$garantia->vivi_libro_ddrr)}}">
    </div>
  </div>


  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vivi_matricula">Matricula</label>
      <input type="text" name="vivi_matricula" class="form-control" value="{{old('vivi_matricula',$garantia->vivi_matricula)}}">
    </div>
  </div>


  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vivi_partida">Partida</label>
      <input type="text" name="vivi_partida" class="form-control" value="{{old('vivi_partida',$garantia->vivi_partida)}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vivi_superficie">Superficie de Vivienda (m2)</label>
      <input type="text" name="vivi_superficie" class="form-control" value="{{old('vivi_superficie',$garantia->vivi_superficie)}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vivi_designacion">Designación</label>
      <input type="text" name="vivi_designacion" class="form-control" value="{{old('vivi_designacion',$garantia->vivi_designacion)}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vivi_linderos">Linderos</label>
      <input type="text" name="vivi_linderos" class="form-control" value="{{old('vivi_linderos',$garantia->vivi_linderos)}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vivi_valor_comercial">Valor comercial vivienda ($us)</label>
      <input type="number" step="any" min="0" name="vivi_valor_comercial" class="form-control" value="{{old('vivi_valor_comercial',$garantia->vivi_valor_comercial)}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vivi_valor_avaluo">Valor avalúo vivienda ($us)</label>
      <input type="number" step="any" min="0" name="vivi_valor_avaluo" class="form-control" value="{{old('vivi_valor_avaluo',$garantia->vivi_valor_avaluo)}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vivi_empresa_valuadora">Empresa Valuadora</label>
      <input type="text" name="vivi_empresa_valuadora" class="form-control" value="{{old('vivi_empresa_valuadora',$garantia->vivi_empresa_valuadora)}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vehi_tipo">Tipo vehículo</label>
      <input type="text" name="vehi_tipo" class="form-control" value="{{old('vehi_tipo',$garantia->vehi_tipo)}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vehi_marca">Marca vehículo</label>
      <input type="text" name="vehi_marca" class="form-control" value="{{old('vehi_marca',$garantia->vehi_marca)}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vehi_modelo">Modelo vehículo</label>
      <input type="text" name="vehi_modelo" class="form-control" value="{{old('vehi_modelo',$garantia->vehi_modelo)}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vehi_rua">RUA vehículo</label>
      <input type="text" name="vehi_rua" class="form-control" value="{{old('vehi_rua',$garantia->vehi_rua)}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vehi_placa">Placa de Vehículo</label>
      <input type="text" name="vehi_placa" class="form-control" value="{{old('vehi_placa',$garantia->vehi_placa)}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vehi_clase">Clase Vehículo</label>
      <input type="text" name="vehi_clase" class="form-control" value="{{old('vehi_clase',$garantia->vehi_clase)}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vehi_num_motor">Vehículo Número de motor</label>
      <input type="text" name="vehi_num_motor" class="form-control" value="{{old('vehi_num_motor',$garantia->vehi_num_motor)}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vehi_chasis">Vehículo Chasis</label>
      <input type="text" name="vehi_chasis" class="form-control" value="{{old('vehi_chasis',$garantia->vehi_chasis)}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vehi_procedencia">Vehículo Procedencia</label>
      <input type="text" name="vehi_procedencia" class="form-control" value="{{old('vehi_procedencia',$garantia->vehi_procedencia)}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vehi_cilindrada">Vehículo Cilindrada</label>
      <input type="text" name="vehi_cilindrada" class="form-control" value="{{old('vehi_cilindrada',$garantia->vehi_cilindrada)}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vehi_num_poliza">Vehículo número de póliza</label>
      <input type="text" name="vehi_num_poliza" class="form-control" value="{{old('vehi_num_poliza',$garantia->vehi_num_poliza)}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vehi_color"> Color Vehículo</label>
      <input type="text" name="vehi_color" class="form-control" value="{{old('vehi_color',$garantia->vehi_color)}}">
    </div>
  </div>


  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vehi_valor_comercial">Vehículo valor comercial ($us)</label>
      <input type="number" step="any" min="0" name="vehi_valor_comercial" class="form-control" value="{{old('vehi_valor_comercial',$garantia->vehi_valor_comercial)}}">
    </div>
  </div>




  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vehi_valor_avaluo">Vehículo Valor Avalúo ($us)</label>
      <input type="number" step="any" min="0" name="vehi_valor_avaluo" class="form-control" value="{{old('vehi_valor_avaluo',$garantia->vehi_valor_avaluo)}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="vehi_empresa_valuadora">Empresa valuadora de vehículo</label>
      <input type="text" name="vehi_empresa_valuadora" class="form-control" value="{{old('vehi_empresa_valuadora',$garantia->vehi_empresa_valuadora)}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="depo_nombres_titular_dpf1">Nombre titular 1 DPF </label>
      <input type="text" name="depo_nombres_titular_dpf1" class="form-control" value="{{old('depo_nombres_titular_dpf1',$garantia->depo_nombres_titular_dpf1)}}">
    </div>
  </div>


  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="depo_nombres_titular_dpf2">Nombre titular 2 DPF </label>
      <input type="text" name="depo_nombres_titular_dpf2" class="form-control" value="{{old('depo_nombres_titular_dpf2',$garantia->depo_nombres_titular_dpf2)}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="depo_entidad_emisora">Entidad emisora DPF</label>
      <input type="text" name="depo_entidad_emisora" class="form-control" value="{{old('depo_entidad_emisora',$garantia->depo_entidad_emisora)}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="depo_num_dpf">N° DPF</label>
      <input type="text" name="depo_num_dpf" class="form-control" value="{{old('depo_num_dpf',$garantia->depo_num_dpf)}}">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="depo_monto">Monto DPF ($us)</label>
      <input type="number" step="any" min="0" name="depo_monto" class="form-control" value="{{old('depo_monto',$garantia->depo_monto)}}">
    </div>
  </div>  

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="depo_fecha_apertura">DPF fecha de apertura</label>
      <input type="date"  name="depo_fecha_apertura" class="form-control" value="{{old('depo_fecha_apertura',$garantia->depo_fecha_apertura)}}">
    </div>
  </div> 

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="depo_fecha_vencimiento">DPF fecha vencimiento</label>
      <input type="date"  name="depo_fecha_vencimiento" class="form-control" value="{{old('depo_fecha_vencimiento',$garantia->depo_fecha_vencimiento)}}">
    </div>
  </div> 

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
     <button class="btn btn-primary" type="submit">Guardar</button>
     <a href="{{url('/oficial/garantia_hipotecaria')}}" class="btn btn-default"> cancelar</a>
     <button class="btn btn-danger" type="reset">Restablecer</button>
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
