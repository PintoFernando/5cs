 @extends ('layouts.admin3')
 @section ('contenido')
 <div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Editar Deposito Bancario:{{$dep->id_dbancario}}</h3>
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

<form method="post" action="{{url('/deposito_bancario/'.$dep->id_dbancario.'/edit')}}">
  {{csrf_field()}}
  <div class="row">
   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="numero_cuenta">Número de Cuenta</label>
     <input type="text" name="numero_cuenta" class="form-control" value="{{old('numero_cuenta',$dep->numero_cuenta)}}">
   </div>
 </div>

 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <label for="saldo">Saldo</label>
   <input type="number" name="saldo"  step="any" class="form-control" value="{{old('saldo',$dep->saldo)}}">
 </div>
</div>



<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label>Entidad Bancaria</label>
   <select name="id_entidad_bancaria" class="form-control selectpicker" data-size="5" id="id_entidad_bancaria" data-live-search="true">
     @foreach ($entidad as $enti)
     @if($enti->id_entidad_bancaria==$dep->id_entidad_bancaria)
     <option value="{{$enti->id_entidad_bancaria}}" selected>{{$enti->nombre_entidad}}</option>
     @else
     <option value="{{$enti->id_entidad_bancaria}}">{{$enti->nombre_entidad}}</option>
     @endif
     @endforeach
   </select> 
 </div>
</div>


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label>Tipo de Deposito</label>
   <select name="id_tipo_deposito" class="form-control selectpicker" data-size="5" id="id_tipo_deposito" data-live-search="true">
     @foreach ($tipo as $ti)
     @if($ti->id_tipo_deposito==$dep->id_tipo_deposito)
     <option value="{{$ti->id_tipo_deposito}}" selected>{{$ti->nombre_deposito}}</option>
     @else
     <option value="{{$ti->id_tipo_deposito}}">{{$ti->nombre_deposito}}</option>
     @endif
     @endforeach
   </select> 
 </div>
</div>



<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <button class="btn btn-primary" type="submit">Guardar</button>
   <a href="{{url('/deposito_bancario')}}" class="btn btn-warning"> cancelar</a>
   <button class="btn btn-danger" type="reset">Restablecer</button>
 </div>
</div>
</div>
</form>
@push ('scripts')
<script>
$('#liAdmin').addClass("treeview active");
$('#liAdmin_deposito').addClass("active");
</script>
@endpush
@endsection
