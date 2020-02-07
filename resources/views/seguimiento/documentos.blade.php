@extends ('layouts.admin3')
@section ('contenido')

@if(session('notification'))
<div class="alert alert-success">
 {{session('notification')}}
</div>
@endif

<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>CONTROL DE DATOS :</h3>
   <h4>Socio: {{$d_persona->first()->ap_paterno.' '.$d_persona->first()->ap_materno.' '.$d_persona->first()->nombre}}</h4>
 </div>
</div>

<!-- /.box-header -->
<div class="box-body">
  <table id="a_datos_llenados" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Número</th>
       <th>Datos</th>
       <th>Observación</th>
     </tr>
   </thead>
   <tbody>
     <tr>
       <td>1</td>
       <td> Datos Personales</td>
       <td>@if($socio_datos_personales==1) COMPLETADO @else NO COMPLETADO @endif</td>   
     </tr>
     <tr>
      <td>2</td>
      <td>Crédito</td>
      <td>@if($socio_credito==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr>  

    <tr>
      <td>3</td>
      <td>Garantía</td>
      <td>@if($socio_garantia==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr>

    <tr>
      <td>4</td>
      <td>Croquis</td>
      <td>@if($socio_croquis==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr>    

    <tr>
      <td>5</td>
      <td>Datos Empresa</td>
      <td>@if($socio_datos_empresa==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr> 

    <tr>
      <td>6</td>
      <td>Actividad Económica</td>
      <td>@if($socio_actividad_economica==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr> 

    <tr>
      <td>7</td>
      <td>Conyuge</td>
      <td>@if($socio_conyugue==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr>

    <tr>
      <td>8</td>
      <td>Refencia Solicitante</td>
      <td>@if($socio_referencia_solicitante==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr>
    <tr>
      <td>9</td>
      <td>Depósito Bancario</td>
      <td>@if($socio_deposito_bancario==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr>

    <tr>
      <td>10</td>
      <td>Inversiones Financieras</td>
      <td>@if($socio_inversiones_financieras==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr>

    <tr>
      <td>11</td>
      <td>Cuentas Documentos por Cobrar</td>
      <td>@if($socio_cuentas_documentos_cobrar==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr>

    <tr>
      <td>12</td>
      <td>Inventario Mercaderia</td>
      <td>@if($socio_inventario_mercaderia==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr>
    <tr>
      <td>13</td>
      <td>Maquinaria Equipo</td>
      <td>@if($socio_maquinaria_equipo==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr>

    <tr>
      <td>14</td>
      <td>Bienes del Hogar</td>
      <td>@if($socio_bienes_hogar==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr>

    <tr>
      <td>15</td>
      <td>Inmuebles</td>
      <td>@if($socio_inmuebles==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr>

    <tr>
      <td>16</td>
      <td>Vehículos</td>
      <td>@if($socio_vehiculos==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr>

    <tr>
      <td>17</td>
      <td>Efectivos en Caja</td>
      <td>@if($socio_efectivos_caja==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr>

    <tr>
      <td>18</td>
      <td>Otros Activos</td>
      <td>@if($socio_otros_activos==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr>


    <tr>
      <td>19</td>
      <td>Prestamos Bancarios</td>
      <td>@if($socio_prestamos_bancarios==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr>

    <tr>
      <td>20</td>
      <td>Cuentas por Pagar</td>
      <td>@if($socio_cuentas_pagar==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr>

    <tr>
      <td>21</td>
      <td>Gastos Familiares</td>
      <td>@if($socio_gastos_familiares==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr>
    <tr>
      <td>22</td>
      <td>Gastos Operativos</td>
      <td>@if($socio_gastos_familiares==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr>

    <tr>
      <td>23</td>
      <td>Mano de Obra</td>
      <td>@if($socio_mano_obra==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr>

    <tr>
      <td>24</td>
      <td>Ingreso Mensual</td>
      <td>@if($socio_ingreso_mensual==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr>

    <tr>
      <td>25</td>
      <td>Venta Comercialización Productos</td>
      <td>@if($socio_venta_comercializacion==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr>

    <tr>
      <td>26</td>
      <td>Garante 1</td>
      <td>@if($socio_garante1==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr>

    <tr>
      <td>27</td>
      <td>Garante 2</td>
      <td>@if($socio_garante2==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr>

    <tr>
      <td>28</td>
      <td>Garante 3</td>
      <td>@if($socio_garante3==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr>

    <tr>
      <td>29</td>
      <td>Codeudor 1</td>
      <td>@if($socio_codeudor1==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr>

    <tr>
      <td>30</td>
      <td>Codeudor 2</td>
      <td>@if($socio_codeudor2==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr>

    <tr>
      <td>31</td>
      <td>Codeudor 3</td>
      <td>@if($socio_codeudor3==1) COMPLETADO @else NO COMPLETADO @endif</td>
    </tr>
  
  </tbody>
</table>

@include('sweetalert::alert')
@push ('scripts')
<script>
  $('#aLi_seguimiento').addClass("treeview active");
  $('#aLi_seguimiento_sub').addClass("active");
</script>
@endpush
@endsection
