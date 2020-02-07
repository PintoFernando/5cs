 @extends ('layouts.admin3')
 @section ('contenido')
 <div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Crédito:{{$cre->id_credito}}</h3>
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


<div class="row">
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

@if(session('notification'))
<div class="alert alert-success">
   {{session('notification')}}
</div>
@endif

<form method="post" action="{{url('/oficial/credito/'.$cre->id_credito.'/edit')}}">
  {{csrf_field()}}
  <div class="row">
   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="fecha_solicitud">Fecha de Solicitud</label>
     <input type="text" name="fecha_solicitud" class="form-control" value="{{old('fecha_solicitud',$cre->fecha_solicitud)}}">
   </div>
 </div>

 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="monto_solicitado">Monto Solicitado</label>
   <input type="number" step="any" name="monto_solicitado" class="form-control" value="{{old('monto_solicitado',$cre->monto_solicitado)}}">
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="interes_nominal">Interes Nominal</label>
   <input type="text" name="interes_nominal" class="form-control" value="{{old('interes_nominal',$cre->interes_nominal)}}">
 </div>
</div>


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="plazo_meses">Plazo Meses</label>
   <input type="text" name="plazo_meses" class="form-control" value="{{old('plazo_meses',$cre->plazo_meses)}}">
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="dia_pago">Dia Pago</label>
   <input type="text" name="dia_pago" class="form-control" value="{{old('dia_pago',$cre->dia_pago)}}">
 </div>
</div>




<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label>Tipo Moneda</label>
   <select name="id_tipo_moneda" class="form-control selectpicker" data-size="5" id="id_tipo_moneda" data-live-search="true">
     @foreach ($moneda as $mone)
     @if($mone->id_tipo_moneda==$cre->id_tipo_moneda)
     <option value="{{$mone->id_tipo_moneda}}" selected>{{$mone->tipo_moneda}}</option>
     @else
     <option value="{{$mone->id_tipo_moneda}}">{{$mone->tipo_moneda}}</option>
     @endif
     @endforeach
   </select> 
 </div>
</div>



<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label>Periodo pago</label>
   <select name="id_periodo_pago" class="form-control selectpicker" data-size="5" id="id_periodo_pago" data-live-search="true">
     @foreach ($periodo_pago as $peri)
     @if($peri->id_periodo_pago==$cre->id_periodo_pago)
     <option value="{{$peri->id_periodo_pago}}" selected>{{$peri->periodo_pago}}</option>
     @else
     <option value="{{$peri->id_periodo_pago}}">{{$peri->periodo_pago}}</option>
     @endif
     @endforeach
   </select> 
 </div>
</div>



<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label>Tipo de Amortización</label>
   <select name="id_tamortizacion" class="form-control selectpicker" data-size="5" id="id_tamortizacion" data-live-search="true">
     @foreach ($amortizacion as $amor)
     @if($amor->id_tamortizacion==$cre->id_tamortizacion)
     <option value="{{$amor->id_tamortizacion}}" selected>{{$amor->amortizacion}}</option>
     @else
     <option value="{{$amor->id_tamortizacion}}">{{$amor->amortizacion}}</option>
     @endif
     @endforeach
   </select> 
 </div>
</div>



<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label>Tipo Crédito</label>
   <select name="id_tcredito" class="form-control selectpicker" data-size="5" id="id_tcredito" data-live-search="true">
     @foreach ($tipo_credito as $tipo_cred)
     @if($tipo_cred->id_tcredito==$cre->id_tcredito)
     <option value="{{$tipo_cred->id_tcredito}}" selected>{{$tipo_cred->tipo_credito}}</option>
     @else
     <option value="{{$tipo_cred->id_tcredito}}">{{$tipo_cred->tipo_credito}}</option>
     @endif
     @endforeach
   </select> 
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label>Destino Crédito</label>
   <select name="id_destino_credito" class="form-control selectpicker" data-size="5" id="id_destino_credito" data-live-search="true">
     @foreach ($destino_credito as $destino)
     @if($destino->id_destino_credito==$cre->id_destino_credito)
     <option value="{{$destino->id_destino_credito}}" selected>{{$destino->destino_credito}}</option>
     @else
     <option value="{{$destino->id_destino_credito}}">{{$destino->destino_credito}}</option>
     @endif
     @endforeach
   </select> 
 </div>
</div>


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label>Forma de pago</label>
   <select name="id_forma_pago" class="form-control selectpicker" data-size="5" id="id_forma_pago" data-live-search="true">
     @foreach ($forma as $fo)
     @if($fo->id_forma_pago==$cre->id_forma_pago)
     <option value="{{$fo->id_forma_pago}}" selected>{{$fo->forma_pago}}</option>
     @else
     <option value="{{$fo->id_forma_pago}}">{{$fo->forma_pago}}</option>
     @endif
     @endforeach
   </select> 
 </div>
</div>


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <button class="btn btn-primary" type="submit">Guardar</button>
   <a href="{{url('/oficial/credito')}}" class="btn btn-default"> cancelar</a>
   <button class="btn btn-danger" type="reset">Restablecer</button>
 </div>
</div>
</div>
</form>
@push ('scripts')
<script>
$('#liC1').addClass("treeview active");
$('#liCredito').addClass("active");
</script>
@endpush
@endsection
