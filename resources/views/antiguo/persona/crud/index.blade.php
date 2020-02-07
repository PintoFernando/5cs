@extends ('layouts.admin3')
@section ('contenido')
<div class="box">
  <div class="box-header">
     <h4>Lista de personas
    <a onclick="addForm()" class="btn btn-success pull-right" style="margin-top: -8px;">Añadir persona</a>
  </h4>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="admin_tpersona" class="table table-bordered table-hover">
      <thead>
        <tr>
         <th>Id</th>
         <th>ci</th>
         <th>Nombre</th>
         <th>Ap. paterno</th>
         <th>Ap. materno</th>
         <th>Ap. casada</th>
         <th>Fecha nac</th>
         <th>Genero</th>
         <th>Celular</th>
         <th>Dependientes</th>
         <th>Estado civil</th>
         <th>Profesión</th>
         <th>Accion</th>
       </tr>
     </thead>
     <tbody>

     </tbody>

   </table>
 </div>
 <!-- /.box-body -->
</div>
@include('persona.crud.create')
@endsection


