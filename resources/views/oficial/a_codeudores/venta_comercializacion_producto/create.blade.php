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


<!-- Mensaje -->
<section class="content">
  <div class="callout callout-success">
    <h4>Descargar Plantilla Costo unitario</h4>
  </div>  


  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="plantilla">Descargar formato de plantilla </label>

    </div>
  </div> 

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">     
     <a href="{{url('oficial/a_codeudores/venta_comercializacion_producto/descarga')}}"><button type="button" class="btn btn-primary btn">Descargar</button></a>  
   </div>
 </div> 
</section>

<section class="content">
  <div class="callout callout-success">
    <h4>Descargar Plantilla Análisis Ingresos Servicio de Transporte</h4>
  </div>  

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="plantilla">Descargar formato de plantilla </label>

    </div>
  </div> 

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">     
     <a href="{{url('oficial/a_codeudores/venta_comercializacion_producto/descarga_transporte')}}"><button type="button" class="btn btn-primary btn">Descargar</button></a>  
   </div>
 </div> 
</section>

<section class="content">
  <div class="callout callout-success">
    <h4>Descargar Plantilla Comercialización</h4>
  </div>  

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <label for="plantilla">Descargar formato de plantilla </label>

    </div>
  </div> 

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">     
     <a href="{{url('oficial/a_codeudores/venta_comercializacion_producto/comercio')}}"><button type="button" class="btn btn-primary btn">Descargar</button></a>  
   </div>
 </div> 
</section>

<section class="content">

 <div class="callout callout-success">
    <h4>Cargar datos</h4>
  </div>  

  <form method="post" action="{{url('oficial/a_codeudores/venta_comercializacion_producto/')}}" enctype="multipart/form-data">
    {{csrf_field()}}

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
        <label for="costo_ventas">Seleccione Archivo a subir</label>
        <input type="file" name="costo_ventas" required>
      </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
        <label for="num_rows">Ingrese el numero de filas a cargar:</label>
        <input type="text" name="num_rows" class="form-control" value="{{old('num_rows')}}" placeholder="Ingresar Número de filas de archivo excel" required>
      </div>
    </div>  

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">            
      <div class="form-group">
        <button class="btn btn-primary" type="submit">Gargar</button>
        <a href="{{url('/oficial/a_codeudores/venta_comercializacion_producto')}}" class="btn btn-danger">Cancelar</a>
      </div>
    </div>  
  </form>
</section>



@push ('scripts')
<script>
  $('#liCodeudor').addClass("treeview active");
  $('#liCodeudor_sub_venta_comercializacion').addClass("active");
</script>
@endpush
@include('sweetalert::alert')
@endsection
