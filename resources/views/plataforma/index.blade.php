@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
	

	<div class="box-body">		
		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Paso 1</h4>
			Registrar datos personales.
		</div>
	</div>
</div>

<div>
	<a href="{{url('/cliente/vcliente/registrar/create')}}"><button class="btn btn-success">Siguiente</button></a>
</div>
@endsection