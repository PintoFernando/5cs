@extends ('layouts.admin3')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Cliente</h3>
         <hr>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			   <form method="post" action="{{url('/cliente/crud')}}">
              {{csrf_field()}}
            
             <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                     <div class="form-group">
                       <label>Los datos corresponden a la persona:</label>
                       <select name="id_persona" class="form-control selectpicker" data-size="5" id="id_persona" data-live-search="true">

                             @foreach ($personas as $pe)
                                 <option value="{{$pe->id_persona}}">{{$pe->ap_paterno.' '.$pe->ap_materno.' '.$pe->nombre.' '.'ID:'.$pe->id_persona.' CI:'.$pe->ci}}</option>
                             @endforeach
                          </select> 
                     </div>
               </div>
         
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
 
		</form>
            
		</div>
	</div>
@endsection
