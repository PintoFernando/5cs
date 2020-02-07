 @extends ('layouts.admin3')
@section ('contenido')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Editar Dirección Domiciliaria del Solicitante: {{$dir->id_direccion}}</h3>
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

  <form method="post" action="{{url('/oficial/direccion/'.$dir->id_direccion.'/edit')}}">
    {{csrf_field()}}
<div class="row">
   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="direc_numero">Número de Dirección</label>
       <input type="text" name="direc_numero" class="form-control" value="{{old('direc_numero',$dir->direc_numero)}}">
     </div>
   </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="ciudad">Ciudad</label>
       <input type="text" name="ciudad" class="form-control" value="{{old('ciudad',$dir->ciudad)}}">
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="provincia">Provincia</label>
       <input type="text" name="provincia" class="form-control" value="{{old('provincia',$dir->provincia)}}">
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="localidad">Localidad</label>
       <input type="text" name="localidad" class="form-control" value="{{old('localidad',$dir->localidad)}}">
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="zona">Zona</label>
       <input type="text" name="zona" class="form-control" value="{{old('zona',$dir->zona)}}">
     </div>
   </div>

  

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="cll_principal">Calle Principal</label>
       <input type="text" name="cll_principal" class="form-control" value="{{old('cll_principal',$dir->cll_principal)}}">
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="cll_secundaria">Calle Secundaria</label>
       <input type="text" name="cll_secundaria" class="form-control" value="{{old('cll_secundaria',$dir->cll_secundaria)}}">
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="tiempo_residencia">Tiempo Residencia</label>
       <input type="text" name="tiempo_residencia" class="form-control" value="{{old('tiempo_residencia',$dir->tiempo_residencia)}}">
     </div>
   </div>

  
   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
     <label>Tipo Vivienda</label>
     <select name="id_tipo_vivienda" class="form-control selectpicker" data-size="5" id="id_tipo_vivienda" data-live-search="true">
       @foreach ($tipo_casa as $tipo_casa)
       @if($tipo_casa->id_tipo_vivienda==$dir->id_tipo_vivienda)
       <option value="{{$tipo_casa->id_tipo_vivienda}}" selected>{{$tipo_casa->tipo_vivienda}}</option>
       @else
       <option value="{{$tipo_casa->id_tipo_vivienda}}">{{$tipo_casa->tipo_vivienda}}</option>
       @endif
       @endforeach
     </select> 
   </div>
 </div>
    
 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
     <div class="form-group">
       <button class="btn btn-primary" type="submit">Guardar</button>
       <a href="{{url('/oficial/direccion')}}" class="btn btn-default"> cancelar</a>
       <button class="btn btn-danger" type="reset">Restablecer</button>
     </div>
   </div>
</div>
   </form>
@push ('scripts')
<script>
  $('#liC1').addClass("treeview active");
  $('#liDireccion').addClass("active");
</script>
@endpush
@endsection
