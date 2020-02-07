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
      <td colspan="2" class="table-celda-naranja">ANÁLISIS DE LA CAPACIDAD DE PAGO</td>       
    </tr>

    <tr>
     <td>(+) PROMEDIO SUELDO LIQUIDO DEL SOLICITANTE</td>    
     <td class="table-celda-derecha">{{number_format($ingreso_promedio_prestatario,2,',', '.')}}</td>

   </tr>

   <tr>
     <td>(+) PROMEDIO SUELDO LIQUIDO DEL CONYUGE</td>    
     <td class="table-celda-derecha">{{number_format($ingreso_promedio_conyugue,2,',', '.')}}</td>  

   </tr>

   <tr>
     <td>(+) PROMEDIO OTROS INGRESOS (RESPALDADOS)</td>    
     <td class="table-celda-derecha">{{number_format($ingreso_promedio_otros,2,',', '.')}}</td>  

   </tr>

   <tr>
     <td>(+) PROMEDIO  ∑ CODEUDORES</td>    
     <td class="table-celda-derecha">{{number_format($ingreso_promedio_codeudores,2,',', '.')}}</td>   

   </tr>

   <tr>
     <td>(+) VENTAS</td>    
     <td class="table-celda-derecha">{{number_format($v_precio_total,2,',', '.')}}</td>  

   </tr>

   <tr>
     <td>(-) MATERIA PRIMA O COSTO DE VENTAS</td>    
     <td class="table-celda-derecha">{{number_format($c_costo_total,2,',', '.')}}</td>   

   </tr>

   <tr>
     <td>(-) MANO DE OBRA</td>    
     <td class="table-celda-derecha">{{number_format($total_mano_obra,2,',', '.')}}</td>  

   </tr>

   <tr>
     <td>(-) GASTOS OPERATIVOS</td>    
     <td class="table-celda-derecha">{{number_format($total_gastos_operativos,2,',', '.')}}</td>

   </tr>


   <tr>
     <td class="table-celda-verde">UTILIDAD OPERATIVA</td>    
     <td class="table-celda-derecha">{{number_format($utilidad_operativa,2,',', '.')}}</td>   

   </tr>

   <tr>
     <td>TIPO DE CRÉDITO:{{$tipo_credito}} {{$porcentaje_capacidad_pago}}</td>
     <td class="table-celda-derecha">{{number_format($calculo,2,',', '.')}}</td>
   </tr>

   <tr>
     <td>(-) AMORTIZACIÓN DE CRÉDITO COOPERATIVA SAN MARTIN</td>    
     <td class="table-celda-derecha">{{number_format($amortizacion_san_martin,2,',', '.')}}</td>       
   </tr>

   @foreach ($inf_prestamos as $pres)
   <tr>
     <td>(-) AMORTIZACIÓN DE CRÉDITO {{$pres->nombre_entidad}}</td>    
     <td class="table-celda-derecha">{{number_format($pres->importe_ultimo_pago,2,',', '.')}}</td>     
   </tr>
   @endforeach

   <tr>
     <td>(-) TOTAL CUENTAS POR PAGAR</td>    
     <td class="table-celda-derecha">{{number_format($total_cuentas_por_pagar,2,',', '.')}}</td>   

   </tr>

   <tr>
     <td>(-) TOTAL GASTOS FAMILIARES</td>    
     <td class="table-celda-derecha">{{number_format($total_gastos_familiares,2,',', '.')}}</td>  

   </tr>

   <tr>
     <td class="table-celda-verde">(-) MARGEN DE AHORRO</td>    
     <td class="table-celda-derecha" @if($margen_ahorro>0) bgcolor="lime" @else bgcolor="red" @endif>{{number_format($margen_ahorro,2,',', '.')}}</td>     
   </tr>  

   <tr>
     <td class="table-celda-verde">CAPACIDAD DE PAGO:</td>    
     <td>{{$resultado_capacidad}}</td>     
     <td @if($tiene>0) bgcolor="lime" @else bgcolor="red" @endif>{{number_format($tiene,2,',', '.')}}</td>
   </tr> 
 </table>
</div>

@push ('scripts')
<script>
  $('#liInformacion').addClass("treeview active");
  $('#liCapacidadPago').addClass("active");
</script>
@endpush
@endsection