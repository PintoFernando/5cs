@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Editar Usuario:{{$users->name}}</h3>
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

<form method="post" action="{{url('/user/crud/'.$users->id_users.'/edit')}}" enctype="multipart/form-data">
  {{csrf_field()}}
  <input type='hidden' name='_method' value='PATCH'>
  
  <div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
      <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" class="form-control" value="{{old('name',$users->name)}}" placeholder="Nombre...">
      </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" class="form-control" value="{{old('email',$users->email)}}"  placeholder="Email...">
      </div>
    </div>


   <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
     <div class="form-group">
       <label>Rol</label>
       <select name="id_rol" class="form-control selectpicker" data-size="5" id="id_rol" data-live-search="true">
         @foreach ($roles as $ro)
         @if($ro->id_rol==$users->id_rol)
         <option value="{{$ro->id_rol}}" selected>{{$ro->rol}}</option>
         @else
         <option value="{{$ro->id_rol}}">{{$ro->rol}}</option>
         @endif

         @endforeach
       </select> 
     </div>
   </div>


   <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <div class="form-group">
      <button class="btn btn-primary" type="submit">Guardar</button>
      <a href="{{url('user/crud')}}" class="btn btn-default"> cancelar</a>
      <button class="btn btn-danger" type="reset">Restablecer</button>
    </div>
  </div>

</div>
</form>
@endsection
