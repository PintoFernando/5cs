@extends ('layouts.admin3')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Venta Comercialización:{{$ventas->id_venta_comercializacion}}</h3>
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

  <form method="post" action="{{url('oficial/venta_comercializacion_producto/'.$ventas->id_venta_comercializacion.'/edit')}}">
  {{csrf_field()}}
  <div class="row">

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="producto">Producto</label>
       <input type="text" name="producto" class="form-control" value="{{old('producto',$ventas->producto)}}" placeholder="Producto">
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="cantidad">Cantidad</label>
       <input type="number" name="cantidad" class="form-control" value="{{old('cantidad',$ventas->cantidad)}}">
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="unidad_medida">Unidad de Medida</label>
       <input type="Text" name="unidad_medida" class="form-control" value="{{old('unidad_medida',$ventas->unidad_medida)}}">
     </div>
  </div>

     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="unidad_medida">Compra costo unitario</label>
       <input type="number" step="any" name="c_costo_unitario" class="form-control" value="{{old('c_costo_unitario',$ventas->c_costo_unitario)}}">
     </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="v_costo_unitario">Compra costo total</label>
       <input type="number" step="any" name="c_costo_total" class="form-control" value="{{old('c_costo_total',$ventas->c_costo_total)}}">
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="v_costo_unitario">Venta precio unitario</label>
       <input type="number" step="any" name="v_precio_unitario" class="form-control" value="{{old('v_precio_unitario',$ventas->v_precio_unitario)}}">
     </div>
   </div>


   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="v_costo_unitario">Venta precio total</label>
       <input type="number" step="any" name="v_precio_total" class="form-control" value="{{old('v_precio_total',$ventas->v_precio_total)}}">
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="v_costo_unitario">Utilidad</label>
       <input type="number" step="any" name="utilidad" class="form-control" value="{{old('utilidad',$ventas->utilidad)}}">
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="v_costo_unitario">Porcentaje</label>
       <input type="number" step="any" name="porcentaje" class="form-control" value="{{old('porcentaje',$ventas->porcentaje)}}">
     </div>
   </div>


   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <button class="btn btn-primary" type="submit">Guardar</button>
     <button class="btn btn-danger" type="reset">Cancelar</button>
   </div>
 </div>

</div>
</form>
@endsection
