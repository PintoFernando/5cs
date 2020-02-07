@extends ('layouts.admin3')
@section ('contenido')


<div class="row">
  <center><div  class="box-header">
    <h3 class="box-title"><b>COOPERATIVA DE AHORRO Y CRÉDITO SOCIETARIA  "SAN MARTÍN" R.L.</b></h3>
    <br>
    <h3 class="box-title"><b>FORMULARIO DE ANÁLISIS DE CODEUDOR</b></h3>
  </div></center>
</div>

@if ($if_exist_credito>0)
<table  style="width:100%"  border="2" style="margin:auto;">
  <thead>
    <tr>
      <th width="80" colspan="6" class="table-celda-verde"><h7><strong>SOLICITUD DE CRÉDITO</strong></h7></th>
    </tr>
    <tr>
      <th class="table-celda-naranja">Fecha de Solicitud</th>
      <th class="table-celda-naranja">Tipo de Crédito</th>
      <th class="table-celda-naranja">Monto Solicitado</th>
      <th class="table-celda-naranja">Tipo de Moneda</th>
      <th class="table-celda-naranja">Periodo de Pago</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($credito as $cre)
    <tr>
      <td class="table-celda-centrada">{{$cre->fecha_solicitud}}</td>
      <td  class="table-celda-centrada">{{$cre->tipo_credito}}</td>
      <td  class="table-celda-centrada">{{$cre->monto_solicitado}}</td>
      <td  class="table-celda-centrada">{{$cre->tipo_moneda}}</td>
      <td  class="table-celda-centrada">{{$cre->periodo_pago}}</td>
    </tr>
  </tbody>
  <thead>
    <tr>
      <th class="table-celda-naranja">Interés Nominal</th>
      <th class="table-celda-naranja">Tipo de Amortización</th>
      <th class="table-celda-naranja">Plazo en Meses</th>
      <th colspan="2" class="table-celda-naranja">Destino del Crédito</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="table-celda-centrada" >{{$cre->interes_nominal*100}}%</td>
      <td class="table-celda-centrada" >{{$cre->amortizacion}}</td>
      <td class="table-celda-centrada" >{{$cre->plazo_meses}}</td>
      <td class="table-celda-centrada" colspan="2">{{$cre->destino_credito}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endif


@if($if_exist_garantias>0)

<table  style="width:100%"  border="2" style="margin:auto;">
  <thead>
    <tr>
      <th width="80" colspan="6" class="table-celda-verde"><h7><strong>GARANTIAS</strong></h7></th>
    </tr>
    <tr>
      <th class="table-celda-naranja">N°</th>
      <th class="table-celda-naranja">GARANTÍA</th>
    </tr>
  </thead>
  <tbody>
    <?php
$cont = 1;
?>
    @foreach ($garantias as $ga)
    <tr>
      <td class="table-celda-centrada">{{$cont}}</td>
      <?php $cont++?>
      <td  class="table-celda-centrada">{{$ga->tipo_garantia}}</td>
    </tr>
  </tbody>

  @endforeach
</tbody>
</table>
@endif

<table  style="width:100%"  border="2">
  <thead>
    <tr>
      <th width="80" colspan="6" class="table-celda-verde"><h7><strong>INFORMACIÓN GENERAL DEL CODEUDOR</strong></h7></th>
    </tr>
    <tr>
      <th class="table-celda-naranja">Cédula de Identidad</th>
      <th class="table-celda-naranja">Apellido de Casada</th>
      <th class="table-celda-naranja">Apellido Paterno</th>
      <th class="table-celda-naranja">Apellido Materno</th>
      <th class="table-celda-naranja">Nombres</th>
      <th class="table-celda-naranja">Fecha de Nacimiento</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($personas as $per)
    <tr>
      <td class="table-celda-centrada">{{$per->ci}}-{{$per->extension}}</td>
      <td class="table-celda-centrada">{{$per->ap_casada}}</td>
      <td class="table-celda-centrada">{{$per->ap_paterno}}</td>
      <td class="table-celda-centrada">{{$per->ap_materno}}</td>
      <td class="table-celda-centrada">{{$per->nombre}}</td>
      <td class="table-celda-centrada">{{$per->fec_nac}}</td>
    </tr>
  </tbody>
  <thead>
    <tr>
      <th class="table-celda-naranja">Edad</th>
      <th class="table-celda-naranja">Nacionalidad</th>
      <th class="table-celda-naranja">Departamento De Nacimiento</th>
      <th class="table-celda-naranja">Ciudad de Nacimiento</th>
      <th class="table-celda-naranja" colspan="2">Provincia de Nacimiento</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="table-celda-centrada">{{\Carbon\Carbon::parse($per->fec_nac)->age}}</td>
      <td class="table-celda-centrada">{{$per->nacionalidad}}</td>
      <td class="table-celda-centrada">{{$per->departamento_nac}}</td>
      <td class="table-celda-centrada">{{$per->ciudad_nac}}</td>
      <td class="table-celda-centrada" colspan="2">{{$per->provincia_nac}}</td>
    </tr>

    <tr>
     <th class="table-celda-naranja">Provincia Nacimiento</th>
     <th class="table-celda-naranja">Estado  Civil</th>
     <th class="table-celda-naranja">Género</th>
     <th class="table-celda-naranja">Telefono/Celular</th>
     <th class="table-celda-naranja" >Dependientes del Ingreso</th>
     <th class="table-celda-naranja" >Profesión</th>
   </tr>


   <tr>
     <td class="table-celda-centrada">{{$per->provincia_nac}}</td>
     <td class="table-celda-centrada">{{$per->estado_civil}}</td>
     <td class="table-celda-centrada">{{$per->genero}}</td>
     <td class="table-celda-centrada">{{$per->celular}}</td>
     <td class="table-celda-centrada">{{$per->dependientes}}</td>
     <td class="table-celda-centrada">{{$per->profesion}}</td>
   </tr>

   @endforeach
 </tbody>
</table>


@if ($if_exist_direccion>0)

<table  style="width:100%"  border="2">
  <thead>
    <tr>
      <th width="80" colspan="8" class="table-celda-verde"><h7><strong>DIRECCIÓN DOMICILIARIA DEL CODEUDOR</strong></h7></th>
    </tr>
    <tr>
      <th class="table-celda-naranja">Ciudad</th>
      <th class="table-celda-naranja">Provincia</th>
      <th class="table-celda-naranja">Zona</th>
      <th class="table-celda-naranja">Barrio</th>
    </tr>

  </thead>
  <tbody>
    @foreach ($direccion as $dire)
    <tr>
      <td  class="table-celda-centrada">{{$dire->ciudad}}</td>
      <td  class="table-celda-centrada">{{$dire->provincia}}</td>
      <td  class="table-celda-centrada">{{$dire->zona}}</td>
      <td  class="table-celda-centrada">{{$dire->barrio}}</td>
    </tr>
    <tr>
      <th class="table-celda-naranja">Calle Principal</th>
      <th class="table-celda-naranja">Calle Secundaria</th>
      <th class="table-celda-naranja">N°</th>
      <th class="table-celda-naranja">Tipo de Vivienda</th>
    </tr>
    <tr>
      <td class="table-celda-centrada">{{$dire->cll_principal}}</td >
      <td class="table-celda-centrada">{{$dire->cll_secundaria}}</td >
      <td class="table-celda-centrada">{{$dire->direc_numero}}</td >
      <td class="table-celda-centrada">{{$dire->tipo_vivienda}}</td >

    </tr>
    @endforeach
  </tbody>
</table>
@endif

@if ($if_exist_datos_empresa>0)
<table  style="width:100%"  border="2">
  <thead>
    <tr>
      <th colspan="9" class="table-celda-verde"><h7><strong>DATOS DE LA EMPRESA O INSTITUCIÓN DONDE
      TRABAJA EL CODEUDOR </strong></h7></th>
    </tr>
    <tr >
      <th class="table-celda-naranja">Ciudad</th>
      <th class="table-celda-naranja">Provincia</th>
      <th class="table-celda-naranja">Dirección</th>
      <th class="table-celda-naranja">Telefono</th>
      <th class="table-celda-naranja">Nombre de la Empresa</th>
      <th class="table-celda-naranja">Actividad de la Empresa</th>
      <th class="table-celda-naranja">Cargo en la Empresa</th>
      <th class="table-celda-naranja">Antiguedad Empresa</th>
      <th class="table-celda-naranja">Antiguedad Cargo</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($datos_empresa as $em)
    <tr>
      <td class="table-celda-centrada">{{$em->ciudad_empresa}}</td>
      <td class="table-celda-centrada">{{$em->provincia_empresa}}</td>
      <td class="table-celda-centrada">{{$em->direccion_empresa}}</td>
      <td class="table-celda-centrada">{{$em->telefono_empresa}}</td>
      <td class="table-celda-centrada">{{$em->nombre_empresa}}</td>
      <td class="table-celda-centrada">{{$em->actividad_empresa}}</td>
      <td class="table-celda-centrada">{{$em->cargo_en_empresa}}</td>
      <td class="table-celda-centrada">{{\Carbon\Carbon::parse($em->antiguedad_empresa)->age}} años</td>
      <td class="table-celda-centrada">{{\Carbon\Carbon::parse($em->antiguedad_en_cargo)->age}} años</td>

    </tr>
  </tbody>
  <thead>
    <tr>
      <th class="table-celda-naranja">Antiguedad en la Empresa</th>
      <th class="table-celda-naranja">Antiguedad en el Cargo</th>
      <th class="table-celda-naranja">AFP</th>
      <th class="table-celda-naranja">Horario de Trabajo</th>
      <th class="table-celda-naranja">Dias de Trabajo</th>
      <th colspan="4" class="table-celda-naranja">Tipo de contrato</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="table-celda-centrada">{{$em->antiguedad_empresa}}</td>
      <td class="table-celda-centrada">{{$em->antiguedad_en_cargo}}</td>
      <td class="table-celda-centrada">{{$em->nombre_afp}}</td>
      <td class="table-celda-centrada">{{$em->horario_trabajo}}</td>
      <td class="table-celda-centrada">{{$em->dias_trabajo}}</td>
      <td class="table-celda-centrada"colspan="4">{{$em->nombre_tc}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endif

@if ($if_exist_actividad_eco>0)
<table  style="width:100%"  border="2">
  <thead>
   <tr>
    <th colspan=6 class="table-celda-verde"><h7><strong>DATOS ACTIVIDAD ECONÓMICA</strong></h7></th>
  </tr>
  <tr >
    <th class="table-celda-naranja">Ciudad</th>
    <th class="table-celda-naranja">Provincia</th>
    <th class="table-celda-naranja">Zona</th>
    <th class="table-celda-naranja">Dirección</th>
    <th class="table-celda-naranja">Telefono</th>
  </tr>
  <tbody>
    @foreach ($actividad_eco as $actividad)
    <tr>
      <td class="table-celda-centrada">{{$actividad->ciudad_ae}}</td>
      <td class="table-celda-centrada">{{$actividad->provincia_ae}}</td>
      <td class="table-celda-centrada">{{$actividad->zona_ae}}</td>
      <td class="table-celda-centrada">{{$actividad->direccion_ae}}</td>
      <td class="table-celda-centrada">{{$actividad->telefono_ae}}</td>

      <tr>
        <th class="table-celda-naranja">Actividad que Realiza</th>
        <th class="table-celda-naranja">NIT</th>
        <th class="table-celda-naranja">Horario de Trabajo</th>
        <th class="table-celda-naranja">Dias de Trabajo</th>
        <th class="table-celda-naranja">Antiguedad en el Trabajo</th>

      </tr>
    </thead>
    <td class="table-celda-centrada">{{$actividad->actividad_qrealiza}}</td>
    <td class="table-celda-centrada">{{$actividad->nit_ae}}</td>
    <td class="table-celda-centrada">{{$actividad->horario_trabajo_ae}}</td>
    <td class="table-celda-centrada">{{$actividad->dias_trabajo_ae}}</td>
    <td class="table-celda-centrada">{{\Carbon\Carbon::parse($actividad->antiguedad_trabajo_ae)->age}} años</td>

  </tr>
  @endforeach
</tbody>
</table>
@endif

@if ($if_exists_conyugue>0)
<table  style="width:100%"  border="2">
  <thead>
   <tr>
    <th colspan="10" class="table-celda-verde"><h7><strong>INFORMACIÓN DEL CÓNYUGE</strong></h7></th>
  </tr>
  <tr >
   <th class="table-celda-naranja">C.I.</th>
   <th class="table-celda-naranja">Apellido de Casada</th>
   <th class="table-celda-naranja">Apellido Paterno</th>
   <th class="table-celda-naranja">Apellido Materno</th>
   <th class="table-celda-naranja">Nombres</th>
   <th class="table-celda-naranja">Profesión</th>
   <th class="table-celda-naranja">Fecha nac</th>
   <th class="table-celda-naranja">Edad</th>
   <th class="table-celda-naranja">Telefono/Celular</th>
 </tr>
</thead>
<tbody>
  @foreach ($persona as $co)
  <tr>
   <td class="table-celda-centrada">{{$co->ci}} - {{$co->extension}} </td>
   <td class="table-celda-centrada">{{$co->ap_casada}} </td>
   <td class="table-celda-centrada">{{$co->ap_paterno}} </td>
   <td class="table-celda-centrada">{{$co->ap_materno}} </td>
   <td class="table-celda-centrada">{{$co->nombre}} </td>
   <td class="table-celda-centrada">{{$co->profesion}} </td>
   <td class="table-celda-centrada">{{$co->fec_nac}} </td>
   <td class="table-celda-centrada">{{\Carbon\Carbon::parse($co->fec_nac)->age}} años</td>
   <td class="table-celda-centrada">{{$co->celular}} </td>
 </tr>
 @if ($if_exist_detalle>0)
 <tr>
   <th class="table-celda-naranja">Ocupación</th>
   <th class="table-celda-naranja">Cargo</th>
   <th class="table-celda-naranja">Tiempo de Trabajo</th>
   <th class="table-celda-naranja" colspan="2" >Nombre Institución/Empresa</th>
   <th class="table-celda-naranja" colspan="2">Calle Principal</th>
   <th class="table-celda-naranja">Calle Secundaria</th>
   <th class="table-celda-naranja">Teléfono Institución</th>
 </tr>
 <tr>
   <td class="table-celda-centrada">{{$co->ocupacion}}</td>
   <td class="table-celda-centrada">{{$co->cargo}} </td>
   <td class="table-celda-centrada">{{\Carbon\Carbon::parse($co->tiempo_trabajo)->age}} años </td>
   <td class="table-celda-centrada" colspan="2">{{$co->nombre_institucion}} </td>
   <td class="table-celda-centrada" colspan="2">{{$co->calle_principal}} </td>
   <td class="table-celda-centrada">{{$co->calle_secundaria}} </td>
   <td class="table-celda-centrada">{{$co->telefono}} </td>
 </tr>
 @endif
 @endforeach
</tbody>
</table>
@endif

@if ($if_exist_referencia>0)
<table  style="width:100%"  border="2">
  <thead>
   <tr>
    <th colspan="10" class="table-celda-verde"><h7><strong>Referencias Solicitante</strong></h7></th>
  </tr>
  <tr >
   <th class="table-celda-naranja">Id</th>
   <th class="table-celda-naranja">Apellido Paterno</th>
   <th class="table-celda-naranja">Apellido Materno</th>
   <th class="table-celda-naranja">Nombre</th>
   <th class="table-celda-naranja">Parentesco</th>
   <th class="table-celda-naranja">Celular</th>
   <th class="table-celda-naranja">Teléfono</th>

 </tr>
</thead>
<tbody>
  @foreach ($referencias as $re)
  <tr>
   <td class="table-celda-centrada">{{$re->id_referencia_solicitante}} </td>
   <td class="table-celda-centrada">{{$re->ap_paterno}} </td>
   <td class="table-celda-centrada">{{$re->ap_materno}} </td>
   <td class="table-celda-centrada">{{$re->nombre}} </td>
   <td class="table-celda-centrada">{{$re->parentesco}} </td>
   <td class="table-celda-centrada">{{$re->celular}} </td>
   <td class="table-celda-centrada">{{$re->telefono}} </td>

 </tr>
 @endforeach
</tbody>
<thead>
</thead>
</table>
@endif

@if($if_exist_croquis_direccion>0)
<table  style="width:100%"  border="2">
  <thead>
   <th colspan="10" class="table-celda-verde"><h7><strong>Croquis de la ubicación del domicilio del solicitante</strong></h7></th>
 </thead>
 <tbody>
  <tr>
    <td>
      <div class="row">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div  id="map-container"></div>
      </div>
    </div>

  </td>
</tr>
</tbody>
</table>
@endif
@if($if_exist_croquis_empresa>0)
<table  style="width:100%"  border="2">
  <thead>
   <th colspan="10" class="table-celda-verde"><h7><strong>Croquis de la ubicación de la Institución/Empresa donde trabaja el solicitante</strong></h7></th>
 </thead>
 <tbody>
  <tr>
    <td>
      <div class="row">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div  id="map-container-empresa"></div>
      </div>
    </div>

  </td>
</tr>
</tbody>
</table>
@endif
@if($if_exist_croquis_trabajo>0)
<table  style="width:100%"  border="2">
  <thead>
   <th colspan="10" class="table-celda-verde"><h7><strong>Croquis de la ubicación de la fuente laboral del solicitante</strong></h7></th>
 </thead>
 <tbody>
  <tr>
    <td>
      <div class="row">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div  id="map-container-trabajo"></div>
      </div>
    </div>

  </td>
</tr>
</tbody>
</table>
@endif
<table  style="width:100%"  border="2">
  <thead>
   <tr>
    <th colspan="7" class="table-celda-separador"><h7><strong>INFORMACIÓN FINANCIERA</strong></h7></th>
  </tr>
</thead>
</table>
@if ($if_exist_deposito>0)
<table  style="width:100%"  border="2">
  <thead>
   <tr>
    <th colspan="7" class="table-celda-verde"><h7><strong>DEPÓSITOS BANCARIOS</strong></h7></th>
  </tr>
  <tr >
   <th class="table-celda-naranja">Entidad Bancaria</th>
   <th class="table-celda-naranja">Tipo de Deposito</th>
   <th class="table-celda-naranja">Numero de Cuenta</th>
   <th class="table-celda-naranja">Saldo</th>

 </tr>
</thead>
<tbody>
  @foreach ($deposito as $dep)
  <tr>
   <td >{{$dep->nombre_entidad}} </td>
   <td >{{$dep->nombre_deposito}} </td>
   <td >{{$dep->numero_cuenta}} </td>
   <td class="table-celda-derecha">{{number_format($dep->saldo,2,',', '.')}} </td>

 </tr>
 @endforeach
</tbody>

<td colspan="3"><b>TOTAL DEPOSITOS BANCARIOS:</b></td>
<td class="table-celda-derecha"><b>{{number_format($total_depositos_bancarios,2,',', '.')}}</b></td>

</table>
@endif



@if ($if_exist_inversiones>0)
<table  style="width:100%"  border="2">
  <thead>
    <tr>
      <th colspan="7" class="table-celda-verde"><h7><strong>INVERSIONES FINANCIERAS </strong>(Acciones, Bonos y Valores)</h7></th>
    </tr>
    <tr >
     <th class="table-celda-naranja">Cantidad</th>
     <th class="table-celda-naranja">% Patrimonio Empresa</th>
     <th class="table-celda-naranja">NIT / C.I.</th>
     <th class="table-celda-naranja">Nombre de la Empresa</th>
     <th class="table-celda-naranja">Valor Nominal</th>
     <th class="table-celda-naranja">Valor de Mercado</th>

   </tr>
 </thead>
 <tbody>
  @foreach ($inversiones as $in)
  <tr>
   <td >{{$in->cantidad}} </td>
   <td >{{$in->porcentaje_patrimonio_empre}} </td>
   <td >{{$in->nit}} </td>
   <td >{{$in->nombre_empresa}} </td>
   <td class="table-celda-derecha">{{number_format($in->valor_nominal,2,',', '.')}} </td>
   <td class="table-celda-derecha">{{number_format($in->valor_mercado,2,',', '.')}} </td>

 </tr>
 @endforeach
</tbody>
<td colspan="5"><b>TOTAL INVERSIONES FINANCIERAS:</b></td>
<td class="table-celda-derecha"><b>{{number_format($total_inversiones,2,',', '.')}}</b></td>
</table>
@endif


@if ($if_exist_cuentas_cobrar>0)
<table  style="width:100%"  border="2">
  <thead>
    <tr>
      <th colspan="7" class="table-celda-verde"><h7><strong>CUENTAS Y DOCUMENTOS POR COBRAR</strong></h7></th>
    </tr>
    <tr >
     <th class="table-celda-naranja">NIT / C.I.</th>
     <th class="table-celda-naranja">Nombre o Razón Social del Deudor</th>
     <th class="table-celda-naranja">Concepto o Tipo de Documento</th>
     <th class="table-celda-naranja">Saldo</th>

   </tr>
 </thead>
 <tbody>
  @foreach ($cuentas_cobrar as $cu)
  <tr>
   <td >{{$cu->nit}} </td>
   <td >{{$cu->nombre_razon_social}} </td>
   <td >{{$cu->concepto}} </td>
   <td class="table-celda-derecha">{{number_format($cu->saldo,2,',', '.')}} </td>

 </tr>
 @endforeach
</tbody>
<td colspan="3"><b>TOTAL CUENTAS Y DOCUMENTOS POR COBRAR:</b></td>
<td class="table-celda-derecha"><b>{{number_format($total_cuentas_cobrar,2,',', '.')}}</b></td>
</table>
@endif

@if ($if_exist_mercaderia>0)
<table  style="width:100%"  border="2">
  <thead>
    <tr>
      <th colspan="7" class="table-celda-verde"><h7><strong>INVENTARIO DE MERCADERIAS</strong></h7></th>
    </tr>
    <tr >
     <th class="table-celda-naranja">Detalle</th>
     <th class="table-celda-naranja">Cantidad</th>
     <th class="table-celda-naranja">Precio Unitario</th>
   </tr>
 </thead>
 <tbody>
  @foreach ($mercaderia as $me)
  <tr>
   <td >{{$me->detalle}} </td>
   <td >{{$me->cantidad}} </td>
   <td class="table-celda-derecha">{{number_format($me->precio_unitario,2,',', '.')}} </td>
 </tr>
 @endforeach
</tbody>
<td colspan="2"><b>TOTAL INVENTARIO DE MERCADERIAS:</b></td>
<td class="table-celda-derecha"><b>{{number_format($total_mercaderia_inventarios,2,',', '.')}}</b></td>
</table>
@endif

@if ($if_exist_maquinaria>0)
<table  style="width:100%"  border="2">
  <thead>
    <tr>
      <th colspan="7" class="table-celda-verde"><h7><strong>MAQUINARIA Y EQUIPO</strong></h7></th>
    </tr>
    <tr >
     <th class="table-celda-naranja">Descripción</th>
     <th class="table-celda-naranja">Marca</th>
     <th class="table-celda-naranja">Modelo</th>
     <th class="table-celda-naranja">Año</th>
     <th class="table-celda-naranja">Aseguradora</th>
     <th class="table-celda-naranja">Entidad Acreedora</th>
     <th class="table-celda-naranja">Total</th>
   </tr>
 </thead>
 <tbody>
  @foreach ($maquinaria as $ma )
  <tr>
   <td >{{$ma->descripcion}} </td>
   <td >{{$ma->marca}} </td>
   <td >{{$ma->modelo}} </td>
   <td >{{$ma->anio}} </td>
   <td >{{$ma->aseguradora}} </td>
   <td >{{$ma->entidad_acreedora}} </td>
   <td class="table-celda-derecha">{{number_format($ma->total,2,',', '.')}} </td>
 </tr>
 @endforeach
</tbody>
<td colspan="6"><b>TOTAL MAQUINARIA Y EQUIPO:</b></td>
<td class="table-celda-derecha"><b>{{number_format($total_maquinaria,2,',', '.')}}</b></td>
</table>
@endif

@if ($if_exist_bienes>0)
<table  style="width:100%"  border="2">
  <thead>
    <tr>
      <th colspan="7" class="table-celda-verde"><h7><strong>BIENES DEL HOGAR</strong></h7></th>
    </tr>
    <tr >
     <th class="table-celda-naranja">Articulo</th>
     <th class="table-celda-naranja">Descripción</th>
     <th class="table-celda-naranja">Marca</th>
     <th class="table-celda-naranja">Color</th>
     <th class="table-celda-naranja">Modelo</th>
     <th class="table-celda-naranja">Estado</th>
     <th class="table-celda-naranja">Total</th>
   </tr>
 </thead>
 <tbody>
  @foreach ($bienes as $bi )
  <tr>
   <td >{{$bi->articulo}} </td>
   <td >{{$bi->descripcion}} </td>
   <td >{{$bi->marca}} </td>
   <td >{{$bi->color}} </td>
   <td >{{$bi->modelo}} </td>
   <td >{{$bi->estado}} </td>
   <td class="table-celda-derecha">{{number_format($bi->valor,2,',', '.')}} </td>
 </tr>
 @endforeach
</tbody>
<td colspan="6"><b>TOTAL BINES DEL HOGAR:</b></td>
<td class="table-celda-derecha"><b>{{number_format($total_bienes_hogar,2,',', '.')}}</b></td>
</table>
@endif

@if ($if_exist_inmuebles>0)
<table  style="width:100%"  border="2">
  <thead>
    <tr>
      <th colspan="8" class="table-celda-verde"><h7><strong>INMUEBLES URBANOS Y RURALES</strong></h7></th>
    </tr>
    <tr >
     <th class="table-celda-naranja">Ciudad</th>
     <th class="table-celda-naranja">Calle</th>
     <th class="table-celda-naranja">N°</th>
     <th class="table-celda-naranja">Zona</th>
     <th class="table-celda-naranja">N° Folio Real</th>
     <th class="table-celda-naranja">Fecha de Registro</th>
     <th class="table-celda-naranja">En garantia</th>
     <th class="table-celda-naranja">Total</th>
   </tr>
 </thead>
 <tbody>
  @foreach ($inmuebles as $in )
  <tr>
   <td >{{$in->ciudad}} </td>
   <td >{{$in->calle}} </td>
   <td >{{$in->numero}} </td>
   <td >{{$in->zona}} </td>
   <td >{{$in->num_folio_real}} </td>
   <td >{{$in->fecha_registro}} </td>
   <td >@if($in->en_garantia==1)Si @else No @endif </td>
   <td class="table-celda-derecha">{{number_format($in->valor,2,',', '.')}} </td>
 </tr>
 @endforeach
</tbody>
<td colspan="7"><b>TOTAL INMUEBLES:</b></td>
<td class="table-celda-derecha"><b>{{number_format($total_propiedades,2,',', '.')}}</b></td>
</table>
@endif

@if ($if_exist_vehiculo>0)
<table  style="width:100%"  border="2">
  <thead>
    <tr>
      <th colspan="7" class="table-celda-verde"><h7><strong>VEHICULO</strong></h7></th>
    </tr>
    <tr >
     <th class="table-celda-naranja">Tipo</th>
     <th class="table-celda-naranja">Marca</th>
     <th class="table-celda-naranja">Modelo</th>
     <th class="table-celda-naranja">Placa</th>
     <th class="table-celda-naranja">Rua</th>
     <th class="table-celda-naranja">En Garantia</th>
     <th class="table-celda-naranja">Total</th>
   </tr>
 </thead>
 <tbody>
  @foreach ($vehiculo as $ve )
  <tr>
   <td >{{$ve->tipo}} </td>
   <td >{{$ve->marca}} </td>
   <td >{{$ve->modelo}} </td>
   <td >{{$ve->placa}} </td>
   <td >{{$ve->rua}} </td>
   <td >@if($ve->en_garantia==1)Si @else No @endif </td>
   <td class="table-celda-derecha">{{number_format($ve->valor,2,',', '.')}} </td>
 </tr>
 @endforeach
</tbody>
<td colspan="6"><b>TOTAL VEHICULOS:</b></td>
<td class="table-celda-derecha"><b>{{number_format($total_vehiculos,2,',', '.')}}</b></td>
</table>
@endif

@if ($if_exist_otros>0)
<table  style="width:100%"  border="2">
  <thead>
    <tr>
      <th colspan="7" class="table-celda-verde"><h7><strong>OTROS ACTIVOS</strong></h7></th>
    </tr>
    <tr >
     <th class="table-celda-naranja">Detalle</th>
     <th class="table-celda-naranja">Nombre Entidad Acreedora</th>
     <th colspan="5" class="table-celda-naranja">Total</th>
   </tr>
 </thead>
 <tbody>
  @foreach ($otros as $o )
  <tr>
   <td >{{$o->detalle}} </td>
   <td >{{$o->en_garantia}} </td>
   <td class="table-celda-derecha" colspan="5" >{{number_format($o->total,2,',', '.')}} </td>

 </tr>
 @endforeach
</tbody>
<td colspan="2"><b>TOTAL OTROS ACTIVOS:</b></td>
<td class="table-celda-derecha"><b>{{number_format($total_otros_activos,2,',', '.')}}</b></td>
</table>
@endif

@if ($if_exist_prestamo>0)
<table  style="width:100%"  border="2">
  <thead>
    <tr>
      <th colspan="7" class="table-celda-verde"><h7><strong>PRESTAMOS BANCARIOS</strong></h7></th>
    </tr>
    <tr >
     <th class="table-celda-naranja">Banco o Institución Financiera</th>
     <th class="table-celda-naranja">Importe Original</th>
     <th class="table-celda-naranja">Duración del Crédito</th>
     <th class="table-celda-naranja">Importe Ultimo Pago</th>
     <th class="table-celda-naranja">Tipo de Prestamo</th>
     <th class="table-celda-naranja">Destino del Crédito</th>
     <th class="table-celda-naranja">Saldo</th>
   </tr>
 </thead>
 <tbody>
  @foreach ($prestamo as $pre )
  <tr>
    <td >{{$pre->nombre_entidad}} </td>
    <td >{{$pre->importe_original}} </td>
    <td >{{$pre->duracion_credito}} </td>
    <td >{{$pre->importe_ultimo_pago}} </td>
    <td >{{$pre->tipo_credito}} </td>
    <td >{{$pre->destino_credito}} </td>
    <td class="table-celda-derecha">{{number_format($pre->saldo,2,',', '.')}} </td>
  </tr>
  @endforeach
</tbody>
<td colspan="6"><b>TOTAL PRESTAMOS BANCARIOS:</b></td>
<td class="table-celda-derecha"><b>{{number_format($total_prestamos_bancarios,2,',', '.')}}</b></td>
</table>
@endif

@if ($if_exist_cuentas>0)
<table  style="width:100%"  border="2">
  <thead>
    <tr>
      <th colspan="7" class="table-celda-verde"><h7><strong>CUENTAS POR PAGAR</strong></h7></th>
    </tr>
    <tr >
     <th class="table-celda-naranja">Institución</th>
     <th class="table-celda-naranja">Tiempo</th>
     <th class="table-celda-naranja">Cuota Mensual</th>
     <th colspan="5" class="table-celda-naranja">Saldo</th>

   </tr>
 </thead>
 <tbody>
  @foreach ($cuentas as $cu )
  <tr>
   <td >{{$cu->institucion}} </td>
   <td >{{$cu->tiempo}} </td>
   <td >{{$cu->cuota_mensual}} </td>
   <td class="table-celda-derecha" colspan="5">{{number_format($cu->saldo,2,',', '.')}} </td>
 </tr>
 @endforeach
</tbody>
<td colspan="3"><b>TOTAL CUENTAS POR PAGAR:</b></td>
<td class="table-celda-derecha"><b>{{number_format($total_cuentas_por_pagar,2,',', '.')}}</b></td>
</table>
@endif

<table style="width:100%"  border="2">
  <tr>
    <th colspan="7" class="table-celda-verde"><h7><strong>ESTADO DE SITUACION PERSONAL CONFIDENCIAL</strong></h7></th>
  </tr>
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
    <td>DEPOSITOS BANCARIOS</td>
    <td class="table-celda-derecha">{{number_format($total_depositos_bancarios,2,',', '.')}}</td>
    <td>PRESTAMOS BANCARIOS</td>
    <td class="table-celda-derecha">{{number_format($total_prestamos_bancarios,2,',', '.')}}</td>
  </tr>

  <tr>
    <td>CUENTAS POR COBRAR</td>
    <td class="table-celda-derecha">{{number_format($total_cuentas_cobrar,2,',', '.')}}</td>
    <td>CUENTAS POR PAGAR</td>
    <td class="table-celda-derecha">{{number_format($total_cuentas_por_pagar_saldo,2,',', '.')}}</td>
  </tr>

  <tr>
    <td>INVERSIONES</td>
    <td class="table-celda-derecha">{{number_format($total_inversiones,2,',', '.')}}</td>
    <td class="table-celda-naranja">TOTAL PASIVO</td>
    <td class="table-celda-derecha">{{number_format($total_pasivos,2,',', '.')}}</td>
  </tr>

  <tr>
    <td>MAQUINARIA</td>
    <td class="table-celda-derecha">{{number_format($total_maquinaria,2,',', '.')}}</td>
    <td class="table-celda-naranja"> PATRIMONIO</td>
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
    <td>OTROS ACTIVOS S/INVENTARIO</td>
    <td class="table-celda-derecha">{{number_format($total_otros_activos,2,',', '.')}}</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td class="table-celda-naranja">TOTAL ACTIVO</td>
    <td class="table-celda-derecha">{{number_format($total_activos,2,',', '.')}}</td>
    <td class="table-celda-naranja">TOTAL PASIVO + PATRIMONIO</td>
    <td class="table-celda-derecha">{{number_format($total_pasivo_patrimonio,2,',', '.')}}</td>
  </tr>
</table>

@if ($if_exist_ingresos>0)
<table  style="width:100%"  border="2">
  <thead>
    <tr>
      <th colspan="8" class="table-celda-verde"><h7><strong>INGRESOS FIJOS MENSUALES</strong></h7></th>
    </tr>
    <tr >
     <th class="table-celda-naranja">Mes</th>
     <th class="table-celda-naranja">Año</th>
     <th class="table-celda-naranja">Prestatario</th>
     <th class="table-celda-naranja">Cónyugue</th>
     <th class="table-celda-naranja">Otros</th>
     <th class="table-celda-naranja">Codeudores</th>
     <th class="table-celda-naranja">Total Ingreso</th>
     <th class="table-celda-naranja">Descripción</th>
   </tr>
 </thead>
 <tbody>
  @foreach ($ingresos as $in )
  <tr>
   <td >{{$in->mes}} </td>
   <td >{{$in->anio}} </td>
   <td class="table-celda-derecha">{{number_format($in->prestatario,2,',', '.')}} </td>
   <td class="table-celda-derecha">{{number_format($in->conyugue,2,',', '.')}} </td>
   <td class="table-celda-derecha">{{number_format($in->otros,2,',', '.')}} </td>
   <td class="table-celda-derecha">{{number_format($in->codeudores,2,',', '.')}} </td>
   <td class="table-celda-derecha">{{number_format($in->total_ingreso,2,',', '.')}} </td>
   <td >{{$in->descripcion}} </td>
 </tr>
 @endforeach
 <tr>
   <td  class="table-celda-verde">Promedio</td>
   <td  class="table-celda-verde"></td>
   <td class="table-celda-derecha">{{number_format($ingreso_promedio_prestatario,2,',', '.')}}</td>
   <td class="table-celda-derecha">{{number_format($ingreso_promedio_conyugue,2,',', '.')}}</td>
   <td class="table-celda-derecha">{{number_format($ingreso_promedio_otros,2,',', '.')}}</td>
   <td class="table-celda-derecha">{{number_format($ingreso_promedio_codeudores,2,',', '.')}}</td>
   <td class="table-celda-derecha">{{number_format($ingreso_promedio_total,2,',', '.')}}</td>

 </tr>
</tbody>
</table>
@endif

@if ($if_exist_ventas>0)
<table  style="width:100%"  border="2">
  <thead>
    <tr>
      <th colspan="11" class="table-celda-verde"><h7><strong>VENTAS</strong></h7></th>
    </tr>
    <tr >
     <th class="table-celda-naranja">Producto</th>
     <th class="table-celda-naranja">Venta Diaria Minima</th>
     <th class="table-celda-naranja">Venta Diaria Maxima</th>
     <th class="table-celda-naranja">Venta Semanal Minima</th>
     <th class="table-celda-naranja">Venta Semanal Maxima</th>
     <th class="table-celda-naranja">Venta Mensual Minima</th>
     <th class="table-celda-naranja">Venta Mensual Maxima</th>

   </tr>
 </thead>
 <tbody>
  @foreach ($ventas as $ve )
  <tr>
   <td class="table-celda-centrada">{{$ve->producto}} </td>
   <td class="table-celda-centrada">{{$ve->venta_diaria_min}} </td>
   <td class="table-celda-centrada">{{$ve->venta_diaria_max}} </td>
   <td class="table-celda-centrada">{{$ve->venta_semanal_min}} </td>
   <td class="table-celda-centrada">{{$ve->venta_semanal_max}} </td>
   <td class="table-celda-centrada">{{$ve->venta_mensual_min}} </td>
   <td class="table-celda-centrada">{{$ve->venta_mensual_max}} </td>

 </tr>
 @endforeach
</tbody>
</table>
@endif

@if ($if_exist_comercializacion>0)
<table  style="width:100%"  border="2">
  <thead>
    <tr>
      <th colspan="10" class="table-celda-verde"><h7><strong>VENTA O COMERCIALIZACIÓN DE LOS PRODUCTOS</strong></h7></th>
    </tr>
    <tr >
     <th colspan="2" class="table-celda-naranja">Producto</th>
     <th class="table-celda-naranja">Cantidad</th>
     <th class="table-celda-naranja">Unidad a Medida</th>
     <th class="table-celda-naranja">Compras Costo/Unitario</th>
     <th class="table-celda-naranja">Compras Costo/Total</th>
     <th class="table-celda-naranja">Venta Precio/Unitario</th>
     <th class="table-celda-naranja">Venta Precio/Total</th>
     <th class="table-celda-naranja">Utilidad</th>
     <th class="table-celda-naranja">Porcentaje</th>
   </tr>
 </thead>
 <tbody>
  @foreach ($comercializacion as $comer )
  <tr>
   <td  colspan="2">{{$comer->producto}} </td>
   <td class="table-celda-centrada" >{{$comer->cantidad}} </td>
   <td >{{$comer->unidad_medida}} </td>
   <td class="table-celda-derecha">{{number_format($comer->c_costo_unitario,2,',', '.')}} </td>
   <td class="table-celda-derecha">{{number_format($comer->c_costo_total,2,',', '.')}} </td>
   <td class="table-celda-derecha">{{number_format($comer->v_precio_unitario,2,',', '.')}} </td>
   <td class="table-celda-derecha">{{number_format($comer->v_precio_total,2,',', '.')}} </td>
   <td class="table-celda-derecha">{{number_format($comer->utilidad,2,',', '.')}} </td>
   <td class="table-celda-derecha">{{number_format($comer->porcentaje*100,2,',', '.')}} </td>
 </tr>

 @endforeach
</tbody>
<td colspan="5"><b>TOTALES</b></td>
<td>{{number_format($c_costo_total,2,',', '.')}}</td>
<td></td>
<td>{{number_format($v_precio_total,2,',', '.')}}</td>
<td>{{number_format($u_utilidad,2,',', '.')}}</td>
<td></td>

</table>
@endif

@if ($if_exist_obra>0)
<table  style="width:100%"  border="2">
  <thead>
    <tr>
      <th colspan="8" class="table-celda-verde"><h7><strong>MANO DE OBRA MENSUAL</strong></h7></th>
    </tr>
    <tr >
     <th class="table-celda-naranja">Descripción de los Cargos </th>
     <th class="table-celda-naranja">N° de Personas</th>
     <th class="table-celda-naranja">Sueldo Mensual</th>
     <th colspan="2" class="table-celda-naranja">Total</th>

   </tr>
 </thead>
 <tbody>
  @foreach ($obra as $obra )
  <tr>
   <td >{{$obra->descripcion_cargo}} </td>
   <td >{{$obra->num_personas}} </td>
   <td class="table-celda-derecha">{{number_format($obra->sueldo_mensual,2,',', '.')}} </td>
   <td class="table-celda-derecha">{{number_format($obra->total_mano_obra,2,',', '.')}} </td>

 </tr>
 @endforeach
</tbody>
<td colspan="3"><b>TOTAL MANO DE OBRA:</b></td>
<td class="table-celda-derecha"><b>{{number_format($total_mano_obra,2,',', '.')}}</b></td>
</table>
@endif

@if ($if_exist_familiares>0)
<table  style="width:100%"  border="2">
  <thead>
    <tr>
      <th colspan="14" class="table-celda-verde"><h7><strong>GASTOS FAMILIARES MENSUALES</strong></h7></th>
    </tr>
  </thead>

  <tbody>
    @foreach ($familiares as $fami )
    <tr>
     <th class="table-celda-naranja-izquierda">Alimentación </th>
     <td class="table-celda-derecha">{{number_format($fami->alimentacion,2,',', '.')}} </td>
   </tr>

   <tr>
     <th class="table-celda-naranja-izquierda">Energía Eléctrica</th>
     <td class="table-celda-derecha">{{number_format($fami->energia_electrica,2,',', '.')}} </td>
   </tr>

   <tr>
    <th class="table-celda-naranja-izquierda">Agua</th>
    <td class="table-celda-derecha">{{number_format($fami->agua,2,',', '.')}} </td>
  </tr>

  <tr>
    <th class="table-celda-naranja-izquierda">Teléfono</th>
    <td class="table-celda-derecha">{{number_format($fami->telefono,2,',', '.')}} </td>
  </tr>

  <tr>
   <th class="table-celda-naranja-izquierda">Gas</th>
   <td class="table-celda-derecha">{{number_format($fami->gas,2,',', '.')}} </td>
 </tr>

 <tr>
   <th class="table-celda-naranja-izquierda">Impuestos</th>
   <td class="table-celda-derecha">{{number_format($fami->impuestos,2,',', '.')}} </td>
 </tr>

 <tr>
   <th class="table-celda-naranja-izquierda">Alquileres</th>
   <td class="table-celda-derecha">{{number_format($fami->alquileres,2,',', '.')}} </td>
 </tr>

 <tr>
   <th class="table-celda-naranja-izquierda">Educación</th>
   <td class="table-celda-derecha">{{number_format($fami->educacion,2,',', '.')}} </td>
 </tr>
 <tr>
   <th class="table-celda-naranja-izquierda">Transporte</th>
   <td class="table-celda-derecha">{{number_format($fami->transporte,2,',', '.')}} </td>
 </tr>
 <tr>
   <th class="table-celda-naranja-izquierda">Salud</th>
   <td class="table-celda-derecha">{{number_format($fami->salud,2,',', '.')}} </td>
 </tr>
 <tr>
   <th class="table-celda-naranja-izquierda">Empleada</th>
   <td class="table-celda-derecha">{{number_format($fami->empleada,2,',', '.')}} </td>
 </tr>

 <tr>
   <th class="table-celda-naranja-izquierda">Diversión</th>
   <td class="table-celda-derecha">{{number_format($fami->diversion,2,',', '.')}} </td>
 </tr>
 <tr>
   <th class="table-celda-naranja-izquierda">Vestimenta</th>
   <td class="table-celda-derecha">{{number_format($fami->vestimenta,2,',', '.')}} </td>
 </tr>
 <tr>
   <th class="table-celda-naranja-izquierda">Otros</th>
   <td class="table-celda-derecha">{{number_format($fami->otros,2,',', '.')}} </td>
 </tr>
 <tr>
  <th class="table-celda-verde">Total</th>
  <td class="table-celda-derecha">{{number_format($total_gastos_familiares,2,',', '.')}}</td>
</tr>
@endforeach
@endif


@if ($if_exist_operativos>0)
<table  style="width:100%"  border="2">
  <thead>
    <tr>
      <th colspan="14" class="table-celda-verde"><h7><strong>GASTOS OPERATIVOS O DE COMERCIALIZACIÓN</strong></h7></th>
    </tr>
  </thead>

  <tbody>
    @foreach ($operativos as $ope )
    <tr>
      <th class="table-celda-naranja-izquierda">Combustible</th>
      <td class="table-celda-derecha">{{number_format($ope->combustible,2,',', '.')}} </td>
    </tr>

    <tr>
      <th class="table-celda-naranja-izquierda">Depósito Almacen</th>
      <td class="table-celda-derecha">{{number_format($ope->deposito_almacen,2,',', '.')}} </td>
    </tr>

    <tr>
      <th class="table-celda-naranja-izquierda">Energía Eléctrica</th>
      <td class="table-celda-derecha">{{number_format($ope->energia_electrica,2,',', '.')}} </td>
    </tr>

    <tr>
      <th class="table-celda-naranja-izquierda">Agua</th>
      <td class="table-celda-derecha">{{number_format($ope->agua,2,',', '.')}} </td>
    </tr>

    <tr>
      <th class="table-celda-naranja-izquierda">Gas</th>
      <td class="table-celda-derecha">{{number_format($ope->gas,2,',', '.')}} </td>
    </tr>

    <tr>
      <th class="table-celda-naranja-izquierda">Teléfono</th>
      <td class="table-celda-derecha" colspan="2">{{number_format($ope->telefono,2,',', '.')}} </td>
    </tr>

    <tr>
      <th class="table-celda-naranja-izquierda">Impuestos (Anual del Vehículo)</th>
      <td class="table-celda-derecha">{{number_format($ope->impuestos,2,',', '.')}} </td>
    </tr>

    <tr>
      <th class="table-celda-naranja-izquierda">Impuestos (Anual del SOAD)</th>
      <td class="table-celda-derecha">{{number_format($ope->alquiler,2,',', '.')}} </td>
    </tr>

    <tr>
      <th class="table-celda-naranja-izquierda">Cuidador o Sereno</th>
      <td class="table-celda-derecha">{{number_format($ope->cuidado_sereno,2,',', '.')}} </td>
    </tr>
    <tr>
      <th class="table-celda-naranja-izquierda">Transporte</th>
      <td class="table-celda-derecha">{{number_format($ope->transporte,2,',', '.')}} </td>
    </tr>
    <tr>
      <th class="table-celda-naranja-izquierda">Mantenimiento</th>
      <td class="table-celda-derecha">{{number_format($ope->mantenimiento,2,',', '.')}} </td>
    </tr>
    <tr>
      <th class="table-celda-naranja-izquierda">Publicidad</th>
      <td class="table-celda-derecha">{{number_format($ope->publicidad,2,',', '.')}} </td>
    </tr>
    <tr>
      <th class="table-celda-naranja-izquierda">Otros</th>
      <td class="table-celda-derecha">{{number_format($ope->otros,2,',', '.')}} </td>
    </tr>

    <tr>
      <th class="table-celda-verde">Total</th>
      <td class="table-celda-derecha">{{number_format($total_gastos_operativos,2,',', '.')}}</td>
    </tr>

    @endforeach
  </tbody>
</table>
@endif

<table  style="width:100%"  border="2">
  <tr>
    <td colspan="2" class="table-celda-verde"><b>ANÁLISIS DE LA CAPACIDAD DE PAGO</b></td>
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
   <td class="table-celda-naranja"><b>UTILIDAD OPERATIVA</b></td>
   <td class="table-celda-derecha">{{number_format($utilidad_operativa,2,',', '.')}}</td>

 </tr>

 <tr>
   <td><strong>TIPO DE CRÉDITO</strong> : {{$tipo_credito}} {{$porcentaje_capacidad_pago*100}}%</td>
   <td class="table-celda-derecha">{{$calculo}}</td>
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
   <td>(-) TOTAL EGRESOS</td>
   <td class="table-celda-derecha">{{number_format($total_egresos,2,',', '.')}}</td>

 </tr>

 <tr>
   <td class="table-celda-naranja"><b>(-) MARGEN DE AHORRO</b></td>
   <td class="table-celda-derecha" @if($margen_ahorro>0)bgcolor="lime"}} @else bgcolor="#ff471a" @endif>{{number_format($margen_ahorro,2,',', '.')}}</td>
 </tr>

 <tr>
   <td class="table-celda-naranja"><b>CAPACIDAD DE PAGO:</b></td>
   <td class="table-celda-derecha"  @if($tiene>0)bgcolor="lime"}} @else bgcolor="#ff471a" @endif>{{number_format($tiene,2,',', '.')}} </td>
 </tr>

 <tr>
   <td class="table-celda-naranja"><b>CAPACIDAD DE PAGO:</b></td>
   <td class="table-celda-centrada">{{$resultado_capacidad}} </td>
 </tr>
