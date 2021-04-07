@extends ('layouts.admin3')
@section ('contenido')
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

<div class="box-header" >

<h3> Crédito de Seguimiento: {{$idfoto}} </h3>

<div class="panel panel-default">
   <div class="panel-heading"><h4>Seccion Registro App Movil</h4></div>
     <div class="panel-body">   
       <a  href="{{url('/oficial/foto/register')}} " class="btn btn-success pull-middle" 
          style="margin-top: -8px;">Registrar </a>
          <a  href="{{url('/oficial/foto/listaregister')}} " class="btn btn-success pull-middle" 
          style="margin-top: -8px;">Listar Registros </a>
     </div>
  </div>


  <div class="panel panel-default">
   <div class="panel-heading"><h4>Seccion Fotografias</h4></div>
     <div class="panel-body">   
       <a href="{{url('/oficial/foto/fotodetalle')}} "  class="btn btn-success pull-middle" 
          style="margin-top: -8px;">Agregar Nuevas Fotografías </a>

       <a href="{{url('/oficial/foto/intento')}} " class="btn btn-success pull-middle" 
          style="margin-top: -8px;">Listar Fotografias </a>
     </div>
  </div>

@if(session('notification'))
<div class="alert alert-success">
   {{session('notification')}}
</div>
@endif

<form method=""  enctype="multipart/form-data">

<!-- /.box-header -->
<div class="container">
<div style="width: 92%"> 
  <div class="row">
<div class="panel panel-default">
   <div class="panel-heading"><h4>Seccion Reportes</h4></div>
     <div class="panel-body">
     <div class="col col-md-2 col-sm-3 col-xs-12">
      <div style="width: 110%"> 
       <select  name="id_opcion_pdf" class="form-control selectpicker" data-size="5" id="id_categoria_foto" data-live-search="true" >
        <option value="10" >--------Seleccione------- </option>
        <option value="1" > Reporte PDF </option>
        <option value="2"  >Croquis PDF</option>
        <option value="3"> Antes y Despues PDF </option>
       </select> 
     </div> 
     </div>
     <div class="col col-md-8 col-sm-3 col-xs-12">
     <input type="submit" class="btn btn-primary"  value="Ingresar" > </div>
  </div>
  </div>  
  </div></div> 
</form>
<!-- /.box-body -->
@include('sweetalert::alert')
@push ('scripts')
<script>
  $('#liArchivos').addClass("treeview active");
  $('#liFotos').addClass("active");
</script>
@endpush
@endsection


