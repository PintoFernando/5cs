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
   <h3>Editar Prestamo Bancario:{{$prestamo->id_pbancario}}</h3>
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

<form method="post" action="{{url('/prestamo_bancario/'.$prestamo->id_pbancario.'/edit')}}">
  {{csrf_field()}}
  <div class="row">
   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="importe_original">Importe Original</label>
     <input type="number" step="any" name="importe_original" class="form-control" value="{{old('importe_original',$prestamo->importe_original)}}">
   </div>
 </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="duracion_credito">Duración Crédito</label>
     <input type="text" name="duracion_credito" class="form-control" value="{{old('duracion_credito',$prestamo->duracion_credito)}}">
   </div>
 </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="importe_ultimo_pago">Importe Último Pago</label>
     <input type="number" step="any" name="importe_ultimo_pago" class="form-control" value="{{old('importe_ultimo_pago',$prestamo->importe_ultimo_pago)}}">
   </div>
 </div>

 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="destino_credito">Destino Crédito</label>
     <input type="text" name="destino_credito" class="form-control" value="{{old('destino_credito',$prestamo->destino_credito)}}">
   </div>
 </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="saldo">Saldo</label>
     <input type="number" step="any" name="saldo" class="form-control" value="{{old('saldo',$prestamo->saldo)}}">
   </div>
 </div>



 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
     <label>Entidad Bancaria</label>
     <select name="id_entidad_bancaria" class="form-control selectpicker" data-size="5" id="id_entidad_bancaria" data-live-search="true">
       @foreach ($entidad as $ent)
       @if($ent->id_entidad_bancaria==$prestamo->id_entidad_bancaria)
       <option value="{{$ent->id_entidad_bancaria}}" selected>{{$ent->nombre_entidad}}</option>
       @else
       <option value="{{$ent->id_entidad_bancaria}}">{{$ent->nombre_entidad}}</option>
       @endif
       @endforeach
     </select> 
   </div>
 </div>


 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
     <label>Tipo Crédito</label>
     <select name="id_tcredito" class="form-control selectpicker" data-size="5" id="id_tcredito" data-live-search="true">
       @foreach ($credito as $cre)
       @if($cre->id_tcredito==$prestamo->id_tcredito)
       <option value="{{$cre->id_tcredito}}" selected>{{$cre->tipo_credito}}</option>
       @else
       <option value="{{$cre->id_tcredito}}">{{$cre->tipo_credito}}</option>
       @endif
       @endforeach
     </select> 
   </div>
 </div>

 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
     <button class="btn btn-primary" type="submit">Guardar</button>
     <a href="{{url('/prestamo_bancario')}}" class="btn btn-default"> cancelar</a>
     <button class="btn btn-danger" type="reset">Restablecer</button>
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