</table>

<table style="width:100%"  >
  <tr>
    <td class="table-celda-celeste" colspan="3"><strong>AUTORIZACIÓN DE INVESTIGACIÓN</strong></td>
  </tr>
  <tr>
    <td colspan="3"><p ALIGN="justify">YO {{ $personas->first()->ap_paterno.' '.$personas->first()->ap_materno.' '.$personas->first()->nombre}} CON C.I.  {{$personas->first()->ci.' '.$personas->first()->extension}} AUTORIZO DE FORMA EXPRESA A LA COOPERATIVA DE AHORRO Y CRÉDITO SOCIETARIA SAN MARTIN R.L. A INVESTIGAR TODOS LOS ANTECEDENTES PERSONALES, COMERCIALES Y TODOS REQUERIDOS A TRAVÉS DE CUALQUIER MEDIO FÍSICO, MAGNÉTICO, INFORMÁTICO U OTRO, SEA EN ARCHIVOS O BANCO DE DATOS PÚBLICOS O PRIVADOS, A TRAVÉS DE LA CENTRAL DE RIESGOS DE LA AUTORIDAD SE SUPERVISIÓN DEL SISTEMA FINANCIERO (ASFI), BUROS DE INFORMACIÓN CREDITICIA U OTROS, PARA FINES DE LA PRESENTE SOLICITUD Y MIS OPERACIONES ACTIVAS O PASIVAS CON LA COOPERATIVA DE AHORRO Y CRÉDITO SOCIETARIA SAN MARTIN R.L. ASIMISMO, AUTORIZO  A COMPARTIR ESTA INFORMACIÓN CON OTRAS INSTITUCIONES FINANCIERAS SUJETAS O NO A LA LEY 393 DE SERVICIOS FINANCIEROS O BUROS DE INFORMACIÓN CREDITICIA Y LAS DISPOSICIONES LEGALES DE LA UNIDAD DE INVESTIGACIONES FINANCIERAS.
    </p>
    <br>
    @if ($if_exists_conyugue>0)
    <p ALIGN="justify">YO  {{$persona->first()->ap_paterno.' '.$persona->first()->ap_materno.' '.$persona->first()->nombre}} CON C.I.  {{$persona->first()->ci.' '.$persona->first()->extension}}. AUTORIZO DE FORMA EXPRESA A LA COOPERATIVA DE AHORRO Y CRÉDITO SAN MARTIN R.L. A INVESTIGAR TODOS LOS ANTECEDENTES PERSONALES, COMERCIALES Y TODOS LOS REQUERIDOS A TRAVÉS DE CUALQUIER MEDIO FÍSICO, MAGNÉTICO, INFORMÁTICO U OTRO, SEA EN ARCHIVOS O BANCO DE DATOS PÚBLICOS O PRIVADOS, A TRAVÉS DE LA CENTRAL DE RIESGOS DE LA AUTORIDAD SE SUPERVISIÓN DEL SISTEMA FINANCIERO (ASFI), BUROS DE INFORMACIÓN CREDITICIA U OTROS, PARA FINES DE LA PRESENTE SOLICITUD Y MIS OPERACIONES ACTIVAS O PASIVAS CON LA COOPERATIVA SAN MARTIN R.L. ASIMISMO,  AUTORIZO A COMPARTIR ESTA INFORMACIÓN CON OTRAS INSTITUCIONES FINANCIERAS SUJETAS O NO A LA LEY 393 DE SERVICIOS FINANCIEROS O BUROS DE INFORMACIÓN CREDITICIA Y LAS DISPOSICIONES LEGALES DE LA UNIDAD DE INVESTIGACIONES FINANCIERAS.
    </p>
    @endif
    <br>
    <br>
    <br>
  </td>
