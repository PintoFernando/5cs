@extends ('layouts.admin3')
@section ('contenido')
<div class="box-header" >
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


@if(session('notification'))
<div class="alert alert-success">
   {{session('notification')}}
</div>
@endif


<form>
<!-- /.box-header -->
<div class="container">
<div style="width: 90%"> 
  <div class="row">
  <div class="panel panel-default">
   <div class="panel-heading"><h4> Seleccione El Tipo de Fotografia que subira</h4></div>
     <div class="panel-body">
 
     <div class="col col-md-2 col-sm-3 col-xs-12">
     <div style="width: 110%">
     <select  name="id_opcion_fotografia" class="form-control selectpicker" data-size="5" id="id_categoria_foto" data-live-search="true" ></div>
     <option value="10" >--------Seleccione-------- </option>
     <option value="1" >Fotografia Croquis</option>
     <option value="2"  >Fotografia Reportes  </option>
     </select></div></div>
     <div class="col col-md-2 col-sm-3 col-xs-12">
     <input type="submit" class="btn btn-primary"  value="aceptar" >   
     </div>
         </div></div></div> 
   </div> 
   
<!-- /.box-header -->

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


