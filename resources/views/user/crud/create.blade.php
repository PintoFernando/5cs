@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Nuevo usuario</h3>
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

<form method="post" action="{{url('/user/crud')}}" enctype="multipart/form-data">
  {{csrf_field()}}
  <div class="row">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
      <div class="form-group">
       <label for="name">name:</label>
       <input type="text" name="name" id="name" class="form-control"  placeholder="Nombre..." required>
     </div>
   </div>
   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
     <div class="form-group">
       <label for="email">email:</label>
       <input type="email" name="email" id="email" class="form-control"  placeholder="Email..." required>
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="password">password:</label>
     <input type="password" name="password" id="password"class="form-control"  placeholder="Contraseña" required>
   </div>
 </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="fotografia">Fotografía</label>
     <input type="file" name="fotografia" id="fotografia"class="form-control"  required>
   </div>
 </div>


 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
     <label>Rol</label>
     <select name="id_rol" class="form-control selectpicker" data-size="5" id="id_rol" data-live-search="true">
       @foreach ($roles as $ro)

       <option value="{{$ro->id_rol}}">{{$ro->rol}}</option>


       @endforeach
     </select> 
   </div>
 </div>
 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <button class="btn btn-primary" type="submit">Guardar</button>
   <a href="{{url('/user/crud')}}" class="btn btn-danger">cancelar</a>
 </div>
</div>
</div>
</form>


@endsection
