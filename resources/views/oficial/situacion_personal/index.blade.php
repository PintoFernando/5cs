@extends ('layouts.admin3')
@section ('contenido')
<!-- div usuario seleccionado-->
<div class="col-md-3 col-sm-6 col-xs-12" style="float:right;">
    <div class="info-box bg-green">
      <span class="info-box-icon"><i class="fa fa-user"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">U. Seleccionado</span>
        <span class="info-box-number"> </span>
        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
          {{Session::get('id_persona_oficial','Usuario no seleccionado')}}
        </span>
      </div>
    </div>
  </div>
<!-- div usuario seleccionado-->

<div class="box-body no-padding">
  <table class="table table-condensed table-bordered" >
    <tr>
      <td colspan="2" class="table-celda-naranja">Activos</td>
      <td colspan="2" class="table-celda-naranja">Pasivos</td>            
    </tr>

    <tr>
      <td>EFECTIVOS EN CAJA</td>
      <td class="table-celda-derecha">{{number_format($total_efectivos_caja,2,',', '.')}}</td>    
      <td></td>
      <td></td>      
    </tr>

    <tr>
      <td>DEP. BANCARIOS</td>
      <td class="table-celda-derecha">{{number_format($total_depositos_bancarios,2,',', '.')}}</td>
      <td>PRESTAMOS BANCARIOS</td>
      <td class="table-celda-derecha">{{number_format($total_prestamos_bancarios,2,',', '.')}}</td>      
    </tr>

    <tr>
      <td>CUENTAS POR COBRAR</td>
      <td class="table-celda-derecha">{{number_format($total_cuentas_cobrar,2,',', '.')}}</td>
      <td>CUENTAS POR PAGAR</td>
      <td class="table-celda-derecha">{{number_format($total_cuentas_por_pagar,2,',', '.')}}</td>        
    </tr>

    <tr> 
      <td>INVERSIONES</td>
      <td class="table-celda-derecha">{{number_format($total_inversiones,2,',', '.')}}</td>
      <td class="table-celda-verde">TOTAL PASIVO</td>
      <td class="table-celda-derecha">{{number_format($total_pasivos,2,',', '.')}}</td>       
    </tr>

    <tr> 
      <td>MAQUINARIA</td>
      <td class="table-celda-derecha">{{number_format($total_maquinaria,2,',', '.')}}</td>
      <td class="table-celda-verde"> PATRIMONIO</td>
      <td class="table-celda-derecha"> {{number_format($patrimonio,2,',', '.')}}</td>
    </tr>

    <tr> 
      <td>MERCADERA O INVENTARIOS</td>
      <td class="table-celda-derecha">{{number_format($total_mercaderia_inventarios,2,',', '.')}}</td>
      <td></td>
      <td></td>
    </tr>

    <tr> 
      <td>PROPIEDADES</td>
      <td class="table-celda-derecha">{{number_format($total_propiedades,2,',', '.')}}</td>
      <td></td>
      <td></td>
    </tr>


    <tr> 
      <td>VEHICULO</td>
      <td class="table-celda-derecha">{{number_format($total_vehiculos,2,',', '.')}}</td>
      <td></td>
      <td></td>
    </tr>


    <tr> 
      <td>OTROS ACTIVOS S/INVENTARIO+BIENES HOGAR</td>
      <td class="table-celda-derecha">{{number_format($total_otros_activos,2,',', '.')}}</td>
      <td></td>
      <td></td>
    </tr>



    <tr> 
      <td class="table-celda-verde">TOTAL ACTIVO</td>
      <td class="table-celda-derecha">{{number_format($total_activos,2,',', '.')}}</td>
      <td class="table-celda-verde">TOTAL PASIVO + PATRIMONIO</td>
      <td class="table-celda-derecha">{{number_format($total_pasivo_patrimonio,2,',', '.')}}</td>      
    </tr>

    
  </table>
</div>
@push ('scripts')
<script>
  $('#liInformacion').addClass("treeview active");
  $('#liSituacionPersonal').addClass("active");
</script>
@endpush

@endsection