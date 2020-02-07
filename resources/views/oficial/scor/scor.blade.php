@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <CENTER><h4>COOPERATIVA DE AHORRO Y CRÉDITO SOCIETARIA "SAN MARTIN" RL <br>SCORING DE CRÉDITO 5C´s</h4></CENTER>
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

<table class="tabla-cabecera" border="1">
  <tr>
    <td class="table-celda-naranja-izquierda">Nombre:</td>
    <td class="table-celda-centrada">{{$persona->nombre.' '.$persona->ap_paterno.' '.$persona->ap_materno}}</td>
    <td class="table-celda-naranja-izquierda">Monto:</td>
    <td class="table-celda-centrada">{{number_format($credito->monto_solicitado,2,',', '.')}} @if($credito->id_tipo_moneda==2)$us
      @else
      Bs.
      @endif
    </td>
  </tr>

  <tr>
    <td class="table-celda-naranja-izquierda">Ci:</td>
    <td class="table-celda-centrada">{{$persona->ci}}</td>
    <td class="table-celda-naranja-izquierda">Plazo:</td>
    <td class="table-celda-centrada">{{$credito->plazo_meses}}</td>
  </tr>  

  <tr>
    <td class="table-celda-naranja-izquierda">Fecha de solicitud:</td>
    <td class="table-celda-centrada">{{$credito->fecha_solicitud}}</td>
    <td class="table-celda-naranja-izquierda">Tipo de crédito:</td>
    <td class="table-celda-centrada">{{$tipo_credito}}</td>
  </tr>  

  <tr>
    <td class="table-celda-naranja-izquierda">Edad:</td>
    <td class="table-celda-centrada">{{$edad}}</td>
    <td class="table-celda-naranja-izquierda">Cuota:</td>
    <td class="table-celda-centrada">{{number_format($capacidad_pago12->amortizacion_coop_san_martin,2,',', '.')}}</td>
  </tr> 
  <tr>
    <td class="table-celda-naranja-izquierda">Número de socio:</td>
    <td  class="table-celda-centrada">{{$persona->num_socio}}</td>
    <td colspan="2" class="table-celda-centrada"></td>
 
  </tr>      
</table>


<!-- c1-->
<table class="tabla-cabecera">
 <tr class="border-blue">
   <td rowspan="3" class="table-scor border-blue" >C1</td>
   <td rowspan="3" colspan="3" class="table-scor border-blue">CARÁCTER</td>
   <td colspan="2" class="table-scor border-blue">PONDERADO</td>
   <td class="table-scor border-blue">PTJ</td>
 </tr>

 <tr>
  <td class="table-scor border-blue">IDEAL</td>
  <td class="table-scor border-blue">25%</td>                   
  <td class="table-scor border-blue">{{$contador_c1}}</td>                   
</tr>

<tr>
  <td class="table-scor border-blue">SOCIO</td>
  <td class="table-scor border-blue">{{$porcentaje_c1.'%'}}</td>                   
  <td class="table-scor border-blue">{{$total_c1}}</td>                   
</tr>

<tr>
  <td class="border-blue" rowspan="9"></td>
  <td class="celda-roja border-blue" colspan="3">RESIDENCIA</td>                   
  <td class="border-blue"></td>                   
  <td class="border-blue"></td>                   
  <td  class="border-blue table-celda-centrada">{{$total_residencia}}</td>                   
</tr>

<tr>
  <td class="border-blue" colspan="2">Tipo</td>                                    
  <td class="border-blue table-celda-derecha">{{$tipo_vivienda}}</td>                   
  <td class="border-blue table-celda-centrada">{{$ptipo_residencia}}</td>                   
  <td class="border-blue"></td>                   
  <td class="border-blue"></td>                   
</tr>
<tr>
  <td class="border-blue" colspan="2">Tiempo en meses</td> 
  <td class="border-blue table-celda-derecha">{{$tiempo_residencia}}</td>                   
  <td class="border-blue table-celda-centrada">{{$ptiempo_residencia}}</td>                   
  <td class="border-blue"></td>                   
  <td class="border-blue"></td>                   
</tr>

<tr class="border-blue">
  <td class="celda-roja border-blue" colspan="3">TRABAJO</td>                   
  <td class="border-blue"></td>                   
  <td class="border-blue"></td>                   
  <td class="border-blue table-celda-centrada">{{$total_tiempo_negocio}}</td>                   
