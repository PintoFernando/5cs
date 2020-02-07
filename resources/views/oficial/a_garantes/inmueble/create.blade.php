@extends ('layouts.admin3')
@section ('contenido')
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <h3>Registrar Inmueble</h3>
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
   <!-- div usuario seleccionado-->
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
<!-- div usuario seleccionado-->

          <form method="post" action="{{url('/oficial/a_garantes/inmueble')}}">
              {{csrf_field()}}
          <div class="row">
            
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label for="ciudad">Ciudad</label>
              <input type="text" name="ciudad" class="form-control" value="{{old('ciudad')}}">
            </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label for="calle">Calle</label>
              <input type="text" name="calle" class="form-control" value="{{old('calle')}}">
            </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label for="numero">Número</label>
              <input type="number" name="numero" min="0" class="form-control" value="{{old('numero')}}" >
            </div>
            </div>

             <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label for="zona">Zona</label>
              <input type="text" name="zona" class="form-control" value="{{old('zona')}}" >
            </div>
            </div>

             <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label for="num_folio_real">Nro de Folio Real</label>
              <input type="number" min="0" name="num_folio_real" class="form-control" value="{{old('num_folio_real')}}" >
            </div>
            </div>

             <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label for="fecha_registro">Fecha de Registro</label>
              <input type="date" name="fecha_registro" class="form-control" value="{{old('fecha_registro')}}" >
            </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label for="en_garantia">En Garantia</label>
              <select name="en_garantia" class="form-control selectpicker" data-size="5" id="en_garantia" data-live-search="true" >
                    <option value="1">Si</option>
                    <option value="0">No</option>
                  </select>
            </div>
            </div>


            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label for="detalle">Detalle</label>
              <input type="text" name="detalle" class="form-control" value="{{old('detalle')}}">
            </div>
            </div>   


             <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label for="valor">Valor</label>
              <input type="number" step="any" min="0" name="valor" class="form-control" value="{{old('valor')}}" required>
            </div>
            </div>        


            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">            
            <div class="form-group">
              <button class="btn btn-primary" type="submit">Guardar</button>
              <a href="{{url('/oficial/a_garantes/inmueble')}}" class="btn btn-danger">Cancelar</a>
            </div>
           </div>
         </div>
    </form>
     @push ('scripts')
<script>
  $('#liGarante').addClass("treeview active");
  $('#liGarante_sub_inmueble').addClass("active");
</script>
@endpush
@endsection
