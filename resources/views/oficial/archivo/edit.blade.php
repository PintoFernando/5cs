@extends ('layouts.admin3')
 @section ('contenido')
 <div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Editar Archivos</h3>
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

<form method="post" action="{{url('/oficial/archivo/'.$archivos->id_archivo.'/edit')}}" enctype="multipart/form-data">
  {{csrf_field()}}
  <div class="row">


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
    <label for="fotografia">Archivo</label>
            	<input type="file" name="archivo" class="form-control" accept="application/pdf,.docx,.doc,.xlsx,.xls" required="">
            
   </div>
 </div>

 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
     <label>Categoria</label>
     <select name="id_categoria_archivo" class="form-control selectpicker" data-size="5" id="id_categoria_archivo" data-live-search="true">
       @foreach ($categoria as $ca)
       @if($ca->id_categoria_archivo==$archivos->id_categoria_archivo)
       <option value="{{$ca->id_categoria_archivo}}" selected>{{$ca->categoria}}</option>
       @else
       <option value="{{$ca->id_categoria_archivo}}">{{$ca->categoria}}</option>
       @endif
       @endforeach
     </select> 
   </div>
 </div>




 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
     <button class="btn btn-primary" type="submit">Guardar</button>
     <a href="{{url('/oficial/archivo')}}" class="btn btn-default"> cancelar</a>
     <button class="btn btn-danger" type="reset">Restablecer</button>
   </div>
 </div>
</div>
</form>
@push ('scripts')
<script>
  $('#liArchivos').addClass("treeview active");
  $('#liArchivo').addClass("active");
</script>
@endpush
@endsection
