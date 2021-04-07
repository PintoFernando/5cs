@extends ('layouts.admin3')
 @section ('contenido')
 <div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Editar Fotografias</h3>
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

<form method="post" action="{{url('/oficial/foto/'.$foto->id_foto.'/'.$i.'/edit')}}" enctype="multipart/form-data">
  {{csrf_field()}}
  <div class="row">


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
    <label for="fotografia">Fotografia</label>
            	<input type="file" name="fotografia" class="form-control" accept="image/*">
            	@if (($foto->archivo)!="")
            		<img src="{{asset('images/fotos/'.$foto->archivo)}}" height="300px" width="300px">
            	@endif
   </div>
 </div>

 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
   <label for="fotografia">Detalle</label>
     <div> <textarea name ="detalle" rows="3"  cols="44">{{$foto->detalle}}</textarea></div>
     
   </div>
 </div>




 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
     <button class="btn btn-primary" type="submit">Guardar</button>
     <a href="{{url('/oficial/foto')}}" class="btn btn-default"> cancelar</a>
     <button class="btn btn-danger" type="reset">Restablecer</button>
   </div>
 </div>
</div>
</form>
@push ('scripts')
<script>
  $('#liArchivos').addClass("treeview active");
  $('#liFotos').addClass("active");
</script>
@endpush
@endsection