</tr>

<?php
$v_ap_casada = \sis5cs\Persona::where('id_persona', Session::get('id_persona_codeudor'))->get();
?>

<?php
$existe_conyugue = \sis5cs\Conyugue::where('id_persona', Session::get('id_persona_codeudor'))->count();
if ($existe_conyugue > 0) {
    $id_conyugue = \sis5cs\Conyugue::where('id_persona', Session::get('id_persona_codeudor'))->firstOrFail()->conyugue;
}
?>
<tr>
  <td class="table-celda-centrada">{{ $personas->first()->ap_paterno.' '.$personas->first()->ap_materno.' '.$personas->first()->nombre}}
  @if(!empty($v_ap_casada->first()->ap_casada))
    DE {{$personas->first()->ap_casada}}
    @endif
  </td>
  @if ($if_exists_conyugue>0)
  <td class="table-celda-centrada">{{$persona->first()->ap_paterno.' '.$persona->first()->ap_materno.' '.$persona->first()->nombre}}
  @if(!empty($persona->first()->ap_casada))
   {{'DE '.$persona->first()->ap_casada}}
   @endif
 </td>
 @endif
 <td class="table-celda-centrada">{{Auth::User()->name}}</td>
</tr>
<tr>
  <td class="table-celda-centrada">{{$personas->first()->ci.' '.$personas->first()->extension}}</td>
  @if ($if_exists_conyugue>0)
  <td class="table-celda-centrada">{{$persona->first()->ci.' '.$persona->first()->extension}}</td>
  @endif
  <td class="table-celda-centrada">FIRMA DEL OFICIAL DE CRÉDITO</td>
