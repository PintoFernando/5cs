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


@if(session('notification'))
<div class="alert alert-success">
   {{session('notification')}}
</div>
@endif
<form>
<!-- /.box-header -->
<div class="box">
<div class="box-header with-border">
<div class="box-header" >
<h3 class="box-title">Seleccione El Tipo de Locacion</h3>
<table cellspacing="10" cellpadding="10" >
     <tr> 
      <br></br> 

     <td><input type="submit" class="btn btn-primary"  value="aceptar" >   </td>
     </tr>
         
   </table> 
   </div> 
   
<!-- /.box-header -->
<div class="box-body">
  <table id="o_credito" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Id</th>
       <th>Latitud</th>
       <th>Longitud</th>
       <th>Categoría</th>   
       <th>Acción</th>                              
     </tr>
   </thead>
   <tbody>
    @foreach ($croquis as $cro)
    <tr>
      <td>{{$cro->id_croquis}}</td>
      <td>{{$cro->latitud}}</td>
      <td>{{$cro->longitud}}</td>
      <td>{{$cro->categoria}}</td>     
      
      <td>
       <a href="{{url('/oficial/a_codeudores/croquis/'.$cro->id_croquis.'/edit')}}" rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-pencil"></i> 
      </a>   

      <a href="{{url('/oficial/a_codeudores/croquis/'.$cro->id_croquis.'/see')}}" rel="tooltip" title="Ver Croquis" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-eye "></i> 
      </a> 
      <input type="checkbox" name="id_croquis[]" value="{{$cro->id_croquis}}" id="2"></br>

    </td>
  </tr>
  @endforeach
</tbody>                
</table>
<!--  Suma del total-->
</div>
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


