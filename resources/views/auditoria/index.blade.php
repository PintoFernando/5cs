@extends ('layouts.admin3')
@section ('contenido')
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Ultimas acciones en el sistema</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="auditoria" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Id</th>
          <th>Tabla</th>
          <th>Acción</th>
          <th>Datos antiguos</th>
          <th>Datos nuevos</th>
          <th>fecha de modificación</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($auditorias as $au)
        <tr>
          <td>{{$au->id}}</td>
          <td>{{$au->tabla}}</td>
          <td>{{$au->accion}}</td>
          <td>{{$au->datosantiguos}}</td>
          <td>{{$au->datosnuevos}}</td>
          <td>{{$au->fechamodificacion}}</td>
         
        </tr>
        @endforeach
      </tbody>                
    </table>
  </div>
  <!-- /.box-body -->
</div>

@endsection