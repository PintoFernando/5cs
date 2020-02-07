@extends ('layouts.admin3')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Cliente:{{$persona->nombre}}</h3>
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
            <form method="post" action="{{url('/cliente/crud/'.$persona->id_persona.'/edit')}}">
                  {{csrf_field()}}
      <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
            	<label for="ci">Ci</label>
            	<input type="text" name="ci" class="form-control" value="{{old('ci',$persona->ci)}}" placeholder="Ci...">
            </div>
            </div>

             <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombre" class="form-control" value="{{old('nombre',$persona->nombre)}}"  placeholder="Nombre...">
            </div>
           </div>

          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
            	<label for="ap_paterno">Ap. Paterno</label>
            	<input type="text" name="ap_paterno" class="form-control" value="{{old('ap_paterno',$persona->ap_paterno)}} " placeholder="Ap. Paterno">
            </div>
          </div> 

           <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">           
              <div class="form-group">
            	<label for="ap_materno">Ap. Materno</label>
            	<input type="text" name="ap_materno" class="form-control" value="{{old('ap_materno',$persona->ap_materno)}} " placeholder="Ap Materno...">
            </div>
          </div>

              <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
              <div class="form-group">
            	<label for="ap_casada">Ap. Casado</label>
            	<input type="text" name="ap_casada" class="form-control" value="{{old('ap_casado',$persona->ap_casado)}}"  placeholder="Ap Casado...">
            </div>
         </div>

          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
              <div class="form-group">
            	<label for="fec_nac">Fec. nacimiento</label>
            	<input type="text" name="fec_nac" class="form-control" value="{{old('fec_nac',$persona->fec_nac)}}"  placeholder="Ap Casado...">
            </div>
          </div>
            
  

       <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
             <div class="form-group">
            	<label for="genero">Sexo</label>
            	<input type="text" name="genero" class="form-control" value="{{old('genero',$persona->genero)}}"  placeholder="Edad...">
            </div>
      </div>

       <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">            
            <div class="form-group">
            	<label for="celular">Celular</label>
            	<input type="text" name="celular" class="form-control" value="{{old('celular',$persona->celular)}}"  placeholder="Celular...">
            </div>
      </div>

       <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
            	<label for="dependientes">Num. Dependientes</label>
            	<input type="text" name="dependientes" class="form-control" value="{{old('dependientes',$persona->dependientes)}}"  placeholder="Num. Dependientes...">
            </div>
      </div>

       <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
            	<label for="estado_civil">Estado civil</label>
            	<input type="text" name="estado_civil" class="form-control" value="{{old('estado_civil',$persona->estado_civil)}}"  placeholder="Num. Dependientes...">
            </div>
      </div>

      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                     <div class="form-group">
                       <label>Profesion</label>
                       <select name="id_profesion" class="form-control selectpicker" data-size="5" id="id_profesion" data-live-search="true">
                             @foreach ($profesion as $pro)
                             @if($pro->id_profesion==$persona->id_profesion)
                                 <option value="{{$pro->id_profesion}}" selected>{{$pro->profesion}}</option>
                             @else
                                  <option value="{{$pro->id_profesion}}">{{$pro->profesion}}</option>
                             @endif

                             @endforeach
                          </select> 
                     </div>
      </div>


            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
                  <a href="{{url('/cliente/crud')}}" class="btn btn-default"> cancelar</a>
            	<button class="btn btn-danger" type="reset">Restablecer</button>
            </div>
      </div>
		
    </div>
            </form>
	
@endsection
