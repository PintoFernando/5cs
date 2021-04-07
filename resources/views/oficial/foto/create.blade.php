
     
     
@extends ('layouts.admin3')
@section ('contenido')

<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <h3>Subir fotografía</h3>
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
<!-- div usuario seleccionado-->
<div class="col-md-3 col-sm-6 col-xs-12" style="float:right;">
    <div class="info-box bg-green">
      <span class="info-box-icon"><i class="fa fa-user"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">U. Seleccionado</span>
        <span class="info-box-number"> </span>
        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
          {{Session::get('id_persona_oficial','Usuario no seleccionado')}}
        </span>
      </div>
    </div>
  </div>
<!-- div usuario seleccionado-->
</div>
<!-- ponemos un if porque es la primera foto que se coloca para que no genere error -->
@foreach ($tipocroquis as $tip)                     
<form method="post" action="{{url('/oficial/foto/'.$tip.'/prueba')}}" enctype="multipart/form-data">
@endforeach
  {{csrf_field()}}
  <div class="col-md-7 col-sm-6 col-xs-12" >
   <div class="form-group">
     <label for="archivo">Titulo de las Fotos</label>
     <textarea name="titulo"  class="form-control" rows="1" cols="60"></textarea>
   </div>
  
  <div class="form-group">
    <label for="archivo">Descripcion De Las Fotos</label>
    <textarea name="detalle" class="form-control" rows="10" cols="60"></textarea>
  </div>
  
  <div class="form-group">
    <input type="file"  name="fotografia[]" multiple accept="image/*" class="form-control" value="{{old('fotografia')}}" required>
  </div>
   
   <div class="form-group">
     <button class="btn btn-primary" type="submit">Guardar</button>
     <a href="{{url('/oficial/foto')}}" class="btn btn-danger">Cancelar</a>
   </div>

   </div>
</form>





@push('scripts')
<script>
  $('#liArchivos').addClass("treeview active");
  $('#liFotos').addClass("active");
</script>
@endpush
@endsection