</tr>

<tr class="border-blue">
  <td class="border-blue">Tiempo en meses</td>                   
  <td class="border-blue">Dependiente</td>                   
  <td class="border-blue table-celda-derecha">{{$tiempo_de_trabajo_empresa}}</td>                   
  <td class="border-blue table-celda-centrada">{{$ptiempo_de_trabajo_empresa}}</td>                   
  <td class="border-blue"></td>                   
  <td class="border-blue"></td>                   
</tr>
<tr class="border-blue">
  <td class="border-blue">Tiempo en meses</td>                   
  <td class="border-blue">Independiente</td>                   
  <td class="border-blue table-celda-derecha">{{$tiempo_de_trabajo}}</td>                   
  <td class="border-blue table-celda-centrada">{{$ptiempo_de_trabajo}}</td>                   
  <td class="border-blue"></td>                   
  <td class="border-blue"></td>                   
</tr>

<tr class="border-blue">
  <td class="celda-roja border-blue" colspan="3">EXPERIENCIA CREDITICIA</td>                   
  <td class="border-blue"></td>                   
  <td class="border-blue"></td>                   
  <td class="border-blue table-celda-centrada">{{$total_experiencia_cre}}</td>                   
</tr>

<tr class="border-blue">
  <td class="border-blue">Último crédito</td>                   
  <td class="border-blue">En días</td>                   
  <td class="border-blue table-celda-derecha">{{$experiencia_cre_dias}}</td>                   
  <td class="border-blue table-celda-centrada">{{$pexperiencia_cre_dias}} </td>                   
  <td class="border-blue"></td>                   
  <td class="border-blue"></td>                   
</tr>

<tr class="border-blue">
  <td class="border-blue">Penúltimo credito</td>                   
  <td class="border-blue">En días</td>                   
  <td class="border-blue table-celda-derecha">{{$penultima_experiencia_cre_dias}}</td>                   
  <td class="border-blue table-celda-centrada">{{$ppenultima_experiencia_cre_dias}}</td>                   
  <td class="border-blue"></td>                   
  <td class="border-blue"></td>                   
</tr>

<!-- c2-->
<tr class="border-blue">
 <td rowspan="3" class="table-scor border-blue">C2</td>
 <td rowspan="3" colspan="3" class="table-scor border-blue">CAPITAL</td>
 <td colspan="2" class="table-scor border-blue">PONDERADO</td>
 <td class="table-scor border-blue">PTJ</td>
</tr>

<tr class="border-blue">
  <td class="table-scor border-blue">IDEAL</td>
  <td class="table-scor border-blue">15%</td>                   
  <td class="table-scor border-blue">{{$contador_c2}}</td>                   
</tr>

<tr class="border-blue">
  <td class="table-scor border-blue">SOCIO</td>
  <td class="table-scor  border-blue">{{$porcentaje_c2}}</td>                   
  <td class="table-scor border-blue0">{{$total_c2}}</td>                   
</tr>

<tr class="border-blue">
  <td class="border-blue" rowspan="2"></td>                   
  <td class="border-blue" colspan="2">Endeudamiento Actual</td>                 
  <td class="border-blue table-celda-derecha">{{$endeudamiento_actual}}%</td>                   
  <td class="border-blue table-celda-centrada">{{$pendeudamiento_actual}}</td> 
  <td class="border-blue"></td>                     
  <td class="border-blue"></td>                   
</tr>

<tr class="border-blue">                 
  <td class="border-blue" colspan="2">Endeudamiento Con Este Crédito</td>                  
  <td class="border-blue table-celda-derecha">{{$endeudamiento_con_este_credito}}%</td>                   
  <td class="border-blue table-celda-centrada">{{$pendeudamiento_con_este_credito}}</td>                   
  <td class="border-blue"></td>                                     
  <td class="border-blue"></td>                                     
</tr>
<!-- C3-->
<tr class="border-blue">
 <td rowspan="3" class="table-scor border-blue">C3</td>
 <td rowspan="3" colspan="3" class="table-scor border-blue">CAPACIDAD</td>
 <td colspan="2" class="table-scor border-blue">PONDERADO</td>
 <td class="table-scor border-blue">PTJ</td>
</tr>

