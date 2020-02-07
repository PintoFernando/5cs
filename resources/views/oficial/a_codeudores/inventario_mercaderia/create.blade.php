@extends ('layouts.admin3')
@section ('contenido')
<!-- div usuario seleccionado-->
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12" style="float:right;">
    <div class="info-box bg-light-blue">
      <span class="info-box-icon"><i class="fa fa-user text-orange"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Codeudor seleccionado</span>
        <span class="info-box-number"> </span>
        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
          {{Session::get('id_persona_oficial_codeudor','Codeudor no seleccionado')}}
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
    </div>
  </div>
</div>
<!-- div usuario seleccionado-->
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <h3>Registrar Inventario de Mercaderia</h3>
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
          <form method="post" action="{{url('/oficial/a_codeudores/inventario_mercaderia')}}">
              {{csrf_field()}}
            <div class="row">    
                    
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label for="detalle">Detalle</label>
              <input type="text" name="detalle" class="form-control" value="{{old('detalle')}}">
            </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label for="cantidad">Cantidad</label>
              <input type="number" name="cantidad" class="form-control" value="{{old('cantidad')}}">
            </div>
            </div>

             <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label for="unidad_medida">Unidad de medida</label>
              <input type="text" name="unidad_medida" class="form-control" value="{{old('unidad_medida')}}" >
            </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label for="precio_unitario">Precio Unitario</label>
              <input type="number" step="any" name="precio_unitario" min="0" class="form-control" value="{{old('precio_unitario')}}" >
            </div>
            </div>
            
            
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label for="total">Total</label>
              <input type="number" step="any" name="total" min="0" class="form-control" value="{{old('total')}}" required>
            </div>
            </div>
           

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">            
            <div class="form-group">
              <button class="btn btn-primary" type="submit">Guardar</button>
              <a href="{{url('/oficial/a_codeudores/inventario_mercaderia')}}" class="btn btn-danger">Cancelar</a>
            
            </div>
           </div>
           </div>
         
    </form>
 @push ('scripts')
<script>
  $('#liCodeudor').addClass("treeview active");
  $('#liCodeudor_sub_inventario').addClass("active");
</script>
@endpush
@endsection
