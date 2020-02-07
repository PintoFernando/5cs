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
      <td>{{$total_efectivos_caja}}</td>    
      <td></td>
      <td></td>      
    </tr>

    <tr>
      <td>DEP. BANCARIOS</td>
      <td>{{$total_depositos_bancarios}}</td>
      <td>PRESTAMOS BANCARIOS</td>
      <td>{{$total_prestamos_bancarios}}</td>      
    </tr>

    <tr>
      <td>CUENTAS POR COBRAR</td>
      <td>{{$total_cuentas_cobrar}}</td>
      <td>CUENTAS POR PAGAR</td>
      <td>{{$total_cuentas_por_pagar}}</td>        
    </tr>

    <tr> 
      <td>INVERSIONES</td>
      <td>{{$total_inversiones}}</td>
      <td class="table-celda-verde">TOTAL PASIVO</td>
      <td>{{$total_pasivos}}</td>       
    </tr>

    <tr> 
      <td>MAQUINARIA</td>
      <td>{{$total_maquinaria}}</td>
      <td class="table-celda-verde"> PATRIMONIO</td>
      <td> {{$patrimonio}}</td>
    </tr>

    <tr> 
      <td>MERCADERA O INVENTARIOS</td>
      <td>{{$total_mercaderia_inventarios}}</td>
      <td></td>
      <td></td>
    </tr>

    <tr> 
      <td>PROPIEDADES</td>
      <td>{{$total_propiedades}}</td>
      <td></td>
      <td></td>
    </tr>


    <tr> 
      <td>VEHICULO</td>
      <td>{{$total_vehiculos}}</td>
      <td></td>
      <td></td>
    </tr>


    <tr> 
      <td>OTROS ACTIVOS S/INVENTARIO+BIENES HOGAR</td>
      <td>{{$total_otros_activos}}</td>
      <td></td>
      <td></td>
    </tr>



    <tr> 
      <td class="table-celda-verde">TOTAL ACTIVO</td>
      <td>{{$total_activos}}</td>
      <td class="table-celda-verde">TOTAL PASIVO + PATRIMONIO</td>
      <td>{{$total_pasivo_patrimonio}}</td>      
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