<tr class="border-blue">
  <td class="table-scor border-blue">IDEAL</td>
  <td class="table-scor border-blue">50%</td>                   
  <td class="table-scor border-blue">{{$contador_c3}}</td>                   
</tr>

<tr class="border-blue">
  <td class="table-scor border-blue">SOCIO</td>
  <td class="table-scor  border-blue">{{$porcentaje_c3}}</td>                   
  <td class="table-scor border-blue">{{$c3_sum_eval}}</td>                   
</tr>

<tr class="border-blue">
  <td class="border-blue" rowspan="3"></td>                   
  <td class="border-blue" colspan="2">Cobertura de Cuota</td>                 
  <td class="border-blue table-celda-derecha">{{$covertura}}%</td>                   
  <td class="border-blue table-celda-centrada">{{$covertura_eval}}</td>                   
  <td class="border-blue"></td>                   
  <td class="border-blue"></td>                   
</tr>

<tr class="border-blue">                 
  <td class="border-blue" colspan="2">Gastos/Ingresos    Anterior </td>                  
  <td class="border-blue table-celda-derecha">{{$gastos_anterior}}%</td>                   
  <td class="border-blue table-celda-centrada">{{$gastos_anterior_eval}}</td>                   
  <td class="border-blue"></td>                   
  <td class="border-blue"></td>                   
</tr>
<tr class="border-blue">                 
  <td class="border-blue" colspan="2">Gastos/Ingresos    Actual</td>                  
  <td class="border-blue table-celda-derecha">{{$gastos_actual}}%</td>                   
  <td class="border-blue table-celda-centrada">{{$gastos_actual_eval}}</td>                   
  <td class="border-blue"></td>                   
  <td class="border-blue"></td>                   
</tr>
<!-- c4-->
<tr class="border-blue">
 <td rowspan="3" class="table-scor border-blue">C4</td>
 <td rowspan="3" colspan="3" class="table-scor border-blue">CONDICIONES</td>
 <td colspan="2" class="table-scor border-blue">PONDERADO</td>
 <td class="table-scor border-blue">PTJ</td>
</tr>

<tr class="border-blue">
  <td class="table-scor border-blue">IDEAL</td>
  <td class="table-scor border-blue">5%</td>                   
  <td class="table-scor border-blue">{{$contador_c4}}</td>                   
</tr>

<tr class="border-blue">
  <td class="table-scor border-blue">SOCIO</td>
  <td class="table-scor  border-blue">{{$porcentaje_c4.'%'}}</td>                   
  <td class="table-scor border-blue">{{$c4_sum_eval}}</td>                   
</tr>

<tr class="border-blue">
  <td class="border-blue" rowspan="5"></td>                   
  <td class="border-blue" colspan="3" style="text-align:center;background-color:#BDBDBD;">INGRESOS</td>
  <td class="border-blue"></td>                   
  <td class="border-blue"></td>                   
  <td class="border-blue table-celda-centrada">{{$sum_ingresos_fijo_variable}}</td>                   
</tr>

<tr class="border-blue">                 
  <td class="border-blue">Justificacion de Ingresos</td> 
  <td class="border-blue">Ing. Fijos Mens.</td>                
  <td class="border-blue table-celda-derecha">{{$ingresos_fijos_mensuales}}</td>                   
  <td class="border-blue table-celda-centrada">{{$eval_ingresos_fijos_mensuales}}</td>                   
  <td class="border-blue"></td>                   
  <td class="border-blue"></td>                   
</tr>

<tr class="border-blue">                 
  <td class="border-blue" >Ing. Fijos Mens.</td>  
  <td class="border-blue">Ing. Var. Mens.</td>                 
  <td class="border-blue table-celda-derecha">{{$ingresos_variables_mensuales}}</td>                   
  <td class="border-blue table-celda-centrada">{{$eval_ingresos_variables_mensuales}}</td>                   
  <td class="border-blue"></td>                   
  <td class="border-blue"></td>                   
</tr>

<tr class="border-blue">                 
 <td class="border-blue" colspan="3" style="text-align:center;background-color:#BDBDBD;">INGRESOS MENSUALES</td> 
 <td class="border-blue"></td>                   
 <td class="border-blue"></td>                   
 <td class="border-blue table-celda-centrada">{{$eval_ingresos_ultimo_mes}}</td>                   
</tr>

