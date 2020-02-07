@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>SCORING DE CREDITO 5C´s:</h3>
   @if (count($errors)>0)
   <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
  @endif
</div>
</div>

<div class="row">
 <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
  <div class="table-responsive">
    <table class="table">
      <tr >
        <td class="info">Nombre:</td>
        <td>{{$persona->nombre.' '.$persona->ap_paterno.' '.$persona->ap_materno}}</td>
        <td class="info">Monto:</td>
        <td>{{$credito->monto_solicitado}}</td>
      </tr>

      <tr >
        <td class="info">Ci:</td>
        <td>{{$persona->ci}}</td>

        <td class="info">Plazo:</td>
        <td>{{$credito->plazo_meses}}</td>
      </tr>  

      <tr >
        <td class="info">Fecha de solicitud:</td>
        <td>{{$credito->fecha_solicitud}}</td>

        <td class="info">Tipo de crédito:</td>
        <td>{{$tipo_credito}}</td>
      </tr>  

      <tr >
        <td class="info">Edad:</td>
        <td>{{$edad}}</td>

        <td class="info">cuota:</td>
        <td>{{$credito->cuota}}</td>

      </tr> 

      <tr >
        <td class="info">Número de socio:</td>
        <td>{{$persona->num_socio}}</td>

      </tr>
    </table>
  </div>
</div>

</div>


<!-- c1-->
<div class="box">
            <div class="box-header">
              <h3 class="box-title">C1</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed">
                 <tr>
                   <td colspan="3">C1<td>
                   <td>CARÁCTER<td>
                   <td>PONDERADO<td>
                   <td>PTJ<td>
                 </tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

@endsection
