@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <h3>Editar Inventario:{{$inventario->id_imercaderia}}</h3>
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
<form method="post" action="{{url('/oficial/inventario_mercaderia/'.$inventario->id_imercaderia.'/edit')}}">
  {{csrf_field()}}
  <div class="row">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
        <label for="detalle">Detalle</label>
        <input type="text" name="detalle" class="form-control" value="{{old('detalle',$inventario->detalle)}}" >
      </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
        <label for="cantidad">Cantidad</label>
        <input type="number" name="cantidad" class="form-control" value="{{old('cantidad',$inventario->cantidad)}}" >
      </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
        <label for="unidad_medida">Unidad Medida</label>
        <input type="text" name="unidad_medida" class="form-control" value="{{old('unidad_medida',$inventario->unidad_medida)}}" >
      </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
        <label for="precio_unitario">Precio Unitario</label>
        <input type="number" step="any" name="precio_unitario" min="0" class="form-control" value="{{old('precio_unitario',$inventario->precio_unitario)}}" >
      </div>
    </div>


    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
        <label for="total">Total</label>
        <input type="number" step="any" name="total" min="0" class="form-control" value="{{old('total',$inventario->total)}}" >
      </div>
    </div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <button class="btn btn-primary" type="submit">Guardar</button>
   <button class="btn btn-info" type="reset">Restablecer</button>
   <a href="{{url('/oficial/inventario_mercaderia')}}" class="btn btn-danger">Cancelar</a>
 </div>
  </div>

</div>
</form>
 @push ('scripts')
<script>
  $('#liC2').addClass("treeview active");
  $('#liInventarioMercaderia').addClass("active");
</script>
@endpush
@endsection
