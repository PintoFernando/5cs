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
        <td>{{$persona->ci}}</td>
      </tr>
      <tr>
        <td class="info">NOMBRE:</td>
        <td>{{$persona->nombre}}</td>
      </tr>
      <tr>
        <td class="info">APELLIDO PATERNO:</td>
        <td>{{$persona->ap_paterno}}</td>
      </tr>
      <tr>
        <td class="info">APELLIDO MATERNO:</td>
        <td>{{$persona->ap_materno}} </td>
      </tr>
      <tr>
        <td class="info">APELLIDO CASADA:</td>
        <td>{{$persona->ap_casada}}</td>
      </tr>
      <tr>
        <td class="info">FECHA DE NACIMIENTO:</td>
        <td>{{$persona->fec_nac}} </td>
      </tr>
      <tr>
        <td class="info">LUGAR DE NACIMIENTO:</td>
        <td>{{$persona->lugar_nac}} </td>
      </tr>

      <tr>
        <td class="info">PAÍS DE ORIGEN:</td>
        <td>{{$pais}} </td>
      </tr>


      <tr>
        <td class="info">GÉNERO:</td>
        <td>{{$persona->genero}} </td>
      </tr>
      <tr>
        <td class="info">CELULAR</td>
        <td>{{$persona->celular}}</td>
      </tr>   
      <tr>
        <td class="info">DEPENDIENTES</td>
        <td>{{$persona->dependientes}}</td>
      </tr>
      <tr>
        <td class="info">ESTADO CIVIL</td>
        <td>{{$civil}} </td>
      </tr>  
      <tr>
        <td class="info">PROFESION</td>
        <td>{{$profesion}}</td>
      </tr>      
    </table>
  </div>
</div>

</div>
@include('sweetalert::alert')
@endsection
