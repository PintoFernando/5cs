@extends ('layouts.admin3')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Inmueble:{{$in->id_inmueble}}</h3>
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
            <form method="post" action="{{url('/oficial/a_garantes/inmueble/'.$in->id_inmueble.'/edit')}}">
                  {{csrf_field()}}
            <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">      
            <div class="form-group">
            	<label for="ciudad">Ciudad</label>
            	<input type="text" name="ciudad" class="form-control" value="{{old('ciudad',$in->ciudad)}}" >
            </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
            	<label for="calle">Calle</label>
            	<input type="text" name="calle" class="form-control" value="{{old('calle',$in->calle)}}">
            </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
            	<label for="numero">Numero</label>
            	<input type="number" min="0" name="numero" class="form-control" value="{{old('numero',$in->numero)}}">
            </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
            	<label for="zona">Zona</label>
            	<input type="text" name="zona" class="form-control" value="{{old('zona',$in->zona)}} " >
            </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
              <label for="num_folio_real">Num de Folio Real</label>
              <input type="number" min="0" name="num_folio_real" class="form-control" value="{{old('num_folio_real',$in->num_folio_real)}}">
            </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
              <label for="fecha_registro">Fecha de Registro</label>
              <input type="date" name="fecha_registro" class="form-control" value="{{old('fecha_registro',$in->fecha_registro)}}">
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

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label for="detalle">Detalle</label>
              <input type="text" name="detalle" class="form-control" value="{{old('detalle',$in->detalle)}}"  >
            </div>
            </div>


            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
            	<label for="valor">Valor</label>
            	<input type="number" name="valor" class="form-control" value="{{old('valor',$in->valor)}}"  >
            </div>
            </div>
             


           <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
              <button class="btn btn-info" type="reset">Restablecer</button>
                  <a href="{{url('/oficial/a_garantes/inmueble/')}}" class="btn btn-danger"> cancelar</a>
            </div>
            </div>
		
            </form>
		</div>
	</div>
@push ('scripts')
<script>
  $('#liGarante').addClass("treeview active");
  $('#liGarante_sub_inmueble').addClass("active");
</script>
@endpush
@endsection
