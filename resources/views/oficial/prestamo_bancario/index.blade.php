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
 <h3>Prestamos Bancarios
  <a href="{{url('/oficial/prestamo_bancario/create')}}" 
  class="btn btn-success pull-right" 
  style="margin-top: -8px;">Añadir Prestamo</a>
</h3>
</div>

@if(session('notification'))
<div class="alert alert-success">
 {{session('notification')}}
</div>
@endif

<!-- /.box-header -->
<div class="box-body">
  <table id="o_prestamo_bancario" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Id</th>
       <th>Importe Original</th>             
       <th>Duracion Crédito</th>             
       <th>Importe Último Crédito</th>              
       <th>Destino Crédito</th>              
       <th>Saldo</th>          
       <th>Entidad Bancaria</th>         
       <th>Tipo Credito</th>         
       <th>Acciones</th>          
     </tr>
   </thead>
   <tbody>
    @foreach ($prestamo as $pre)
    <tr>
      <td>{{$pre->id_pbancario}}</td>
      <td>{{$pre->importe_original}}</td>
      <td>{{$pre->duracion_credito}}</td>
      <td>{{$pre->importe_ultimo_pago}}</td>
      <td>{{$pre->destino_credito}}</td>
      <td>{{$pre->saldo}}</td>
      <td>{{$pre->nombre_entidad}}</td>
      <td>{{$pre->tipo_credito}}</td>

      <td> <a href="{{url('/oficial/prestamo_bancario/'.$pre->id_pbancario.'/edit')}}" rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-pencil"></i> 
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
  $('#liC3').addClass("treeview active");
  $('#liPrestamoBancario').addClass("active");
</script>
@endpush
@endsection