@extends ('layouts.admin3')
@section ('contenido')
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


<div class="row">
<div class="box-header">
 <h3>Listado de Croquis de Garante
  <a href="{{url('/oficial/a_garantes/croquis/create')}}" 
  class="btn btn-success pull-right" 
  style="margin-top: -8px;">Añadir Croquis</a>
</h3>
</div>
</div>

<!-- /.box-header -->
<div class="box-body">
  <table id="o_credito" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Id</th>
       <th>Latitud</th>
       <th>Longitud</th>
       <th>Categoria</th>   
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
       <a href="{{url('/oficial/a_garantes/croquis/'.$cro->id_croquis.'/edit')}}" rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-pencil"></i> 
      </a>   

      <a href="{{url('/oficial/a_garantes/croquis/'.$cro->id_croquis.'/see')}}" rel="tooltip" title="Ver Croquis" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-eye "></i> 
      </a> 

    </td>
  </tr>
  @endforeach
</tbody>                
</table>
<!--  Suma del total-->
</div>

<!-- /.box-body -->
@include('sweetalert::alert')
@push ('scripts')
<script>
  $('#liGarante').addClass("treeview active");
  $('#liGarante_sub_croquis').addClass("active");
</script>
@endpush
@endsection