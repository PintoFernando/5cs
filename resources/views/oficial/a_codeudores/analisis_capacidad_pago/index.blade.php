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
   <td>{{$ingreso_promedio_prestatario}}</td>

</tr>

<tr>
   <td>(+) PROMEDIO SUELDO LIQUIDO DEL CONYUGE</td>    
   <td>{{$ingreso_promedio_conyugue}}</td>  

</tr>

<tr>
   <td>(+) PROMEDIO OTROS INGRESOS (RESPALDADOS)</td>    
   <td>{{$ingreso_promedio_otros}}</td>  

</tr>

<tr>
   <td>(+) PROMEDIO  ∑ CODEUDORES</td>    
   <td>{{$ingreso_promedio_codeudores}}</td>   
   
</tr>

<tr>
   <td>(+) VENTAS</td>    
   <td>{{$v_precio_total}}</td>  

</tr>

<tr>
   <td>(-) MATERIA PRIMA O COSTO DE VENTAS</td>    
   <td>{{$c_costo_total}}</td>   
   
</tr>

<tr>
   <td>(-) MANO DE OBRA</td>    
   <td>{{$total_mano_obra}}</td>  
   
</tr>

<tr>
   <td>(-) GASTOS OPERATIVOS</td>    
   <td>{{$total_gastos_operativos}}</td>

</tr>


<tr>
   <td class="table-celda-verde">UTILIDAD OPERATIVA</td>    
   <td>{{$utilidad_operativa}}</td>   

</tr>

<tr>
   <td>TIPO DE CRÉDITO:{{$tipo_credito}} {{$porcentaje_capacidad_pago}}</td>
   <td>{{$calculo}}</td>
</tr>

<tr>
   <td>(-) AMORTIZACIÓN DE CRÉDITO COOPERATIVA SAN MARTIN</td>    
   <td>{{$amortizacion_san_martin}}</td>       
</tr>

@foreach ($inf_prestamos as $pres)
<tr>
   <td>(-) AMORTIZACIÓN DE CRÉDITO {{$pres->nombre_entidad}}</td>    
   <td>{{$pres->importe_ultimo_pago}}</td>     
</tr>
@endforeach

<tr>
   <td>(-) TOTAL CUENTAS POR PAGAR</td>    
   <td>{{$total_cuentas_por_pagar}}</td>   
   
</tr>

<tr>
   <td>(-) TOTAL GASTOS FAMILIARES</td>    
   <td>{{$total_gastos_familiares}}</td>  

</tr>

<tr>
   <td class="table-celda-verde">(-) MARGEN DE AHORRO</td>    
   <td>{{$margen_ahorro}}</td>     
</tr>  




<tr>
   <td class="table-celda-verde">CAPACIDAD DE PAGO:</td>    
   <td>{{$resultado_capacidad}}</td>     
   <td>{{$tiene}}</td>     
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