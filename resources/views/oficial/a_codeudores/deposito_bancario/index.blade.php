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
 <h3>Deposito Bancario
  <a href="{{url('/oficial/a_codeudores/deposito_bancario/create')}}" 
  class="btn btn-success pull-right" 
  style="margin-top: -8px;">Añadir </a>
</h3>
</div>

@if(session('notification'))
<div class="alert alert-success">
 {{session('notification')}}
</div>
@endif
<!-- /.box-header -->
<div class="box-body">
  <table id="o_credito" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Id</th>
       <th>Número de Cuenta</th>
       <th>Saldo</th>
       <th>Nombre Entidad</th>              
       <th>Nombre Deposito</th>               
     </tr>
   </thead>
   <tbody>
    @foreach ($deposito as $de)
    <tr>
      <td>{{$de->id_dbancario}}</td>
      <td>{{$de->numero_cuenta}}</td>
      <td>{{$de->saldo}}</td>
      <td>{{$de->nombre_entidad}}</td>
      <td>{{$de->nombre_deposito}}</td>
      
      <td> <a href="{{url('/oficial/a_codeudores/deposito_bancario/'.$de->id_dbancario.'/edit')}}" rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
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
$('#liCodeudor').addClass("treeview active");
$('#liCodeudor_sub_inversion').addClass("active");
</script>
@endpush
@endsection