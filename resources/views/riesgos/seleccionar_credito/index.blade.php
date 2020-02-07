@extends ('layouts.admin3')
@section ('contenido')
<div class="box">
  <div class="box-header">
     <h4>Lista de Créditos   
  </h4>
  </div>
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
          <td> <a href="{{url('/riesgos/seleccionar_credito/'.$cre->id_persona.'/'.$cre->id_credito.'/seleccionar_credito')}}" rel="tooltip" title="Seleccionar crédito" class="btn btn-success btn-simple btn-xs">
                        <i class="fa fa-gear"></i> 
                        </a></td>
        </tr>
        @endforeach
      </tbody>                
    </table>
 </div>
 <!-- /.box-body -->
</div>
@endsection


