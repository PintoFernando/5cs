@extends ('layouts.admin3')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Inversiones Financieras:{{$inversiones->id_inversion_financiera}}</h3>
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


  <form method="post" action="{{url('inversiones_financieras/'.$inversiones->id_inversion_financiera.'/edit')}}">
  {{csrf_field()}}
  <div class="row">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="cantidad">Cantidad</label>
       <input type="number" name="cantidad" class="form-control" value="{{old('cantidad',$inversiones->cantidad)}}">
     </div>
   </div>

     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="porcentaje_patrimonio_empre">% Patrimonio Empresarial</label>
       <input type="number" step="any" name="porcentaje_patrimonio_empre" class="form-control" value="{{old('porcentaje_patrimonio_empre',$inversiones->porcentaje_patrimonio_empre)}}">
     </div>
   </div>

     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="nit">NIT</label>
       <input type="text" name="nit" class="form-control" value="{{old('nit',$inversiones->nit)}}">
     </div>
   </div>

     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="nombre_empresa">Nombre de la Empresa</label>
       <input type="text" name="nombre_empresa" class="form-control" value="{{old('nombre_empresa',$inversiones->nombre_empresa)}}">
     </div>
   </div>

     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="valor_nominal">Valor Nominal</label>
       <input type="number" step="any" name="valor_nominal" class="form-control" value="{{old('valor_nominal',$inversiones->valor_nominal)}}">
     </div>
   </div>

     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="valor_mercado">Valor de Mercado</label>
       <input type="number" step="any" name="valor_mercado" class="form-control" value="{{old('valor_mercado',$inversiones->valor_mercado)}}">
     </div>
   </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="detalle">Detalle</label>      
       <textarea name="detalle" rows="2" class="form-control" value="" > {{old('detalle',$inversiones->detalle)}} </textarea>      
     </div>
   </div>   

 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
     <div class="form-group">
       <button class="btn btn-primary" type="submit">Guardar</button>
       <button class="btn btn-info" type="reset">Restablecer</button>
       <a href="{{url('/inversiones_financieras')}}" class="btn btn-danger">Cancelar</a>
     </div>
   </div>

</div>
</form>
@push ('scripts')
<script>
  $('#liAdmin').addClass("treeview active");
  $('#liAdmin_inversiones').addClass("active");
</script>
@endpush
@endsection
