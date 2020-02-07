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
  
<div class="box-header">
 <h3>Inventario de Mercaderia
  <a href="{{url('/oficial/a_codeudores/inventario_mercaderia/create')}}" 
  class="btn btn-success pull-right" 
  style="margin-top: -8px;">Añadir Inventario</a>
</h3>
</div>


@if(session('notification'))
<div class="alert alert-success">
   {{session('notification')}}
</div>
@endif

<div class="box-dody">
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="table-responsive">
               <table id="o_inventario" class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
               <th>Id</th>
               <th>Detalle</th>
               <th>Cantidad</th>
               <th>Unidad Medida</th>
               <th>Precio Unitario</th>
               <th>Total</th>
               <th>Acción</th>
               
                    </thead>
                    <tbody>
               @foreach ($inventario as $in)
                    <tr>
               <td>{{$in->id_imercaderia}} </td>
               <td>{{$in->detalle}} </td>
               <td>{{$in->cantidad}} </td>
               <td>{{$in->unidad_medida}} </td>
               <td>{{$in->precio_unitario}} </td>
               <td>{{$in->total}} </td>
               <td>
                     <a href="{{url('/oficial/a_codeudores/inventario_mercaderia/'.$in->id_imercaderia.'/edit')}}" rel="tooltip" title="Editar Vehiculo" class="btn btn-success btn-simple btn-xs">
                        <i class="fa fa-edit"></i> 
                        </a>
</td>
                    </tr>
                    @endforeach
         </tbody>
               </table>
          </div>
              </div>
</div>
@include('sweetalert::alert')
 @push ('scripts')
<script>
  $('#liCodeudor').addClass("treeview active");
  $('#liCodeudor_sub_inventario').addClass("active");
</script>
@endpush
@endsection