</tr>
<tr>
  <td class="table-celda-centrada">FIRMA DEL CODEUDOR</td>
  @if ($if_exists_conyugue>0)
  <td class="table-celda-centrada">FIRMA DEL CÓNYUGE</td>
  @endif
  <td class="table-celda-centrada"></td>
</tr>
</table>
<!-- /.box-body -->
@if($if_exist_croquis_direccion)
@push ('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVomCQZTYVQSRGPsG6cQPLsoZqYWdZq0w"></script>
<script type="text/javascript">
  function init_map() {
    var var_location = new google.maps.LatLng({{$croquis_direccion->latitud}},{{$croquis_direccion->longitud}});
    var var_mapoptions = {
      center: var_location,
      zoom: 18
    };

    var var_marker = new google.maps.Marker({
      position: var_location,
      map: var_map,
      title:"Direccion"});

    var var_map = new google.maps.Map(document.getElementById("map-container"),
      var_mapoptions);

    var_marker.setMap(var_map);

  }

  google.maps.event.addDomListener(window, 'load', init_map);
</script>
@endpush
@endif

@if($if_exist_croquis_empresa)
@push ('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVomCQZTYVQSRGPsG6cQPLsoZqYWdZq0w"></script>
<script type="text/javascript">
  function init_map2() {
    var var_location2 = new google.maps.LatLng({{$croquis_empresa->latitud}},{{$croquis_empresa->longitud}});
    var var_mapoptions2 = {
      center: var_location2,
      zoom: 18
    };

    var var_marker2 = new google.maps.Marker({
      position: var_location2,
      map: var_map2,
      title:"Croquis Empresa"});

    var var_map2 = new google.maps.Map(document.getElementById("map-container-empresa"),
      var_mapoptions2);
    var_marker2.setMap(var_map2);
  }
  google.maps.event.addDomListener(window, 'load', init_map2);
</script>
@endpush
@endif

@if($if_exist_croquis_trabajo)
@push ('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVomCQZTYVQSRGPsG6cQPLsoZqYWdZq0w"></script>
<script type="text/javascript">
  function init_map1() {
    var var_location1 = new google.maps.LatLng({{$croquis_trabajo->latitud}},{{$croquis_trabajo->longitud}});
    var var_mapoptions1 = {
      center: var_location1,
      zoom: 18
    };

    var var_marker1 = new google.maps.Marker({
      position: var_location1,
      map: var_map1,
      title:"Direccion"});

    var var_map1 = new google.maps.Map(document.getElementById("map-container-trabajo"),
      var_mapoptions1);

    var_marker1.setMap(var_map1);

  }
  google.maps.event.addDomListener(window, 'load', init_map1);
</script>
@endpush
@endif

@push ('scripts')
<script>
  $('#liCodeudor').addClass("treeview active");
  $('#liCodeudor_sub_datos_imprimir').addClass("active");
</script>
@endpush
@endsection


