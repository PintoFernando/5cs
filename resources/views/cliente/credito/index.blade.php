@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
          <h3>Datos Del Crédito</h3>
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
        <td class="info">Fecha de solicitud:</td>
        <td>{{$credito->fecha_solicitud}}</td>
      </tr>
      <tr>
        <td class="info">MONTO:</td>
        <td>{{$credito->monto_solicitado}}</td>
      </tr>
      <tr>
        <td class="info">PLAZO MESES:</td>
        <td>{{$credito->plazo_meses}}</td>
      </tr>
      <tr>
        <td class="info">DÍA DE PAGO:</td>
        <td>{{$credito->dia_pago}} </td>
      </tr>
      <tr>
        <td class="info">TIPO DE MONEDA<td>
        <td>{{$tipo_moneda}}</td>
      </tr>
      <tr>
        <td class="info">PERIODO DE PAGO:</td>
        <td>{{$credito->id_periodo_pago}} </td>
      </tr>
      <tr>
        <td class="info">TIPO DE CRÉDITO:</td>
        <td>{{$tipo_credito}} </td>
      </tr>
      <tr>
        <td class="info">DESTINO DEL CRÉDITO</td>
        <td>{{$destino}}</td>
      </tr>   
           
    </table>
  </div>
</div>

</div>
@include('sweetalert::alert')
@endsection
