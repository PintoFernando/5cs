@extends ('layouts.admin3')
@section ('contenido')

<div class="row">

  <div class="col-md-3 col-sm-6 col-xs-12" style="float:right;">
    <div class="info-box bg-yellow">
      <span class="info-box-icon"><i class="fa fa-user text-black"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Garante seleccionado</span>
        <span class="info-box-number"> </span>
        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
          {{Session::get('id_persona_oficial_garante','Usuario no seleccionado')}}
        </span>
      </div>
    </div>
  </div>


<div class="col-md-3 col-sm-6 col-xs-12" style="float:right;">
    <div class="info-box bg-green">
      <span class="info-box-icon"><i class="fa fa-user"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">S. Seleccionado</span>
        <span class="info-box-number"> </span>

        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
          {{Session::get('id_persona_oficial','Usuario no seleccionado')}}
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
</div>
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <h3>Registrar Bien del hogar Garante</h3>
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


<form method="post" action="{{url('oficial/a_garantes/bienes_hogar/')}}">
  {{csrf_field()}}
  <div class="row">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="articulo">Artículo</label>
       <input type="text" name="articulo" class="form-control" value="{{old('articulo')}}" >
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="descripcion">Descripción</label>
       <input type="text" name="descripcion" class="form-control" value="{{old('descripcion')}}" >
     </div>
   </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="marca">Marca</label>
       <input type="text" name="marca" class="form-control" value="{{old('marca')}}" >
     </div>
   </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" >
      <div class="form-group">
       <label for="color">Color</label>
       <input type="text" name="color" class="form-control" value="{{old('color')}}" >
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="modelo">Modelo</label>
       <input type="text" name="modelo" class="form-control" value="{{old('modelo')}}" >
     </div>
   </div>

      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="estado">Estado</label>
       <input type="text" name="estado" class="form-control" value="{{old('estado')}}" >
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="valor">valor</label>
       <input type="number" step="any" name="valor" min="0" class="form-control" value="{{old('valor')}}" required>
     </div>
   </div>   

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
   <button class="btn btn-primary" type="submit">Guardar</button>
   <a href="{{url('/oficial/a_garantes/bienes_hogar')}}" class="btn btn-danger"> cancelar</a>

 </div>
</div>

</div>
</form>
@include('sweetalert::alert')
@push ('scripts')
<script>
  $('#liGarante').addClass("treeview active");
  $('#liGarante_sub_bienes').addClass("active");
</script>
@endpush
@endsection
