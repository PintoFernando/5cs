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

<form method="post" action="{{url('/oficial/foto/'.$foto->id_foto.'/edit')}}" enctype="multipart/form-data">
  {{csrf_field()}}
  <div class="row">


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
    <label for="fotografia">Fotografia</label>
            	<input type="file" name="fotografia" class="form-control">
            	@if (($foto->archivo)!="")
            		<img src="{{asset('images/fotos/'.$foto->archivo)}}" height="300px" width="300px">
            	@endif
   </div>
 </div>

 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
     <label>Categoria</label>
     <select name="id_categoria_foto" class="form-control selectpicker" data-size="5" id="id_categoria_foto" data-live-search="true">
       @foreach ($categoria as $ca)
       @if($ca->id_categoria_foto==$foto->id_categoria_foto)
       <option value="{{$ca->id_categoria_foto}}" selected>{{$ca->categoria}}</option>
       @else
       <option value="{{$ca->id_categoria_foto}}">{{$ca->categoria}}</option>
       @endif
       @endforeach
     </select> 
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
