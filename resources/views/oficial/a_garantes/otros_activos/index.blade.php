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
 <h3>Otros Activos
  <a href="{{url('/oficial/a_garantes/otros_activos/create')}}" 
  class="btn btn-success pull-right" 
  style="margin-top: -8px;">Añadir Otros Activos</a>
</h3>
</div>


@if(session('notification'))
<div class="alert alert-success">
   {{session('notification')}}
</div>
@endif

<!-- /.box-header -->
<div class="box-body">
  <table id="o_persona" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Id</th>
       <th>Detalle</th>
       <th>En Garantia</th>
       <th>Total</th>
       <th>Acción</th>   
     </tr>            
   </thead>
   <tbody>
     @foreach ($activo as $ac)
     <tr>
       <td>{{$ac->id_otros_activos}} </td>
       <td>{{$ac->detalle}} </td>
       <td>@if($ac->en_garantia==1)
        Si
        @else
        No
        @endif
      </td>
      <td>{{$ac->total}} </td>
      <td>
       <a href="{{url('/oficial/a_garantes/otros_activos/'.$ac->id_otros_activos.'/edit')}}" rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
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
  $('#liGarante').addClass("treeview active");
  $('#liGarante_sub_otros_activos').addClass("active");
</script>
@endpush

@endsection