<tr class="border-blue">                 
  <td class="border-blue">Ingresos del ultimo mes</td>                  
  <td class="border-blue">Fijos + Variables</td>                  
  <td class="border-blue table-celda-derecha">{{$ingresos_ultimo_mes}}</td>                   
  <td class="border-blue table-celda-centrada">{{$eval_ingresos_ultimo_mes}}</td>                   
  <td class="border-blue"></td>                   
  <td class="border-blue"></td>                   
</tr>

<!-- c5-->
<tr class="border-blue">
 <td rowspan="3" class="table-scor border-blue">C5</td>
 <td rowspan="3" colspan="3" class="table-scor border-blue">COLATERAL</td>
 <td colspan="2" class="table-scor border-blue">PONDERADO</td>
 <td class="table-scor border-blue">PTJ</td>
</tr>

<tr class="border-blue">
  <td class="table-scor border-blue">IDEAL</td>
  <td class="table-scor border-blue">5%</td>                   
  <td class="table-scor border-blue">{{$contador_c5}}</td>                   
</tr>

<tr class="border-blue">
  <td class="table-scor border-blue">SOCIO</td>
  <td class="table-scor  border-blue">{{$porcentaje_c5.'%'}}</td>                   
  <td class="table-scor border-blue">{{$total_c5}}</td>                   
</tr>

<tr class="border-blue">
  <td class="border-blue" rowspan="4"></td>                   
  <td class="border-blue" colspan="3" style="text-align:center;background-color:#BDBDBD;">GARANTIAS</td>
  <td class="border-blue"></td>                   
  <td class="border-blue"></td>                   
  <td class="border-blue table-celda-centrada">{{ $total_c5}}</td>                   
</tr>

<tr class="border-blue">                 
  <td class="border-blue">GARANTIA 1</td>             
  <td class="border-blue table-celda-centrada" colspan="2">{{$tipoGarantia1}}</td>                   
  <td class="border-blue table-celda-centrada">{{$c5_sum_eval_1}}</td>                   
  <td class="border-blue"></td>                   
  <td class="border-blue"></td>                   
</tr>

<tr class="border-blue">                 
  <td class="border-blue" >GARANTIA 2</td>                
  <td class="border-blue table-celda-centrada" colspan="2"> {{$tipoGarantia2}}</td>                   
  <td class="border-blue table-celda-centrada">{{$c5_sum_eval_2}}</td>                   
  <td class="border-blue"></td>                   
  <td class="border-blue"></td>                   
</tr>

</table>
<table class="tabla-cabecera">
  <tr class="border-blue">                 
    <td class="border-blue table-celda-naranja" >PUNTAJE SCORING (5 C´s)</td>                     
    <td class="border-blue table-celda-centrada">{{$puntaje_scoring}}%</td>                         
  </tr>
  <tr class="border-blue">                 
    <td class="border-blue table-celda-naranja" >EQUIVALENCIA SOBRE ESCALA DE 80 PUNTOS.</td>   
    <td class="border-blue table-celda-centrada">{{$equivalencia_80}}%</td>                         
  </tr>
  <tr class="border-blue">                 
    <td class="border-blue table-celda-naranja" >PROBABILIDAD DE PROVISION POR INPAGO.</td>                     
    <td class="border-blue table-celda-centrada">{{$probabilidad_impago}}%</td>                         
  </tr>
  <tr class="border-blue">                 
    <td class="border-blue table-celda-naranja" >EQUIVALENCIA SOBRE ESCALA DE 20 PUNTOS.</td>                     
    <td class="border-blue table-celda-centrada">{{$equivalencia_20}}%</td>                         
  </tr>
  <tr class="border-blue">                 
    <td class="border-blue table-celda-naranja" >CALIFICACION DE RIESGO. CREDITICIO</td>
    <td class="border-blue table-celda-centrada">{{$riesgo_crediticio}}%</td>                         
  </tr>

</tr>
<tr class="border-blue">                 
  <td class="border-blue table-celda-naranja" >TIPO DE RIESGO</td>
  <td class="border-blue table-celda-centrada">{{$tipo_riesgo}}</td>                         
</tr>

</tr>
<tr class="border-blue">                 
  <td class="border-blue table-celda-naranja" >RECOMENDACIÓN</td>
  <td class="border-blue table-celda-centrada">{{$recomendacion}}</td>                         
</tr>
</table>

@endsection
