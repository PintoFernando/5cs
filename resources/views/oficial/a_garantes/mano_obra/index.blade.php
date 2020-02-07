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

<div class="box-header">
 <h3>Mano de obra
  <a href="{{url('/oficial/a_garantes/mano_obra/create')}}" class="btn btn-success pull-right" 
  style="margin-top: -8px;">Añadir Mano de Obra</a>
</h3>
</div>

@if(session('notification'))
<div class="alert alert-success">
 {{session('notification')}}
</div>
@endif

<!-- /.box-header -->
<div class="box-body">
  <table id="o_mano_obra" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Id</th>
       <th>Descripción</th>
       <th>N° de Personas</th>
       <th>Sueldo Mensual</th>               
       <th>Total</th>               
     </tr>
   </thead>
   <tbody>
    @foreach ($mano as $ma)
    <tr>
      <td>{{$ma->id_mano_obra}}</td>
      <td>{{$ma->descripcion_cargo}}</td>
      <td>{{$ma->num_personas}}</td>
      <td>{{$ma->sueldo_mensual}}</td> 
      <td>{{$ma->total_mano_obra}}</td> 

      <td> <a href="{{url('/oficial/a_garantes/mano_obra/'.$ma->id_mano_obra.'/edit')}}" 
        rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-edit"></i> 
      </a>


    </td>
  </tr>
  @endforeach
</tbody>                
</table>

<table class="table table-condensed">
  <tr>
    <td class="table-celda-naranja">TOTAL MANO DE OBRA:</td>
    <td>{{$total_mano_obra}}</td>
  </tr>
</table>

<!--  Suma del total-->
</div>
<!-- /.box-body -->

@include('sweetalert::alert')
@push ('scripts')
<script>
  $('#liGarante').addClass("treeview active");
  $('#liGarante_sub_mano_obra').addClass("active");
</script>
@endpush
@endsection