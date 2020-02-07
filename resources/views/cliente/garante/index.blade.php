@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
          <h3>Datos Personales</h3>
     </div>
</div>
@if(session('notification'))
<div class="alert alert-success">
   {{session('notification')}}
</div>
@endif
<div class="row">

     <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
  <div class="table-responsive">
    <table class="table">
      <tr >
        <td class="info">CI:</td>
        <td>{{$garant->ci}}</td>
      </tr>
      <tr>
        <td class="info">NOMBRE:</td>
        <td>{{$garant->nombre}}</td>
      </tr>
      <tr>
        <td class="info">APELLIDO PATERNO:</td>
        <td>{{$garant->ap_paterno}}</td>
      </tr>
      <tr>
        <td class="info">APELLIDO MATERNO:</td>
        <td>{{$garant->ap_materno}} </td>
      </tr>
      <tr>
        <td class="info">APELLIDO CASADA:</td>
        <td>{{$garant->ap_casada}}</td>
      </tr>
      <tr>
        <td class="info">FECHA DE NACIMIENTO:</td>
        <td>{{$garant->fec_nac}} </td>
      </tr>
      <tr>
        <td class="info">GÉNERO:</td>
        <td>{{$garant->genero}} </td>
      </tr>
      <tr>
        <td class="info">CELULAR</td>
        <td>{{$garant->celular}}</td>
      </tr>   
      <tr>
        <td class="info">DEPENDIENTES</td>
        <td>{{$garant->dependientes}}</td>
      </tr>
      <tr>
        <td class="info">ESTADO CIVIL</td>
        <td>{{$garant->estado_civil}} </td>
      </tr>  
      <tr>
        <td class="info">PROFESION</td>
        <td>{{$garant->id_profesion}}</td>
      </tr>      
    </table>
  </div>
</div>

</div>
@include('sweetalert::alert')
@endsection
