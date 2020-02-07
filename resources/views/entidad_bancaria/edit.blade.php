@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Editar Entidad Bancaria</h3>
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

<form method="post" action="{{url('/entidad_bancaria/'.$entidad->id_entidad_bancaria.'/edit')}}">
  {{csrf_field()}}
  <div class="row">
   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="nombre_entidad">Nombre Afp</label>
     <input type="text" name="nombre_entidad" class="form-control" value="{{old('nombre_entidad',$entidad->nombre_entidad)}}">
   </div>
 </div>
   

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <button class="btn btn-primary" type="submit">Guardar</button>
   <a href="{{url('/entidad_bancaria')}}" class="btn btn-default"> cancelar</a>
   <button class="btn btn-danger" type="reset">Restablecer</button>
 </div>
</div>
</div>
</form>
@push ('scripts')
<script>
  $('#liAdmin_sistema').addClass("treeview active");
  $('#liAdmin_sistema_entidad').addClass("active");
</script>
@endpush
@endsection
