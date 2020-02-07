@extends ('layouts.admin3')
@section ('contenido')

<!-- div usuario seleccionado-->
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12" style="float:right;">
    <div class="info-box bg-light-blue">
      <span class="info-box-icon"><i class="fa fa-user text-orange"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Codeudor seleccionado</span>
        <span class="info-box-number"> </span>
        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
          {{Session::get('id_persona_oficial_codeudor','Codeudor no seleccionado')}}
        </span>
      </div>
    </div>
  </div>
  
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
    </div>
  </div>
</div>
<!-- div usuario seleccionado-->


	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Mano de Obra:{{$mano->id_mano_obra}}</h3>
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
            <form method="post" action="{{url('/oficial/a_codeudores/mano_obra/'.$mano->id_mano_obra.'/edit')}}">
                  {{csrf_field()}}

            <div class="row">
            
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label for="descripcion_cargo">Descripcion Cargo</label>
              <input type="text" name="descripcion_cargo" class="form-control" value="{{old('descripcion_cargo',$mano->descripcion_cargo)}}" >
            </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label for="num_personas">num_personas</label>
              <input type="number" name="num_personas" class="form-control" value="{{old('num_personas',$mano->num_personas)}}" >
            </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label for="sueldo_mensual">Sueldo Mensual</label>
              <input type="number" step="any" name="sueldo_mensual" min="0" class="form-control" value="{{old('sueldo_mensual',$mano->sueldo_mensual)}}" >
            </div>
            </div>                     
            </div>                     
                        
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
              <button class="btn btn-info" type="reset">Restablecer</button>
                  <a href="{{url('/oficial/a_codeudores/mano_obra/')}}" class="btn btn-danger">Cancelar</a>
            </div>
		
            </form>
	    @push ('scripts')
<script>
  $('#liCodeudor').addClass("treeview active");
  $('#liCodeudor_sub_mano_obra').addClass("active");
</script>
@endpush
@endsection
