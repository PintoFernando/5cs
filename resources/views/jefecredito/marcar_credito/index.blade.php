@extends ('layouts.admin3')
@section ('contenido')

<div class="box">
  <div class="box-header">
    <h3>Lista de Créditos   
    </h3>
 </div>


@if(session('notification'))
<div class="alert alert-success">
   {{session('notification')}}
</div>
@endif

 <!-- /.box-header -->
 <div class="box-body">
  <table id="scor-socio" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Id Crédito</th>
        <th>Id Persona</th>
        <th>Nombre</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>CI</th>
        <th>Monto</th>
        <th>Desembolsado</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($creditos as $cre)
      <tr>
        <td>{{$cre->id_credito}}</td>
        <td>{{$cre->id_persona}}</td>
        <td>{{$cre->nombre}}</td>
        <td>{{$cre->ap_paterno}}</td>
        <td>{{$cre->ap_materno}}</td>
        <td>{{$cre->ci}}</td>
        <td>{{$cre->monto_solicitado}}</td>
        <td>
         @if($cre->desembolsado) SI
         @else
         NO
         @endif
       </td>
       <td> <a href="{{url('/jefecredito/marcar_credito/'.$cre->id_credito.'/edit')}}" rel="tooltip" title="Marcar crédito como desembolsado" class="btn btn-success btn-simple btn-xs">
        <i class="fa fa-check text-white"></i> 
      </a></td>
    </tr>
    @endforeach
  </tbody>                
</table>
</div>
<!-- /.box-body -->
</div>
@include('sweetalert::alert')
@push ('scripts')
<script>
  $('#liJefe_marcar').addClass("active");
</script>
@endpush
@endsection
