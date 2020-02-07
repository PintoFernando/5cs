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
  
<div class="box-header">
 <h3>Maquinaria y Equipo
  <a href="{{url('/oficial/maquinaria_equipo/create')}}" 
  class="btn btn-success pull-right" 
  style="margin-top: -8px;">Añadir Maquinaria y Equipo</a>
</h3>
</div>


@if(session('notification'))
<div class="alert alert-success">
   {{session('notification')}}
</div>
@endif

<!-- /.box-header -->
<div class="box-body">
  <table id="o_maquinaria" class="table table-bordered table-striped">
    <thead>
    <tr>
               <th>Id</th>
               <th>Descripcion</th>
               <th>Marca</th>
               <th>Modelo</th>
               <th>Año</th>
               <th>Asegurado</th>
               <th>Aseguradora</th>
               <th>Entidad Aseguradora</th>
               <th>Total</th>
               <th>Acción</th>   
               </tr>            
                    </thead>
                    <tbody>
               @foreach ($maquinaria as $ma)
                <tr>
               <td>{{$ma->id_maquinaria_equi}} </td>
               <td>{{$ma->descripcion}} </td>
               <td>{{$ma->marca}} </td>
               <td>{{$ma->modelo}} </td>
               <td>{{$ma->anio}} </td>
               <td>{{$ma->asegurado}} </td>
               <td>{{$ma->aseguradora}} </td>
               <td>{{$ma->entidad_acreedora}} </td>
               <td>{{$ma->total}} </td>
               <td>
                     <a href="{{url('/oficial/maquinaria_equipo/'.$ma->id_maquinaria_equi.'/edit')}}" rel="tooltip" title="Editar Maquinaria Equipo" class="btn btn-success btn-simple btn-xs">
                        <i class="fa fa-edit"></i> 
                        </a>
 
               </td>
                    </tr>
                   
                    @endforeach
                    </tbody>
               </table>
          </div>
          
 
@include('sweetalert::alert')
 @push ('scripts')
<script>
  $('#liC2').addClass("treeview active");
  $('#liMaquinariaEquipo').addClass("active");
</script>
@endpush
@endsection