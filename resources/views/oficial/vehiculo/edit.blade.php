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
    <h3>Editar Vehiculo:{{$vehiculo->id_vehiculo}}</h3>
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
  <form method="post" action="{{url('/oficial/vehiculo/'.$vehiculo->id_vehiculo.'/edit')}}">
    {{csrf_field()}}
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="form-group">
       <label for="tipo">Tipo</label>
       <input type="text" name="tipo" class="form-control" value="{{old('tipo',$vehiculo->tipo)}}" placeholder="tipo...">
     </div>
   </div>
   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
     <label for="marca">Marca</label>
     <input type="text" name="marca" class="form-control" value="{{old('marca',$vehiculo->marca)}}"  placeholder="marca...">
   </div>
 </div>
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
  <div class="form-group">
   <label for="modelo">Modelo</label>
   <input type="text"  name="modelo" class="form-control" value="{{old('modelo',$vehiculo->modelo)}} " placeholder="modelo...">
 </div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
  <div class="form-group">
   <label for="placa">Placa</label>
   <input type="text" name="placa" class="form-control" value="{{old('placa',$vehiculo->placa)}} " placeholder="placa...">
 </div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
  <div class="form-group">
   <label for="rua">Rua</label>
   <input type="number" min="0" name="rua" class="form-control" value="{{old('rua',$vehiculo->rua)}}"  placeholder="Rua...">
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
  <label for="en_garantia">En Garantia</label>
  <select name="en_garantia" class="form-control selectpicker" data-size="5" id="en_garantia" data-live-search="true">
    <option value="1">Si</option>
    <option value="0">No</option>
  </select>
</div>
</div>


<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
  <div class="form-group">
   <label for="detalle">detalle</label>
   <input type="text" name="detalle" class="form-control" value="{{old('detalle',$vehiculo->detalle)}}"  placeholder="detalle...">
 </div>
</div>


<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
  <div class="form-group">
   <label for="valor">Valor</label>
   <input type="number" step="any" name="valor" class="form-control" value="{{old('valor',$vehiculo->valor)}}"  placeholder="valor...">
 </div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">            
  <div class="form-group">
    <button class="btn btn-primary" type="submit">Guardar</button>
    <button class="btn btn-info" type="reset">Restablecer</button>
    <a href="{{url('/oficial/vehiculo')}}" class="btn btn-danger">Cancelar</a>
  </div>
</div>    
</form>
</div>

@push ('scripts')
<script>
  $('#liC2').addClass("treeview active");
  $('#liVehiculo').addClass("active");
</script>
@endpush
@endsection
