@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
          <h3>Datos Del Conyugue</h3>
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
        <td>{{$conyu[0]->ci}}</td>
      </tr>
      <tr>
        <td class="info">NOMBRE:</td>
        <td>{{$conyu[0]->nombre}}</td>
      </tr>
      <tr>
        <td class="info">APELLIDO PATERNO:</td>
        <td>{{$conyu[0]->ap_paterno}}</td>
      </tr>
      <tr>
        <td class="info">APELLIDO MATERNO:</td>
        <td>{{$conyu[0]->ap_materno}} </td>
      </tr>
      <tr>
        <td class="info">APELLIDO CASADA:</td>
        <td>{{$conyu[0]->ap_casada}}</td>
      </tr>
      <tr>
        <td class="info">FECHA DE NACIMIENTO:</td>
        <td>{{$conyu[0]->fec_nac}} </td>
      </tr>
      <tr>
        <td class="info">GÉNERO:</td>
        <td>{{$conyu[0]->genero}} </td>
      </tr>
      <tr>
        <td class="info">CELULAR</td>
        <td>{{$conyu[0]->celular}}</td>
      </tr>   
      <tr>
        <td class="info">DEPENDIENTES</td>
        <td>{{$conyu[0]->dependientes}}</td>
      </tr>
      <tr>
        <td class="info">ESTADO CIVIL</td>
        <td>{{$conyu[0]->estado_civil}} </td>
      </tr>  
      <tr>
        <td class="info">PROFESIÓN</td>
        <td>{{$conyu[0]->profesion}}</td>
      </tr>      
    </table>
  </div>
</div>

</div>
@include('sweetalert::alert')
@endsection
