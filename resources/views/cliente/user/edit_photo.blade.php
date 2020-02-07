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

<form method="post" action="{{url('/cliente/user/'.$users->id_users.'/edit_picture')}}" enctype="multipart/form-data">
  {{csrf_field()}}
  <input type='hidden' name='_method' value='PATCH'>
  <div class="row">
   

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
      <div class="form-group">
        <label for="fotografia">Foto de Perfil</label>
        <input type="file" name="fotografia" class="form-control" required="">
      </div>
    </div>

   <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <div class="form-group">
      <button class="btn btn-primary" type="submit">Guardar</button>
      <a href="{{url('cliente/user')}}" class="btn btn-default">cancelar</a>
      <button class="btn btn-danger" type="reset">Restablecer</button>
    </div>
  </div>

</div>
</form>
@endsection
