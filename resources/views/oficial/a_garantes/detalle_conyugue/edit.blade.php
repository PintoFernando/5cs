@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Editar Detalle Conyugue</h3>
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

<form method="post" action="{{url('/oficial/a_garantes/detalle_conyugue/'.$detalle->id_detalle_persona.'/edit')}}">
  {{csrf_field()}}
  <div class="row">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
        <label for="ocupacion">Ocupación</label>
        <input type="text" name="ocupacion" class="form-control" value="{{old('ocupacion',$detalle->ocupacion)}}">
      </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
        <label for="cargo">Cargo</label>
        <input type="text" name="cargo" class="form-control" value="{{old('cargo',$detalle->cargo)}}">
      </div>
    </div>


    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
        <label for="tiempo_trabajo">Tiempo Trabajo</label>
        <input type="text" name="tiempo_trabajo" class="form-control" value="{{old('tiempo_trabajo',$detalle->tiempo_trabajo)}}">
      </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
        <label for="nombre_institucion">Nombre Empresa/Institución</label>
        <input type="text" name="nombre_institucion" class="form-control" value="{{old('nombre_institucion',$detalle->nombre_institucion)}}">
      </div>
    </div>


    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
        <label for="calle_principal">Calle Principal</label>
        <input type="text" name="calle_principal" class="form-control" value="{{old('calle_principal',$detalle->calle_principal)}}">
      </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
        <label for="calle_secundaria">Calle Secundaria</label>
        <input type="text" name="calle_secundaria" class="form-control" value="{{old('calle_secundaria',$detalle->calle_secundaria)}}">
      </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" class="form-control" value="{{old('telefono',$detalle->telefono)}}">
      </div>
    </div>


    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
     <div class="form-group">
       <button class="btn btn-primary" type="submit">Guardar</button>
       <a href="{{url('/oficial/a_garantes/detalle_conyugue')}}" class="btn btn-default"> cancelar</a>
       <button class="btn btn-danger" type="reset">Restablecer</button>
     </div>
   </div>
 </div>
</form>
@push ('scripts')
<script>
  $('#liGarante').addClass("treeview active");
  $('#liGarante_sub_detalle').addClass("active");
</script>
@endpush
@endsection
