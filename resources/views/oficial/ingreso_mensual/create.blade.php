@extends ('layouts.admin3')
@section ('contenido')
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


<!-- Mensaje -->
<section class="content">
  <div class="callout callout-success">
    <h4>Descargar Plantilla</h4>
  </div>  


  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="plantilla">Descargar formato de plantilla</label>

    </div>
  </div> 

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">     
     <a href="{{url('oficial/ingreso_mensual/descarga')}}"><button type="button" class="btn btn-primary btn">Descargar</button></a>  
   </div>
 </div> 
</section>


<section class="content">

 <div class="callout callout-success">
    <h4>Cargar datos</h4>
  </div>  

  <form method="post" action="{{url('oficial/ingreso_mensual/')}}" enctype="multipart/form-data">
    {{csrf_field()}}

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
        <label for="ingreso_mensual">Seleccione Archivo a subir</label>
        <input type="file" name="ingreso_mensual" required="">
      </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">            
      <div class="form-group">
        <button class="btn btn-primary" type="submit">Gargar</button>
        <a href="{{url('/oficial/ingreso_mensual')}}" class="btn btn-default"> cancelar</a>
      </div>
    </div>  
  </form>
</section>
@include('sweetalert::alert')
@push ('scripts')
<script>
  $('#liC3').addClass("treeview active");
  $('#liIngresoMensual').addClass("active");
</script>
@endpush
@endsection
