@extends ('layouts.admin3')
@section ('contenido')
<div class="row">

  <div>
    <h3>Reporte Buro</h3>
  </div>

  <div class="row">
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
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  </div>


  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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

<form method="post" action="{{url('oficial/reporte_buro/')}}">
  {{csrf_field()}}
  <div class="row">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="tiempo_maximo_mora">Tiempo máximo en mora en días</label>
       <input type="number" min="0" name="tiempo_maximo_mora" class="form-control" required>
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
     <div class="form-group" class="form-control">
       <label for="id_buro">Buro Consultado</label>
       <select name="id_buro"  class="form-control selectpicker" data-size="5" id="id_buro" data-live-search="true" required>
         @foreach($buros as $bu)
         <option value="{{$bu->id_buro}}"> {{$bu->nombre_buro}}</option>
         @endforeach
       </select>
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <button class="btn btn-primary" type="submit">Guardar</button>
     <a href="{{url('/oficial/reporte_buro')}}" class="btn btn-danger">Cancelar</a>
   </div>
 </div>

</div>
</form>
@include('sweetalert::alert')
@push ('scripts')
<script>
  $('#liC1').addClass("treeview active");
  $('#liReporteBuro').addClass("active");
</script>
@endpush
@endsection
