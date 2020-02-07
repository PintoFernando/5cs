@extends ('layouts.admin3')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Ingreso mensual:{{$ingresos->id_ingreso_mensual}}</h3>
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


  <form method="post" action="{{url('/oficial/ingreso_mensual/'.$ingresos->id_ingreso_mensual.'/edit')}}">
  {{csrf_field()}}
  <div class="row">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="mes">Mes</label>
       <input type="text" name="mes" class="form-control" value="{{old('mes',$ingresos->mes)}}" placeholder="mes">
     </div>
   </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="anio">Año</label>
       <input type="number" min="0" name="anio" class="form-control" value="{{old('anio',$ingresos->anio)}}" placeholder="anio">
     </div>
   </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="prestatario">Prestatario</label>
       <input type="number" step="any" min="0" name="prestatario" class="form-control" value="{{old('prestatario',$ingresos->prestatario)}}" placeholder="prestatario">
     </div>
   </div>   
   
   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="conyugue">Conyugue</label>
       <input type="number" step="any" min="0" name="conyugue" class="form-control" value="{{old('conyugue',$ingresos->conyugue)}}">
     </div>
   </div>   

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="otros">Otros</label>
       <input type="number" step="any" min="0" name="otros" class="form-control" value="{{old('otros',$ingresos->otros)}}" >
     </div>
   </div> 

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="codeudores">Codeudores</label>
       <input type="number" step="any" min="0" name="codeudores" class="form-control" value="{{old('codeudores',$ingresos->codeudores)}}">
     </div>
   </div> 

  

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="descripcion">Descripción</label>
       <input type="text" name="descripcion" class="form-control" value="{{old('descripcion',$ingresos->descripcion)}}">
     </div>
   </div> 

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <button class="btn btn-primary" type="submit">Guardar</button>
     <a href="{{url('/oficial/ingreso_mensual')}}" class="btn btn-danger">Cancelar</a>
   </div>
 </div>

</div>
</form>
@include('sweetalert::alert')
@push ('scripts')
<script>
  $('#liC3').addClass("treeview active");
  $('#liIngresoMensual').addClass("active");
</script>
@endpush
@endsection
