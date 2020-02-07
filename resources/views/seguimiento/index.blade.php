@extends ('layouts.admin3')
@section ('contenido')
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Listado de Créditos</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="seg_credito_color" class="table">
      <thead>
        <tr >
          <th>ID crédito</th>
          <th>ID persona</th>
          <th>Nombre</th>
          <th>Apellido Paterno</th>
          <th>Apellido Materno</th>
          <th>Ci</th>
          <th>Monto</th>
          <th>Tiempo</th>
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

          <td><button  class="@if((\Carbon\Carbon::parse($cre->created_at))->diffInDays(\Carbon\Carbon::parse(\Carbon\Carbon::now()))>limites($cre->id_tcredito)) btn btn-danger btn-xs  @else  btn btn-success btn-xs @endif" aria-hidden="true">@if((\Carbon\Carbon::parse($cre->created_at))->diffInDays(\Carbon\Carbon::parse(\Carbon\Carbon::now()))>limites($cre->id_tcredito)) Excedido  @else  Vigente @endif</button></td>

          <td> <a href="{{url('/seguimiento/'.$cre->id_persona.'/'.$cre->id_credito.'/seguimiento')}}" rel="tooltip" title="Seguimiento de socio" class="btn btn-success btn-simple btn-xs">
                        <i class="fa fa-gear"></i>
                        </a>

                        <a href="{{url('/seguimiento/'.$cre->id_persona.'/'.$cre->id_credito.'/documentos')}}" rel="tooltip" title="Documentos llenados" class="btn btn-success btn-simple btn-xs">
                        <i class="fa fa-file"></i>
                        </a>

                        </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>

<?php
function limites($a)
{
    switch ($a) {
        case 1: //CONSUMO CON OTRAS GARANTIAS
            return 6;
            break;
        case 2: //CONSUMO A SOLA FIRMA
            return 3;
            break;
        case 3: //CONSUMO CON 2 GARANTES PERSONALES
            return 3;
            break;
        case 4: //CONSUMO CON 1 GARANTE PERSONAL
            return 3;
            break;
        case 5: //CONSUMO DEBIDAMENTE GARANTIZADO
            return 6;
            break;
        case 6: //MICROCREDITO DEBIDAMENTE GARANTIZADO
            return 6;
            break;
        case 7: //MICROCREDITO CON OTRAS GARANTIAS
            return 6;
            break;
        case 8: //MICROCREDITO A SOLA FIRMA
            return 3;
            break;
        case 9: //MICROCREDITO CON 1 GARANTE PERSONAL
            return 3;
            break;
        case 10: //MICROCREDITO CON 2 GARANTES PERSONALES
            return 3;
            break;
        case 11: //HIPOTECARIO DE VIVIENDA
            return 6;
            break;
        case 12: //VIVIENDA SIN GARANTIA A SOLA FIRMA
            return 3;
            break;
        case 13: //VIVIENDA SIN GARANTIA HIPOTECARIA
            return 3;
            break;
        case 14: //VIVIENDA CON DOCUMENTOS EN CUSTODIA
            return 3;
            break;

    }
}
?>

@push ('scripts')
<script>
  $('#aLi_seguimiento').addClass("treeview active");
  $('#aLi_seguimiento_sub').addClass("active");
</script>
@endpush
@endsection
