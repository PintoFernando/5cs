@extends ('layouts.admin3')
@section ('contenido')
<div class="box">
  <div class="box-header">
   <h4>Lista de personas   
   </h4>
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
        <th>Id</th>
        <th>Nombre</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>CI</th>
        <th>Número de socio</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($personas as $pe)
      <tr>
        <td>{{$pe->id_persona}}</td>
        <td>{{$pe->nombre}}</td>
        <td>{{$pe->ap_paterno}}</td>
        <td>{{$pe->ap_materno}}</td>
        <td>{{$pe->ci}}</td>
        <td>{{$pe->num_socio}}</td>
        <td> <a href="{{url('/oficial/a_codeudores/asignar_codeudor/'.$pe->id_persona.'/asignar')}}" rel="tooltip" title="Asignar Codeodor" class="btn btn-success btn-simple btn-xs">
          <i class="glyphicon glyphicon-ok"></i> 
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
  $('#liCodeudor').addClass("treeview active");
  $('#liCodeudor_sub_bienes').addClass("active");
</script>
@endpush
@endsection


