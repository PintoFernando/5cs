@extends ('layouts.admin3')
@section ('contenido')

<div class="row">
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
   <h3>Editar Otro Activo:{{$activo->id_otros_activos}}</h3>
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
<form method="post" action="{{url('oficial/otros_activos/'.$activo->id_otros_activos.'/edit')}}">
  {{csrf_field()}}
  <div class="row">  
   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

    <div class="form-group">
     <label for="detalle">Detalle</label>
     <input type="text" name="detalle" class="form-control" value="{{old('detalle',$activo->detalle)}}">
   </div>
 </div>
 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
    <label for="en_garantia">En Garantia</label>
    <select name="en_garantia" class="form-control selectpicker" data-size="5" id="en_garantia" data-live-search="true">
      <option value="1">Si</option>
      <option value="0">No</option>
    </select>
  </div>
</div>
<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

  <div class="form-group">
   <label for="total">Total</label>
   <input type="number" step="any" name="total" class="form-control" value="{{old('total',$activo->total)}}" >
 </div>
</div>


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

  <div class="form-group">
   <button class="btn btn-primary" type="submit">Guardar</button>
   <button class="btn btn-info" type="reset">Restablecer</button>
   <a href="{{url('/oficial/otros_activos')}}" class="btn btn-danger">Cancelar</a>
 </div>
</div>

</form>
</div>
</div>
@push ('scripts')
<script>
  $('#liC2').addClass("treeview active");
  $('#liOtrosActivos').addClass("active");
</script>
@endpush
@endsection
