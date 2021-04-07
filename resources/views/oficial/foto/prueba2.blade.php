
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
<form >
<div class="box-header" >
<h3> Crédito de Seguimiento: {{$idfoto}} </h3>
   <div class="form-group">   
    <label>Crear PDF</label>
 <div style="width: 30%"> 
 <select  name="id_opcion_croquis_pdf" class="form-control selectpicker" data-size="5" id="id_opcion_croquis_pdf" data-live-search="true" ></div>
 <option value="100" >---Seleccione Una Carpeta de Fotos---</option>
       @foreach ($seguimientofoto as $ca) 
       <option value="{{$ca->id_seguimiento_foto}}">{{$ca->descripcion}}</option>
       @endforeach
     </select> <br></br>
     <div> <textarea name ="titulo" rows="4"  cols="50">Escriba el Titulo del Reporte</textarea></div>
     
     <div align="right"> 
     <input type="submit" class="btn btn-primary"  value="Crear Reporte" >
     <input type="submit" class="btn btn-primary"  value="Buscar" > 
     
     
     </div>
       
</div>
</div></div>
  </div>
 
@if(session('notification'))
<div class="alert alert-success">
   {{session('notification')}}
</div>
@endif

<!-- /.box-header -->
<div class="box-body">


  <table id="o_garante" class="table table-bordered table-striped" >
    <div id="div1">
    <thead>
      <tr>
      <th>Nº</th>
       <th>Fecha</th>
       
       <th>Foto</th>
       <th>Descripcion</th>
       <th>Acciones</th>               
     </tr>
   </thead>
   <tbody>
  @foreach ($fotos as $fo)
    <tr> 
       <td>{{$loop->iteration}}</td>   
      <td>{{$fo->created_at}}</td>
      
      <td>
						<img src="{{asset('images/fotos/'.$fo->archivo)}}" alt="{{ $fo->archivo}}" height="75px" width="75px" class="img-thumbnail">
            <input type="checkbox" name="id_foto[]" value="{{$fo->id_foto}}" id="2"></br>
			</td>
      </form>
      <td>   {{$fo->detalle}}  </td> 
      
      <td> 
      
      <a href="{{url('/oficial/foto/'.$fo->id_foto.'/descarga')}}" rel="tooltip" title="Descargar fotografía" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-download"></i> 
      </a>
    </td>
  </tr>
  @include('oficial.foto.modal')
  
  @endforeach
</tbody> 
</div>               
</table>
</div>
<!-- /.box-body -->

@include('sweetalert::alert')
@push ('scripts')
<script>
  $('#liArchivos').addClass("treeview active");
  $('#liFotos').addClass("active");
</script>
@endpush
@endsection


