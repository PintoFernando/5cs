@extends ('layouts.admin3')
@section ('contenido')

<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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
</div>

<form method="post" action="{{url('cliente/credito/')}}">
  {{csrf_field()}}
  <div class="row">
   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="fecha_solicitud">Fecha solifecha_solicitudtud</label>
     <input type="date" name="fecha_solicitud" class="form-control" value="{{old('fecha_solicitud')}}" required>
   </div>
 </div>
 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
     <label for="monto_solicitado">Monto Solicitud</label>
     <input type="number" step="any" min="0" name="monto_solicitado" class="form-control" value="{{old('monto_solicitado')}}" required>
   </div>
 </div>

 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group" class="form-control">
     <label for="id_tipo_moneda">Tipo moneda</label>
     <select name="id_tipo_moneda"  class="form-control selectpicker" data-size="5" id="id_tipo_moneda" data-live-search="true" required>
       @foreach($tipo_moneda as $mo)

       <option value="{{$mo->id_tipo_moneda}}"> {{$mo->tipo_moneda}}</option>
       @endforeach
     </select>
   </div>
 </div>

 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
     <label for="plazo_meses">Plazo en meses</label>
     <input type="number" name="plazo_meses" class="form-control" value="{{old('plazo_meses')}}" required>
   </div>
 </div>

 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
     <label for="plazo_meses">Día pago</label>
     <select name="dia_pago"  class="form-control selectpicker" data-size="5" id="dia_pago" data-live-search="true" required>                  
       <option value="1">1</option>                    
       <option value="2">2</option>                    
       <option value="3">3</option>                    
       <option value="4">4</option>                    
       <option value="5">5</option>                    
       <option value="6">6</option>                    
       <option value="7">7</option>                    
       <option value="8">8</option>                    
       <option value="9">9</option>                    
       <option value="10">10</option>                    
       <option value="11">11</option>                    
       <option value="12">12</option>                    
       <option value="13">13</option>                    
       <option value="14">14</option>                    
       <option value="15">15</option>                    
       <option value="16">16</option>                    
       <option value="17">17</option>                    
       <option value="18">18</option>                    
       <option value="19">19</option>                    
       <option value="20">20</option>                    
       <option value="21">21</option>                    
       <option value="22">22</option>                    
       <option value="23">23</option>                    
       <option value="24">24</option>                    
       <option value="25">25</option>                    
       <option value="26">26</option>                    
       <option value="27">27</option>                    
       <option value="28">28</option>                    
       <option value="29">29</option>                    
       <option value="30">30</option>                    
       <option value="31">31</option>                    
     </select> 
   </div>
 </div>

 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group" class="form-control">
     <label for="id_periodo_pago">Periodo Pago</label>
     <select name="id_periodo_pago"  class="form-control selectpicker" data-size="5" id="id_periodo_pago" data-live-search="true">
       @foreach($tipo_periodo_pago as $pe)

       <option value="{{$pe->id_periodo_pago}}"> {{$pe->periodo_pago}}</option>
       @endforeach
     </select>
   </div>
 </div>

 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group" class="form-control">
     <label for="id_tamortizacion">Tipo de amortización</label>
     <select name="id_tamortizacion"  class="form-control selectpicker" data-size="5" id="id_tamortizacion" data-live-search="true">
       @foreach($tipo_amortizacion as $ti)
       <option value="{{$ti->id_tamortizacion}}"> {{$ti->amortizacion}}</option>
       @endforeach
     </select>
   </div>
 </div>

 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group" class="form-control">
     <label for="id_tcredito">Tipo de crédito</label>
     <select name="id_tcredito"  class="form-control selectpicker" data-size="5" id="id_tcredito" data-live-search="true">
       @foreach($tipo_credito as $cre)
       <option value="{{$cre->id_tcredito}}"> {{$cre->tipo_credito}}</option>
       @endforeach
     </select>
   </div>
 </div>


 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group" class="form-control">
     <label for="id_destino_credito">Destino del crédito</label>
     <select name="id_destino_credito"  class="form-control selectpicker" data-size="5" id="id_destino_credito" data-live-search="true">
       @foreach($destino as $de)

       <option value="{{$de->id_destino_credito}}"> {{$de->destino_credito}}</option>
       @endforeach
     </select>
   </div>
 </div>

 
 
 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">            
  <div class="form-group">
    <hr>
    <button class="btn btn-primary" type="submit">Guardar</button>
    <a href="{{url('/oficial/credito')}}" class="btn btn-danger"> cancelar</a>
  </div>
</div>

</div>
</form>
@endsection
