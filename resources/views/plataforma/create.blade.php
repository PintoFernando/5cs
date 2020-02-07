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
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     @if(count($errors)>0)
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

<form method="post" action="{{url('vcliente/registrar/create')}}">
  {{csrf_field()}}
  <div class="row">
      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
           <label for="ci">Ci</label>
           <input type="text" name="ci" class="form-control" value="{{old('ci')}}" placeholder="Ci...">
       </div>
   </div>
   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
       <label for="nombre">Nombre</label>
       <input type="text" name="nombre" class="form-control" value="{{old('nombre')}}" placeholder="Nombre...">
   </div>
   </div>
   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
       <label for="ap_paterno">Ap. Paterno</label>
       <input type="text" name="ap_paterno" class="form-control" value="{{old('ap_paterno')}}" placeholder="Ap. Paterno">
   </div>
   </div>
   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
       <label for="ap_materno">Ap. Materno</label>
       <input type="text" name="ap_materno" class="form-control" value="{{old('ap_materno')}}" placeholder="Ap Materno...">
   </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
       <label for="ap_casada">Ap. Casado</label>
       <input type="text" name="ap_casada" class="form-control" value="{{old('ap_casada')}}" placeholder="Ap Casado...">
   </div>
   </div>
   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
       <label for="fec_nac">Fecha Nacimiento:</label><br>
       <input type="date" name="fec_nac" >            	
   </div>
   </div>
<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
       <label for="genero">Sexo:</label> <br>
       <label for="genero">Hombre</label>
       <input name = "genero" type = "radio" value = "hombre" >
       <label for="genero">Mujer</label>
       <input name = "genero" type = "radio" value = "mujer" >
       <label for="genero">Otro</label>
       <input name = "genero" type = "radio" value = "otro" >            	
   </div>
   </div>
   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
       <label for="celular">Celular</label>
       <input type="text" name="celular" class="form-control" value="{{old('celular')}}" placeholder="Celular...">
   </div>
   </div>
   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
       <label for="dependientes">Num. Dependientes</label>
       <input type="number" min="0" max="20" name="dependientes" class="form-control" value="{{old('dependientes')}}" placeholder="Num. Dependientes...">
   </div>
   </div>
   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group" class="form-control">
       <label for="estado_civil">Estado civil</label>
       <select name="estado_civil">
           <option value="Casado">Casado</option>
           <option value="Soltero">Soltero</option>
           <option value="Divorciado">Divorciado</option>
           <option value="Concuvino(a)">Concuvino(a)</option>
       </select>

   </div>
   </div>
<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group" class="form-control">
     <label for="id_profesion">Profesion</label>
     <select name="id_profesion"  class="form-control selectpicker" data-size="5" id="id_profesion" data-live-search="true">
       @foreach($profesiones as $pro)

       <option value="{{$pro->id_profesion}}"> {{$pro->profesion}}</option>
       @endforeach
   </select>
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
