<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sis5s</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{asset('/admin2/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- select min -->
  <link rel="stylesheet" href="{{asset('/admin2/dist/css/bootstrap-select.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/admin2/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('/admin2/bower_components/Ionicons/css/ionicons.min.css')}}">
  {{-- favicon--}}
  <link rel="shortcut icon" href="{{ asset('img/logo2.png')}}"> 
  {{-- dataTables --}}
  <link rel="stylesheet" href="{{asset('/admin2/datatables/datatables.min.css')}}">
  {{-- estilos personalizados--}}
  <link rel="stylesheet" href="{{asset('/admin2/dist/css/mis_estilos.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/admin2/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
        <link rel="stylesheet" href="{{asset('/admin2/dist/css/skins/skin-green.min.css')}}">
        {{-- Sweet alert--}}
        <script src="{{ asset('/admin2/dist/js/sweetalert.min.js') }}"></script>
        {{-- SweetAlert2 --}}

       <!-- <script src="{{ asset('/ajax/sweetalert2/sweetalert2.min.js') }}"></script>
       -->
       <link href="{{ asset('/ajax/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">

       {{-- mapas --}}


       <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
       <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet"
href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-green sidebar-mini">
  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>SIS</b>5CS</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Sis5cs</b></span>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            <!-- /.messages-menu -->
            <!--SOLO PARA ARMINISTRADOR-->
            @if(Auth::User()->id_rol==1)
            <li class="dropdown notifications-menu">
              <a href="{{url('/notifications/')}}" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>              

                <?php              
                $cred = DB::table('credito')
                ->join('persona', 'credito.id_persona', '=', 'persona.id_persona')
                ->select('credito.id_credito','credito.monto_solicitado','credito.id_tcredito','credito.desembolsado','persona.*')
                ->where('desembolsado','=',null)
                ->get();
                $c_contador=0;
                foreach($cred as $c)
                {
                  if((\Carbon\Carbon::parse($c->created_at))->diffInDays(\Carbon\Carbon::parse(\Carbon\Carbon::now()))>limite($c->id_tcredito))
                    {
                     $c_contador++;
                   }
                 }            
                 ?>
                 @if($c_contador)
                 <span class="label label-warning">{{$c_contador}}</span>
                 @endif
               </a>
             </li>
             @endif

             <?php
             function limite($a)
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
    <!--SOLO PARA ARMINISTRADOR FIN-->
    <!-- Notifications Menu -->
    @if(Auth::User()->id_rol!=1)
    <li class="dropdown notifications-menu">
      <a href="{{url('/notifications/')}}" >
        <i class="fa fa-bell-o"></i>
        @if($count=Auth::User()->unreadNotifications->count())
        <span class="label label-warning">{{$count}}</span>
        @endif
      </a>
    </li>
    @endif
    <!-- Tasks Menu -->
    <!-- Menu Toggle Button -->
    <!-- User Account Menu -->
    <li class="dropdown user user-menu">
      <!-- Menu Toggle Button -->
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <!-- The user image in the navbar-->
        @if(Auth::user()->imagen==null)
        <img src="{{asset('admin2/dist/img/user2-160x160.jpeg')}}" class="user-image" alt="User Image">

        @else
        <img src="{{asset('images/usersperfils/'.Auth::user()->imagen)}}" class="user-image" alt="User Image">
        @endif

        <!-- hidden-xs hides the username on small devices so only the image appears. -->
        <span class="hidden-xs">{{Auth::user()->name }} - <?php rol();?></span>
      </a>
      <ul class="dropdown-menu">
        <!-- The user image in the menu -->
        <li class="user-header">
         @if(Auth::user()->imagen==null)
         <img src="{{asset('admin2/dist/img/user2-160x160.jpeg')}}" class="user-image" alt="User Image">

         @else
         <img src="{{asset('images/usersperfils/'.Auth::user()->imagen)}}" class="user-image" alt="User Image">
         @endif
         <p>
          {{Auth::user()->name}}-<?php rol();?>
          <?php
          function rol()
          {
            $ca = Auth::user()->id_rol;
            if ($ca == 1) {
              echo "Administrador";
            }
            if ($ca == 2) {
              echo "Jefe de Créditos";
            }
            if ($ca == 3) {
              echo "Oficial de créditos";
            }
            if ($ca == 4) {
              echo "Plataforma";
            }
            if ($ca == 5) {
              echo "Cliente";
            }
            if ($ca == 6) {
              echo "Riesgos";
            }
            if ($ca == 7) {
              echo "Asesoria";
            }
            if ($ca == 8) {
              echo "Comite de Crédito";
            }
          }
          ?>
          <small>Cooperativa De Ahorro y Crédito "San Martín"</small>
        </p>
      </li>
      <!-- Menu Body -->
      <!-- Menu Footer-->
      <li class="user-footer">
        <div class="pull-left">
          <a href="#" class="btn btn-default btn-flat">Perfil</a>
        </div>
        <div class="pull-right">
          <a href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          Cerrar sesión
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
      </div>
    </li>
  </ul>
</li>
<!-- Control Sidebar Toggle Button -->

</ul>
</div>
</nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
       @if(Auth::user()->imagen==null)
       <img src="{{asset('admin2/dist/img/user2-160x160.jpeg')}}" class="user-image" alt="User Image">

       @else

       <img src="{{asset('images/usersperfils/'.Auth::user()->imagen)}}" class="user-image" alt="User Image">

       @endif
     </div>
     <div class="pull-left info">
      <p>BIENVENIDO</p>
      <!-- Status -->
      <a href="#"><i class="fa fa-circle text-success"></i>{{Auth::user()->name}}</a>
    </div>
  </div>

  <!-- search form (Optional) -->

  <!-- /.search form -->

  @if (Auth::user()->id_rol==1)
  <!-- Sidebar Menu -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">NAVEGACIÓN</li>
    <!-- Optionally, you can add icons to the links -->
    <li id="liEscritorio">
      <a href="{{url('home/home')}}">
        <i class="fa fa-dashboard "></i> <span>Escritorio</span>
      </a>
    </li>


    <li id="aLi_seguimiento" class="treeview">
      <a href="#">
        <i class="fa fa-eye text-green"></i>
        <span>Seguimiento</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li id="aLi_seguimiento_sub"><a href="{{url('seguimiento')}}"><i class="fa fa-align-left text-yellow"></i>Seguimiento</a></li>
      </ul>
    </li>

    <li id="liAdmin" class="treeview">
      <a href="#">
        <i class="fa fa-gear text-yellow "></i> <span>Gestión de datos socios</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li id="liAdmin_seleccionar"><a href="{{url('seleccionar')}}"><i class="fa fa-thumbs-up text-orange"></i>Seleccionar Socio</a></li>
        
        <li id="liAdmin_persona"><a href="{{url('persona')}}"><i class="@if(\sis5cs\Persona::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Persona</a></li>        
        
        <li id="liAdmin_conyugue"><a href="{{url('/conyugue/create')}}"><i class="@if(\sis5cs\Conyugue::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Registrar Conyugue</a></li>
        <?php
        $existe_conyugue = \sis5cs\Conyugue::where('id_persona', Session::get('id_persona'))->count();
        if($existe_conyugue>0)
        {
          $id_conyugue=\sis5cs\Conyugue::where('id_persona', Session::get('id_persona'))->firstOrFail()->conyugue;
        }
        else
        {
          $id_conyugue=null;
        }
        ?>
        <?php

        if ($n_cre = \sis5cs\Credito::where('id_persona', Session::get('id_persona'))->exists()) {
          $n_cre = \sis5cs\Credito::where('id_persona', Session::get('id_persona'))->firstOrFail()->id_credito;
        } else {
          $n_cre = null;
        }
        ?>
        <li id="liAdmin_detalle_conyugue"><a href="{{url('/detalle_conyugue/create')}}"><i class="@if(\sis5cs\DetallePersona::where('id_persona',$id_conyugue)->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Detalle Conyugue</a></li>
        <li id="liAdmin_credito"><a href="{{url('credito')}}"><i class="@if(\sis5cs\Credito::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif "></i>Credito</a></li>
        <li id="liAdmin_direccion"><a href="{{url('direccion')}}"><i class="@if(\sis5cs\Direccion::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif "></i>Dirección</a></li>
        <li id="liAdmin_croquis"><a href="{{url('croquis')}}"><i class="@if(\sis5cs\Croquis::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif "></i>Croquis</a></li>
        <li id="liAdmin_garantia"><a href="{{url('garantias')}}"><i class="@if(\sis5cs\Garantia::where('id_credito',$n_cre)->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif "></i>Garantia</a></li>
        <li id="liAdmin_actividad_economica"><a href="{{url('actividad_economica')}}"><i class="@if(\sis5cs\ActividadEconomica::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Actividad Económica</a></li>
        <li id="liAdmin_datos_empresa"><a href="{{url('datos_empresa')}}"><i class="@if(\sis5cs\DatosEmpresa::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif "></i>Datos Empresa</a></li>

        <li id="liAdmin_referencias"><a href="{{url('/referencias_solicitante/')}}"><i class="@if(\sis5cs\ReferenciaSolicitante::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Referencias Solicitante</a></li>

        <li id="liAdmin_reporte"><a href="{{url('/reporte_buro/')}}"><i class="@if(\sis5cs\ReporteBuro::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Reporte Buro</a></li>  

        <li id="liAdmin_deposito"><a href="{{url('/deposito_bancario/')}}"><i class="@if(\sis5cs\DepositoBancario::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Deposito Bancario</a></li>

        <li id="liAdmin_bienes_hogar"><a href="{{url('bienes_hogar')}}"><i class="@if(\sis5cs\BienesHogar::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Bienes del Hogar</a></li>

        <li id="liAdmin_inversiones"><a href="{{url('/inversiones_financieras/')}}"><i class="@if(\sis5cs\InversionesFinancieras::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Inversiones Financieras</a></li>

        <li id="liAdmin_cuentas_documentos"><a href="{{url('/cuentas_documentos_cobrar/')}}"><i class="@if(\sis5cs\CuentasDocumentosCobrar::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Cuentas Documentos por Cobrar</a></li>

        <li id="liAdmin_inventario_mercaderia"><a href="{{url('/inventario_mercaderia/')}}"><i class="@if(\sis5cs\InventarioMercaderia::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Inventario de Mercaderia</a></li>

        <li id="liAdmin_maquinaria"><a href="{{url('/maquinaria_equipo/')}}"><i class="@if(\sis5cs\MaquinariaEquipo::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Maquinaria Equipo</a></li>

        <li id="liAdmin_inmuebles"><a href="{{url('/inmueble/')}}"><i class="@if(\sis5cs\Inmueble::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Inmuebles</a></li>

        <li id="liAdmin_vehiculos"><a href="{{url('/vehiculo/')}}"><i class="@if(\sis5cs\Vehiculo::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Vehiculos</a></li>

        <li id="liAdmin_efectivo_caja"><a href="{{url('/efectivos_caja/create')}}"><i class="@if(\sis5cs\EfectivoCaja::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Efectivos en Caja</a></li>

        <li id="liAdmin_otros_activos"><a href="{{url('/otros_activos/')}}"><i class="@if(\sis5cs\OtroActivo::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Otros Activos</a></li>

        <li id="liAdmin_prestamo"><a href="{{url('/prestamo_bancario/')}}"><i class="@if(\sis5cs\PrestamoBancario::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Prestamos Bancarios</a></li>

        <li id="liAdmin_cuentas_pagar"><a href="{{url('/cuentas_por_pagar/')}}"><i class="@if(\sis5cs\CuentasPorPagar::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Cuentas Por Pagar</a></li>


        <li id="liAdmin_gastos_familiares"><a href="{{url('/gastos_familiares/create')}}"><i class="@if(\sis5cs\GastosFamiliares::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Gastos Familiares</a></li>

        <li id="liAdmin_gastos_operativos"><a href="{{url('/gastos_operativos/create')}}"><i class="@if(\sis5cs\GastosOperativosComercializacion::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Gastos Operativos</a></li>

        <li id="liAdmin_mano_obra"><a href="{{url('/mano_obra/create')}}"><i class="@if(\sis5cs\ManoObraMensual::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Mano Obra</a></li>

        <li id="liAdmin_capacidad_pago"><a href="{{url('capacidad_pago')}}"><i class="@if(\sis5cs\CapacidadPago::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Amortización Coop. San Martín</a></li>

        <li id="liAdmin_ingreso"><a href="{{url('/ingreso_mensual/create')}}"><i class="@if(\sis5cs\IngresoMensual::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Ingreso Mensual</a></li>

        <li id="liAdmin_venta_comercializacion"><a href="{{url('/venta_comercializacion_producto/')}}"><i class="@if(\sis5cs\VentaComercializacionProducto::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Venta Comercialización Producto</a></li>
        
      </ul>
    </li>

    <li id="liAdmin_sistema" class="treeview">
      <a href="#">
        <i class="fa fa-gear text-yellow "></i> <span>Gestión del Sistema</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li id="liAdmin_sistema_afp"><a href="{{url('afp')}}"><i class="fa fa-pencil"></i>Afp</a></li>
        <li id="liAdmin_sistema_entidad"><a href="{{url('entidad_bancaria')}}"><i class="fa fa-pencil"></i>Entidad Bancaria</a></li>
        <li id="liAdmin_sistema_profesion"><a href="{{url('profesion')}}"><i class="fa fa-pencil"></i>Profesión</a></li>
        <li id="liAdmin_sistema_nacionalidad"><a href="{{url('nacionalidad')}}"><i class="fa fa-pencil"></i>Nacionalidad</a></li>
      </ul>
    </li>

    <li class="treeview">
      <a href="#">
        <i class="fa fa-user "></i> <span>Gestión de accesos</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{url('user/crud')}}"><i class="fa fa-circle-o"></i>Usuarios</a>
        </li>
      </ul>
    </li>

    <li class="treeview">
      <a href="#">
        <i class="fa fa-eye "></i> <span>Pistas de auditoria</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{url('auditoria')}}"><i class="fa fa-eye"></i>Auditoria</a>
        </li>
      </ul>
    </li>

  </ul>
  <!-- /.sidebar-menu -->
  @endif

  @if ( Auth::user()->id_rol==2 )

  <ul class="sidebar-menu" data-widget="tree">

    <li class="header">Navegación</li>
    <!-- Optionally, you can add icons to the links -->
    <!-- seleccionar id persona-->

    <li><a href="{{url('/jefecredito/seleccionar/')}}"><i class="fa fa-circle-o text-red"></i> <span>Seleccionar Socio</span></a></li>
    <li><a href="{{url('/jefecredito/seleccionar_credito/')}}"><i class="fa fa-circle-o text-red"></i> <span>Seleccionar Crédito</span></a></li>
    <li id="liJefe_marcar"><a href="{{url('/jefecredito/marcar_credito/')}}"><i class="fa fa-check text-lime"></i> <span>Marcar - Crédito - Desembolsado</span></a></li>

   <!--
  <li class="treeview">
    <a href="#">
      <i class=" fa fa-pencil-square" aria-hidden="true"></i>
      <span>Generar informe</span>
      <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{url('/jefecredito/cartera/')}}"><i class="fa fa-pencil"></i>Generar informe</a></li>
    </ul>
  </li>
-->

<!--Perfil de usuario plataforma menú-->
<li class="treeview">
  <a href="#">
    <i class=" fa fa-users text-yellow" aria-hidden="true"></i>
    <span>Perfil</span>
    <i class="fa fa-angle-left pull-right"></i>
  </a>
  <ul class="treeview-menu">
   <li><a href="{{url('/jefecredito/user/')}}"><i class="fa fa-user text-yellow"></i> <span>Gestionar Perfil Usuario</span></a></li>
   <li><a href="{{url('/jefecredito/user/edit_photo')}}"><i class="fa fa-user text-yellow"></i> <span>Cambiar Foto de Perfil</span></a></li>
 </ul>
</li>

<li><a href="{{url('/jefecredito/seguimiento/create')}}"><i class="fa fa-eye text-yellow"></i> <span>Seguimiento</span></a></li>

<!-- End menú perfil-->

</ul>
@endif

@if ( Auth::user()->id_rol==3 )
<!-- Sidebar Menu -->
<ul class="sidebar-menu" data-widget="tree">
  <li class="header">Navegación</li>
  <!-- Optionally, you can add icons to the links -->
  <!-- seleccionar id persona-->
  <li><a href="{{url('/oficial/seleccionar/')}}"><i class="fa fa-circle-o text-red"></i> <span>Seleccionar Socio</span></a></li>
  <li><a href="{{url('/oficial/seleccionar_credito/')}}"><i class="fa fa-circle-o text-red"></i> <span>Seleccionar Socio-Crédito</span></a></li>
  <!-- C1 -->
  <li id="liC1" class="treeview">
    <a href="#">
      <i class=" fa fa-pencil-square" aria-hidden="true"></i>
      <span>Llenar datos C1</span>
      <i class="fa fa-angle-left pull-right"></i>
    </a>

    <ul class="treeview-menu">
      <li id="liPersona"><a href="{{url('/oficial/persona/')}}"><i class="@if(\sis5cs\Persona::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif "></i>Personas</a></li>
      <li id="liCredito"><a href="{{url('/oficial/credito/')}}"><i class="@if(\sis5cs\Credito::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Crédito</a></li>
      <?php
      $existe_credito_1 = \sis5cs\Credito::where('id_persona', Session::get('id_persona'))->count();
      if($existe_credito_1>0)
      {
        $id_credito_1=\sis5cs\Credito::where('id_persona', Session::get('id_persona'))->firstOrFail()->id_credito;
      }
      else
      {
        $id_credito_1=null;
      }
      ?>

      <?php

      if ($n_cre = \sis5cs\Credito::where('id_persona', Session::get('id_persona'))->exists()) {
        $n_cre = \sis5cs\Credito::where('id_persona', Session::get('id_persona'))->firstOrFail()->id_credito;
      } else {
        $n_cre = null;
      }
      ?>
      <li id="liTipoCambio"><a href="{{url('/oficial/tipo_cambio/create')}}"><i class="@if(\sis5cs\TipoCambio::where('id_credito',$id_credito_1)->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Tipo Cambio ($us)</a></li>
      <li id="liGarantia"><a href="{{url('/oficial/garantias/')}}"><i class="@if(\sis5cs\Garantia::where('id_credito',$n_cre)->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Garantia</a></li>
      <li id="liDireccion"><a href="{{url('/oficial/direccion/create')}}"><i class="@if(\sis5cs\Direccion::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Dirección</a></li>
      <li id="liCroquis"><a href="{{url('/oficial/croquis/')}}"><i class="@if(\sis5cs\Croquis::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Croquis</a></li>
      <li id="liDatosEmpresa"><a href="{{url('/oficial/datos_empresa/')}}"><i class="@if(\sis5cs\DatosEmpresa::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Datos Empresa</a></li>
      <li id="liActividadEconomica"><a href="{{url('/oficial/actividad_economica/')}}"><i class="@if(\sis5cs\ActividadEconomica::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Actividad Economica</a></li>
      <li id="liConyugue"><a href="{{url('/oficial/conyugue/create')}}"><i class="@if(\sis5cs\Conyugue::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Registrar Conyugue</a></li>
      <?php
      $existe_conyugue = \sis5cs\Conyugue::where('id_persona', Session::get('id_persona'))->count();
      if($existe_conyugue>0)
      {
        $id_conyugue=\sis5cs\Conyugue::where('id_persona', Session::get('id_persona'))->firstOrFail()->conyugue;
      }
      else
      {
        $id_conyugue=null;
      }
      ?>
      <li id="liDetalleConyugue"><a href="{{url('/oficial/detalle_conyugue/create')}}"><i class="@if(\sis5cs\DetallePersona::where('id_persona',$id_conyugue)->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Detalle Conyugue</a></li>
      
      <li id="liReferencia"><a href="{{url('/oficial/referencias_solicitante/')}}"><i class="@if(\sis5cs\ReferenciaSolicitante::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Referencias Solicitante</a></li>      
      <li id="liReporteBuro"><a href="{{url('/oficial/reporte_buro/')}}"><i class="@if(\sis5cs\ReporteBuro::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Reporte Buro</a></li>
    </ul>
  </li>
  <!-- C2 -->
  <li id="liC2" class="treeview">
    <a href="#">
      <i class=" fa fa-pencil-square" aria-hidden="true"></i>
      <span>Llenar datos C2</span>
      <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      <li id="liDeposito"><a href="{{url('/oficial/deposito_bancario/')}}"><i class="@if(\sis5cs\DepositoBancario::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Deposito Bancario</a></li>
      <li id="liInversionesFinancieras"><a href="{{url('/oficial/inversiones_financieras/')}}"><i class="@if(\sis5cs\InversionesFinancieras::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Inversiones Financieras</a></li>
      <li id="liCuentasDocumentosCobrar"><a href="{{url('/oficial/cuentas_documentos_cobrar/')}}"><i class="@if(\sis5cs\CuentasDocumentosCobrar::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Cuentas Documentos por Cobrar</a></li>
      <li id="liInventarioMercaderia"><a href="{{url('/oficial/inventario_mercaderia/')}}"><i class="@if(\sis5cs\InventarioMercaderia::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Inventario de Mercaderia</a></li>
      <li id="liMaquinariaEquipo"><a href="{{url('/oficial/maquinaria_equipo/')}}"><i class="@if(\sis5cs\MaquinariaEquipo::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Maquinaria Equipo</a></li>
      <li id="liBienesHogar"><a href="{{url('/oficial/bienes_hogar/')}}"><i class="@if(\sis5cs\BienesHogar::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Bienes del Hogar</a></li>
      <li id="liInmueble"><a href="{{url('/oficial/inmueble/')}}"><i class="@if(\sis5cs\Inmueble::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Inmuebles</a></li>
      <li id="liVehiculo"><a href="{{url('/oficial/vehiculo/')}}"><i class="@if(\sis5cs\Vehiculo::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Vehiculos</a></li>

      <li id="liEfectivosCaja"><a href="{{url('/oficial/efectivos_caja/create')}}"><i class="@if(\sis5cs\EfectivoCaja::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Efectivos en Caja</a></li>
      <li id="liOtrosActivos"><a href="{{url('/oficial/otros_activos/')}}"><i class="@if(\sis5cs\OtroActivo::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Otros Activos</a></li>
    </ul>
  </li>
  <!-- C3 -->
  <li id="liC3" class="treeview">
    <a href="#">
      <i class=" fa fa-pencil-square" aria-hidden="true"></i>
      <span>Llenar datos C3</span>
      <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      <li id="liPrestamoBancario"><a href="{{url('/oficial/prestamo_bancario/')}}"><i class="@if(\sis5cs\PrestamoBancario::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Prestamos Bancarios</a></li>
      <li id="liCuentasPagar"><a href="{{url('/oficial/cuentas_por_pagar/')}}"><i class="@if(\sis5cs\CuentasPorPagar::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Cuentas Por Pagar</a></li>
      <li id="liGastosFamiliares"><a href="{{url('/oficial/gastos_familiares/create')}}"><i class="@if(\sis5cs\GastosFamiliares::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Gastos Familiares</a></li>
      <li id="liGastosOperativos"><a href="{{url('/oficial/gastos_operativos/create')}}"><i class="@if(\sis5cs\GastosOperativosComercializacion::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Gastos Operativos</a></li>
      <li id="liManoObra"><a href="{{url('/oficial/mano_obra/create')}}"><i class="@if(\sis5cs\ManoObraMensual::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Mano Obra</a></li>
      <li id="liIngresoMensual"><a href="{{url('/oficial/ingreso_mensual/create')}}"><i class="@if(\sis5cs\IngresoMensual::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Ingreso Mensual</a></li>
      <li ><a href="{{url('/oficial/venta_comercializacion_producto/')}}"><i class="@if(\sis5cs\VentaComercializacionProducto::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Venta Comercialización Producto</a></li>
      <li id="liAmortizacionCoop"><a href="{{url('/oficial/capacidad_pago/create')}}"><i class="@if(\sis5cs\CapacidadPago::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Amortizacion Coop. San Martín</a></li>
    </ul>
  </li>

  <li id="liGarantiaHipotecaria"><a href="{{url('/oficial/garantia_hipotecaria/')}}"><i class="fa fa-automobile"></i> <span>Registrar Garantias</span></a></li>

  <li id="liImprimir" class="treeview">
    <a href="#">
      <i class=" fa fa-print" aria-hidden="true"></i>
      <span>Imp. Formulario Solicitante</span>
      <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
     <li id="liImprimirDatos"><a href="{{url('/oficial/formulario/')}}"><i class="fa fa-print text-aqua"></i>Datos Solicitante</a></li>
     <li id="liImprimirSolicitud"><a href="{{url('/oficial/solicitud/')}}"><i class="fa fa-print"></i>Solicitud de crédito</a></li>
     <li id="liImprimirCaratulas"><a href="{{url('/oficial/caratulas/')}}"><i class="fa fa-print"></i>Imprimir Carátulas</a></li>
     <li id="liImprimirDocumentos"><a href="{{url('/oficial/control_documentos/')}}"><i class="fa fa-print"></i>Control documentos</a></li>
     <li id="liImprimirInforme"><a href="{{url('/oficial/informe_credito/')}}"><i class="fa fa-print text-lime"></i>Informe de Crédito</a></li>
   </ul>
 </li>
 <li id="liInformacion" class="treeview">
  <a href="#">
    <i class=" fa fa-eye text-yellow" aria-hidden="true"></i>
    <span>Capacidad Pago-Estado Sit.</span>
    <i class="fa fa-angle-left pull-right"></i>
  </a>
  <ul class="treeview-menu">
   <li id="liSituacionPersonal"><a href="{{url('/oficial/situacion_personal/')}}"><i class="fa fa-eye"></i>Estado de situación personal</a></li>
   <li id="liAnalisisCapacidad"><a href="{{url('/oficial/analisis_capacidad_pago/')}}"><i class="fa fa-eye"></i>Analisis Capacidad Pago</a></li>
 </ul>
</li>

<li><a href="{{url('/oficial/scor/scor/')}}"><i class="fa fa-cog fa-spin fa-fw text-yellow"></i> <span>Scoring</span></a></li>
<!-- Manejo de archivos-->
<li id="liArchivos" class="treeview">
  <a href="#">
    <i class=" fa fa-pencil-square" aria-hidden="true"></i>
    <span>Archivos</span>
    <i class="fa fa-angle-left pull-right"></i>
  </a>
  <ul class="treeview-menu">
    <li id="liFotos"><a href="{{url('/oficial/foto/')}}"><i class="fa fa-pencil"></i>Gestionar fotografias</a></li>
    <li id="liArchivo"><a href="{{url('/oficial/archivo/')}}"><i class="fa fa-pencil"></i>Gestionar Archivos</a></li>
  </ul>
</li>
<!-- C4 -->
<!-- C5 -->
<li id="liCodeudor" class="treeview">
  <a href="#">
    <i class=" fa fa-street-view text-green" aria-hidden="true"></i>
    <span>Gestionar Codeudores</span>
    <i class="fa fa-angle-left pull-right"></i>
  </a>
  <ul class="treeview-menu">
    <li id="liCodeudor_sub_codeudor"><a href="{{url('/oficial/codeudor/')}}"><i class="fa fa-pencil"></i>Selecionar codeudor</a></li>

    <li id="liCodeudor_asignar"><a href="{{url('/oficial/a_codeudores/asignar_codeudor')}}"><i class="fa fa-user-plus text-aqua"></i>Asignar Codeudor (Existente)</a></li>

    <li id="liCodeudor_sub_direccion"><a href="{{url('/oficial/a_codeudores/direccion/create')}}"><i class="@if(\sis5cs\Direccion::where('id_persona',Session::get('id_persona_codeudor'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i> Dirección</a></li>
    <li id="liCodeudor_sub_croquis"><a href="{{url('/oficial/a_codeudores/croquis/')}}"><i class="@if(\sis5cs\Croquis::where('id_persona',Session::get('id_persona_codeudor'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Croquis</a></li>
    <li id="liCodeudor_sub_conyugue"><a href="{{url('/oficial/a_codeudores/conyugue/create')}}"><i class="@if(\sis5cs\Conyugue::where('id_persona',Session::get('id_persona_codeudor'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Registrar Conyugue</a></li>
    <?php
    $existe_conyugue_codeudor = \sis5cs\Conyugue::where('id_persona', Session::get('id_persona_codeudor'))->count();
    if($existe_conyugue_codeudor>0)
    {
      $id_conyugue_codeudor=\sis5cs\Conyugue::where('id_persona', Session::get('id_persona_codeudor'))->firstOrFail()->conyugue;
    }
    else
    {
      $id_conyugue_codeudor=null;
    }
    ?>
    <li id="liCodeudor_sub_detalle"><a href="{{url('/oficial/a_codeudores/detalle_conyugue/create')}}"><i class="@if(\sis5cs\DetallePersona::where('id_persona',$id_conyugue_codeudor)->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Detalle Conyugue</a></li>
    <li id="liCodeudor_sub_empresa"><a href="{{url('/oficial/a_codeudores/datos_empresa/create')}}"><i class="@if(\sis5cs\DatosEmpresa::where('id_persona',Session::get('id_persona_codeudor'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i> Datos Empresa</a></li>
    <li id="liCodeudor_sub_actividad"><a href="{{url('/oficial/a_codeudores/actividad_economica/create')}}"><i class="@if(\sis5cs\ActividadEconomica::where('id_persona',Session::get('id_persona_codeudor'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Actividad Economica</a></li>
    <li id="liCodeudor_sub_referencias"><a href="{{url('/oficial/a_codeudores/referencias_solicitante/create')}}"><i class="@if(\sis5cs\ReferenciaSolicitante::where('id_persona',Session::get('id_persona_codeudor'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Referencias Codeudor</a></li>
    <li id="liCodeudor_sub_inversion"><a href="{{url('/oficial/a_codeudores/inversiones_financieras/create')}}"><i class="@if(\sis5cs\InversionesFinancieras::where('id_persona',Session::get('id_persona_codeudor'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Inversión Financiera</a></li>
    <li id="liCodeudor_sub_depositos_bancarios"><a href="{{url('/oficial/a_codeudores/deposito_bancario/create')}}"><i class="@if(\sis5cs\DepositoBancario::where('id_persona',Session::get('id_persona_codeudor'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Depositos Bancarios</a></li>
    <li id="liCodeudor_sub_cuenta_documento"><a href="{{url('/oficial/a_codeudores/cuentas_documentos_cobrar/create')}}"><i class="@if(\sis5cs\CuentasDocumentosCobrar::where('id_persona',Session::get('id_persona_codeudor'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Cuentas Documentos Cobrar</a></li>
    <li id="liCodeudor_sub_inventario"><a href="{{url('/oficial/a_codeudores/inventario_mercaderia/create')}}"><i class="@if(\sis5cs\InventarioMercaderia::where('id_persona',Session::get('id_persona_codeudor'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Inventario Mercadería</a></li>
    <li id="liCodeudor_sub_maquinaria"><a href="{{url('/oficial/a_codeudores/maquinaria_equipo/create')}}"><i class="@if(\sis5cs\MaquinariaEquipo::where('id_persona',Session::get('id_persona_codeudor'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Maquinaria Equipo</a></li>
    <li id="liCodeudor_sub_inmueble"><a href="{{url('/oficial/a_codeudores/inmueble/')}}"><i class="@if(\sis5cs\Inmueble::where('id_persona',Session::get('id_persona_codeudor'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Inmueble</a></li>
    <li id="liCodeudor_sub_vehiculo"><a href="{{url('/oficial/a_codeudores/vehiculo/')}}"><i class="@if(\sis5cs\Vehiculo::where('id_persona',Session::get('id_persona_codeudor'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Vehículo</a></li>
    <li id="liCodeudor_sub_otros_activos"><a href="{{url('/oficial/a_codeudores/otros_activos/')}}"><i class="@if(\sis5cs\OtroActivo::where('id_persona',Session::get('id_persona_codeudor'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Otros Activos</a></li>
    <li id="liCodeudor_sub_prestamo"><a href="{{url('/oficial/a_codeudores/prestamo_bancario/')}}"><i class="@if(\sis5cs\PrestamoBancario::where('id_persona',Session::get('id_persona_codeudor'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Prestamo Bancario</a></li>
    <li id="liCodeudor_sub_cuentas_pagar"><a href="{{url('/oficial/a_codeudores/cuentas_por_pagar/')}}"><i class="@if(\sis5cs\CuentasPorPagar::where('id_persona',Session::get('id_persona_codeudor'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Cuentas por Pagar</a></li>
    
    <li id="liCodeudor_sub_mano_obra"><a href="{{url('/oficial/a_codeudores/mano_obra/')}}"><i class="@if(\sis5cs\ManoObraMensual::where('id_persona',Session::get('id_persona_codeudor'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Mano de Obra</a></li>
    <li id="liCodeudor_sub_gastos_familiares"><a href="{{url('/oficial/a_codeudores/gastos_familiares/create')}}"><i class="@if(\sis5cs\GastosFamiliares::where('id_persona',Session::get('id_persona_codeudor'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Gastos Familiares</a></li>
    <li id="liCodeudor_sub_gastos_operativos"><a href="{{url('/oficial/a_codeudores/gastos_operativos/create')}}"><i class="@if(\sis5cs\GastosOperativosComercializacion::where('id_persona',Session::get('id_persona_codeudor'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Gastos Operativos</a></li>  
    <li id="liCodeudor_sub_efectivo_caja"><a href="{{url('/oficial/a_codeudores/efectivos_caja/create')}}"><i class="@if(\sis5cs\EfectivoCaja::where('id_persona',Session::get('id_persona_codeudor'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Efectivos en Caja</a></li>
    <li id="liCodeudor_sub_capacidad_pago"><a href="{{url('/oficial/a_codeudores/capacidad_pago/create')}}"><i class="@if(\sis5cs\CapacidadPago::where('id_persona',Session::get('id_persona_codeudor'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Amortización Coop. San Martin</a></li>
    <li id="liCodeudor_sub_bienes"><a href="{{url('/oficial/a_codeudores/bienes_hogar/')}}"><i class="@if(\sis5cs\BienesHogar::where('id_persona',Session::get('id_persona_codeudor'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Bienes del hogar</a></li>
    <li id="liCodeudor_sub_ingresos"><a href="{{url('/oficial/a_codeudores/ingreso_mensual/')}}"><i class="@if(\sis5cs\IngresoMensual::where('id_persona',Session::get('id_persona_codeudor'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Ingresos Mensuales</a></li>
    <li id="liCodeudor_sub_venta_comercializacion"><a href="{{url('/oficial/a_codeudores/venta_comercializacion_producto/')}}"><i class="@if(\sis5cs\VentaComercializacionProducto::where('id_persona',Session::get('id_persona_codeudor'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Venta Comercialización Producto</a></li>
    <li id="liCodeudor_sub_datos_imprimir"><a href="{{url('/oficial/a_codeudores/formulario/')}}"><i class="fa fa-print text-orange"></i>Imprimir Datos Codeudor</a></li>
  </ul>
</li>

<li id="liGarante" class="treeview">
  <a href="#">
    <i class=" fa fa-street-view text-yellow" aria-hidden="true"></i>
    <span>Gestionar Garantes</span>
    <i class="fa fa-angle-left pull-right"></i>
  </a>
  <ul class="treeview-menu">
    <li id="liGarante_sub"><a href="{{url('/oficial/garante/')}}"><i class="@if(\sis5cs\Garante::where('id_persona',Session::get('id_persona_garante'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Seleccionar garante</a></li>
    <li id="liGarante_sub_direccion"><a href="{{url('/oficial/a_garantes/direccion/create')}}"><i class="@if(\sis5cs\Direccion::where('id_persona',Session::get('id_persona_garante'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i> Dirección</a></li>
    <li id="liGarante_sub_croquis"><a href="{{url('/oficial/a_garantes/croquis/')}}"><i class="@if(\sis5cs\Croquis::where('id_persona',Session::get('id_persona_garante'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Croquis</a></li>
    <li id="liGarante_sub_conyugue"><a href="{{url('/oficial/a_garantes/conyugue/create')}}"><i class="@if(\sis5cs\Conyugue::where('id_persona',Session::get('id_persona_garante'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Registrar Conyugue</a></li>
    <?php
    $existe_conyugue_garante = \sis5cs\Conyugue::where('id_persona', Session::get('id_persona_garante'))->count();
    if($existe_conyugue_garante>0)
    {
      $id_conyugue_garante=\sis5cs\Conyugue::where('id_persona', Session::get('id_persona_garante'))->firstOrFail()->conyugue;
    }
    else
    {
      $id_conyugue_garante=null;
    }
    ?>
    <li id="liGarante_sub_detalle"><a href="{{url('/oficial/a_garantes/detalle_conyugue/create')}}"><i class="@if(\sis5cs\DetallePersona::where('id_persona',$id_conyugue_garante)->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Detalle Conyugue</a></li>

    <li id="liGarante_sub_empresa"><a href="{{url('/oficial/a_garantes/datos_empresa/create')}}"><i class="@if(\sis5cs\DatosEmpresa::where('id_persona',Session::get('id_persona_garante'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i> Datos Empresa</a></li>
    <li id="liGarante_sub_actividad"><a href="{{url('/oficial/a_garantes/actividad_economica/create')}}"><i class="@if(\sis5cs\ActividadEconomica::where('id_persona',Session::get('id_persona_garante'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Actividad Economica</a></li>
    <li id="liGarante_sub_referencias"><a href="{{url('/oficial/a_garantes/referencias_solicitante/')}}"><i class="@if(\sis5cs\ReferenciaSolicitante::where('id_persona',Session::get('id_persona_garante'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Referencias Garante</a></li>
    <li id="liGarante_sub_inversion"><a href="{{url('/oficial/a_garantes/inversiones_financieras/create')}}"><i class="@if(\sis5cs\InversionesFinancieras::where('id_persona',Session::get('id_persona_garante'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Inversión Financiera</a></li>
    <li id="liGarante_sub_cuenta_documento"><a href="{{url('/oficial/a_garantes/cuentas_documentos_cobrar/create')}}"><i class="@if(\sis5cs\CuentasDocumentosCobrar::where('id_persona',Session::get('id_persona_garante'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Cuentas Documentos Cobrar</a></li>
    <li id="liGarante_sub_inventario"><a href="{{url('/oficial/a_garantes/inventario_mercaderia/')}}"><i class="@if(\sis5cs\InventarioMercaderia::where('id_persona',Session::get('id_persona_garante'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Inventario Mercadería</a></li>
    <li id="liGarante_sub_maquinaria"><a href="{{url('/oficial/a_garantes/maquinaria_equipo/create')}}"><i class="@if(\sis5cs\MaquinariaEquipo::where('id_persona',Session::get('id_persona_garante'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i> Maquinaria Equipo</a></li>
    <li id="liGarante_sub_inmueble"><a href="{{url('/oficial/a_garantes/inmueble/')}}"><i class="@if(\sis5cs\Inmueble::where('id_persona',Session::get('id_persona_garante'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Inmueble</a></li>
    <li id="liGarante_sub_vehiculo"><a href="{{url('/oficial/a_garantes/vehiculo/')}}"><i class="@if(\sis5cs\Vehiculo::where('id_persona',Session::get('id_persona_garante'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Vehículo</a></li>
    <li id="liGarante_sub_otros_activos"><a href="{{url('/oficial/a_garantes/otros_activos/')}}"><i class="@if(\sis5cs\OtroActivo::where('id_persona',Session::get('id_persona_garante'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Otros Activos</a></li>
    <li id="liGarante_sub_prestamo"><a href="{{url('/oficial/a_garantes/prestamo_bancario/')}}"><i class="@if(\sis5cs\PrestamoBancario::where('id_persona',Session::get('id_persona_garante'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Prestamo Bancario</a></li>
    <li id="liGarante_sub_cuentas_pagar"><a href="{{url('/oficial/a_garantes/cuentas_por_pagar/')}}"><i class="@if(\sis5cs\CuentasPorPagar::where('id_persona',Session::get('id_persona_garante'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Cuentas por Pagar</a></li>
    
    <li id="liGarante_sub_mano_obra"><a href="{{url('/oficial/a_garantes/mano_obra/')}}"><i class="@if(\sis5cs\ManoObraMensual::where('id_persona',Session::get('id_persona_garante'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Mano de Obra</a></li>
    <li id="liGarante_sub_gastos_familiares"><a href="{{url('/oficial/a_garantes/gastos_familiares/create')}}"><i class="@if(\sis5cs\GastosFamiliares::where('id_persona',Session::get('id_persona_garante'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Gastos Familiares</a></li>
    <li id="liGarante_sub_gastos_operativos"><a href="{{url('/oficial/a_garantes/gastos_operativos/create')}}"><i class="@if(\sis5cs\GastosOperativosComercializacion::where('id_persona',Session::get('id_persona_garante'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Gastos Operativos</a></li>
    <li id="liGarante_sub_depositos_bancarios"><a href="{{url('/oficial/a_garantes/deposito_bancario/create')}}"><i class="@if(\sis5cs\DepositoBancario::where('id_persona',Session::get('id_persona_garante'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Depositos Bancarios</a></li>

    <li id="liGarante_sub_efectivo_caja"><a href="{{url('/oficial/a_garantes/efectivos_caja/create')}}"><i class="@if(\sis5cs\EfectivoCaja::where('id_persona',Session::get('id_persona_garante'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Efectivos en Caja</a></li>
    <li id="liGarante_sub_capacidad_pago"><a href="{{url('/oficial/a_garantes/capacidad_pago/create')}}"><i class="@if(\sis5cs\CapacidadPago::where('id_persona',Session::get('id_persona_garante'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Amortización Coop. San Martin</a></li>

    <li id="liGarante_sub_bienes"><a href="{{url('/oficial/a_garantes/bienes_hogar/')}}"><i class="@if(\sis5cs\BienesHogar::where('id_persona',Session::get('id_persona_garante'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Bienes del hogar</a></li>
    <li id="liGarante_sub_ingresos"><a href="{{url('/oficial/a_garantes/ingreso_mensual/')}}"><i class="@if(\sis5cs\IngresoMensual::where('id_persona',Session::get('id_persona_garante'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Ingresos Mensuales</a></li>
    <li id="liGarante_sub_venta_comercializacion"><a href="{{url('/oficial/a_garantes/venta_comercializacion_producto/')}}"><i class="@if(\sis5cs\VentaComercializacionProducto::where('id_persona',Session::get('id_persona_garante'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Venta Comercialización Producto</a></li>

    <li id="liGarante_sub_datos_imprimir"><a href="{{url('/oficial/a_garantes/formulario/')}}"><i class="fa fa-print text-orange"></i>Imprimir Datos Garante</a></li>
  </ul>
</li>




<!--------- separador-->



<li><a href="{{url('/oficial/seguimiento/create')}}"><i class="fa fa-eye text-yellow"></i> <span>Seguimiento</span></a></li>

<li id="liPerfil" class="treeview">
  <a href="#">
    <i class=" fa fa-users text-yellow" aria-hidden="true"></i>
    <span>Perfil</span>
    <i class="fa fa-angle-left pull-right"></i>
  </a>
  <ul class="treeview-menu">

   <li id="liGestionarPerfil"><a href="{{url('/oficial/user/')}}"><i class="fa fa-user text-yellow"></i> <span>Gestionar Perfil Usuario</span></a></li>
   <li id="liCambiarFoto"><a href="{{url('/oficial/user/edit_photo')}}"><i class="fa fa-user text-yellow"></i> <span>Cambiar Foto de Perfil</span></a></li>
 </ul>
</li>


</ul>
@endif
@if ( Auth::user()->id_rol==4 )
<ul class="sidebar-menu" data-widget="tree">
  <li class="header">Navegación</li>
  <!-- Optionally, you can add icons to the links -->
  <li><a href="{{url('/plataforma/seleccionar/')}}"><i class="fa fa-circle-o text-green"></i> <span>Seleccionar Socio</span></a></li>
  <li><a href="{{url('/plataforma/seleccionar_credito/')}}"><i class="fa fa-circle-o text-green"></i> <span>Seleccionar Crédito</span></a></li>
  <li><a href="{{url('/plataforma/requisitos/requisitos')}}"><i class="fa fa-circle-o text-red"></i> <span>Ver requisitos</span></a></li>
  <!--<li><a href="{{url('/plataforma/simulador')}}"><i class="fa fa-circle-o text-red"></i> <span>Simular Crédito</span></a></li>-->

  <li id="pLiDatos" class="treeview">
    <a href="#">
      <i class="fa fa-user" aria-hidden="true"></i>
      <span>Registrar datos generales</span>
      <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      <li id="pLiPersona"><a href="{{url('/plataforma/persona/crud')}}"><i <i class="@if(\sis5cs\Persona::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Registrar Socio</a></li>
      <li id="pLiCredito"><a href="{{url('/plataforma/credito/')}}"><i <i class="@if(\sis5cs\Credito::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Registrar Crédito</a></li>
      <li id="pLiDireccion"><a href="{{url('/plataforma/direccion/')}}"><i <i class="@if(\sis5cs\Direccion::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Registrar dirección</a></li>
      <li id="pLiActividadEconomica"><a href="{{url('/plataforma/actividad_economica/')}}"> <i class="@if(\sis5cs\ActividadEconomica::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Registrar Actividad Económica</a></li>
      <li id="pLiDatosEmpresa"><a href="{{url('/plataforma/datos_empresa/')}}"><i <i class="@if(\sis5cs\DatosEmpresa::where('id_persona',Session::get('id_persona'))->count()>0) fa fa-edit text-lime  @else fa fa-pencil @endif"></i>Registrar Datos Empresa</a></li>
    </ul>
  </li>

  <li id="pLiGenerar" class="treeview">
    <a href="#">
      <i class=" fa fa-print" aria-hidden="true"></i>
      <span>Generar Documentos</span>
      <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      <li id="pLiSolicitud"><a href="{{url('/plataforma/solicitud/')}}"><i class="fa fa-pencil"></i>Solicitud de crédito</a></li>     
    </ul>
  </li>


  <li id="pLiPerfil" class="treeview">
    <a href="#">
      <i class=" fa fa-users text-yellow" aria-hidden="true"></i>
      <span>Gestión de Perfil</span>
      <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
     <li id="pLiUser"><a href="{{url('/plataforma/user/')}}"><i class="fa fa-user text-yellow"></i> <span>Gestionar Perfil Usuario</span></a></li>
     <li id="pLiPhoto"><a href="{{url('/plataforma/user/edit_photo')}}"><i class="fa fa-user text-yellow"></i> <span>Cambiar Foto de Perfil</span></a></li>
   </ul>
 </li>

 <li><a href="{{url('/plataforma/seguimiento/create')}}"><i class="fa fa-eye text-yellow"></i> <span>Seguimiento</span></a></li>

</ul>
@endif
@if ( Auth::user()->id_rol==5 )
<!-- Sidebar Menu -->
<ul class="sidebar-menu" data-widget="tree">
  <li class="header">Navegación</li>
  <!-- Optionally, you can add icons to the links -->
  <li class="treeview">
    <a href="#">
      <i class="fa fa-cog" aria-hidden="true"></i>
      <span>Simulador</span>
      <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{url('/cliente/requisitos/seleccionar')}}"><i class="fa fa-circle-o"></i>Ver requisitos</a></li>
      <li><a href="{{url('/cliente/simulador')}}"><i class="fa fa-circle-o"></i>Simular crédito</a></li>
    </ul>
  </li>

  <li class="treeview">
    <a href="#">
      <i class=" fa fa-pencil-square" aria-hidden="true"></i>
      <span>Llenar datos generales</span>
      <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{url('/cliente/persona/create')}}"><i class="fa fa-pencil"></i>Registrar datos generales</a></li>
      <li><a href="{{url('/cliente/direccion/create')}}"><i class="fa fa-pencil"></i>Registrar dirección</a></li>
      <li><a href="{{url('/cliente/croquis/create')}}"><i class="fa fa-pencil"></i>Registrar croquis</a></li>

      <li><a href="{{url('/cliente/credito/create')}}"><i class="fa fa-pencil"></i>Datos credito</a></li>
      <li><a href="{{url('/cliente/actividad_economica/create')}}"><i class="fa fa-pencil"></i>Actividad Económica</a></li>
      <li><a href="{{url('/cliente/datos_empresa/create')}}"><i class="fa fa-pencil"></i>Datos empresa</a></li>
    </ul>
  </li>

  <li class="treeview">
    <a href="#">
      <i class="fa fa-pencil-square" aria-hidden="true"></i>
      <span>Llenar datos conyugue</span>
      <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{url('/cliente/conyugue/create')}}"><i class="fa fa-pencil"></i>Datos Conyugue</a></li>
    </ul>
  </li>

  <li class="treeview">
    <a href="#">
      <i class="fa fa-print"></i>
      <span>Imprimir Solicitud de crédito</span>
      <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{url('cliente/solicitud')}}"><i class="fa fa-circle-o"></i>Formulario de solicitud
      de crédito</a></li>
    </ul>
  </li>

  <li class="treeview">
    <a href="#">
      <i class=" fa fa-users text-yellow" aria-hidden="true"></i>
      <span>Gestión de Perfil</span>
      <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">

     <li><a href="{{url('/cliente/user/')}}"><i class="fa fa-user text-yellow"></i> <span>Gestionar Perfil Usuario</span></a></li>
     <li><a href="{{url('/cliente/user/edit_photo')}}"><i class="fa fa-user text-yellow"></i> <span>Cambiar Foto de Perfil</span></a></li>
   </ul>
 </li>

</ul>
<!-- /.sidebar-menu -->
@endif

@if ( Auth::user()->id_rol==6 )
<ul class="sidebar-menu" data-widget="tree">
  <li class="header">Navegación</li>
  <!-- Optionally, you can add icons to the links -->
  <!-- seleccionar id persona-->

  <li><a href="{{url('/riesgos/seleccionar/')}}"><i class="fa fa-circle-o text-green"></i> <span>Seleccionar Socio</span></a></li>
  <li><a href="{{url('/riesgos/seleccionar_credito/')}}"><i class="fa fa-circle-o text-green"></i> <span>Seleccionar Crédito</span></a></li>
  <!--Perfil de usuario plataforma menú-->
  <li class="treeview">
    <a href="#">
      <i class=" fa fa-users text-yellow" aria-hidden="true"></i>
      <span>Perfil</span>
      <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
     <li><a href="{{url('/riesgos/user/')}}"><i class="fa fa-user text-yellow"></i> <span>Gestionar Perfil Usuario</span></a></li>
     <li><a href="{{url('/riesgos/user/edit_photo')}}"><i class="fa fa-user text-yellow"></i> <span>Cambiar Foto de Perfil</span></a></li>
   </ul>
 </li>


 <li class="treeview">
    <a href="#">
      <i class=" fa fa-address-card text-yellow" aria-hidden="true"></i>
      <span>Generar Informe</span>
      <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
     <li><a href="{{url('/riesgos/consumo_sola_firma/')}}"><i class="fa fa-user text-yellow"></i> <span>Informe A Sola Firma</span></a></li>
     <li><a href="{{url('/riesgos/hipotecaria/')}}"><i class="fa fa-user text-yellow"></i> <span>Informe C. G. Hipotecaria</span></a></li>
     <li><a href="{{url('/riesgos/garantes/')}}"><i class="fa fa-user text-yellow"></i> <span>Informe C. Garantes</span></a></li>
   </ul>
 </li>

 <li><a href="{{url('/riesgos/seguimiento/create')}}"><i class="fa fa-eye text-yellow"></i> <span>Seguimiento</span></a></li>
 <!-- End menú perfil-->

</ul>

@endif

@if ( Auth::user()->id_rol==7 )
<ul class="sidebar-menu" data-widget="tree">
  <li class="header">Navegación</li>
  <!-- Optionally, you can add icons to the links -->
  <!-- seleccionar id persona-->
  <li><a href="{{url('/asesoria/seleccionar/')}}"><i class="fa fa-circle-o text-green"></i> <span>Seleccionar Socio</span></a></li>
  <li><a href="{{url('/asesoria/seleccionar_credito/')}}"><i class="fa fa-circle-o text-green"></i> <span>Seleccionar Socio-Crédito</span></a></li>
  <!--Perfil de usuario plataforma menú-->
  <li class="treeview">
    <a href="#">
      <i class=" fa fa-users text-yellow" aria-hidden="true"></i>
      <span>Perfil</span>
      <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
     <li><a href="{{url('/asesoria/user/')}}"><i class="fa fa-user text-yellow"></i> <span>Gestionar Perfil Usuario</span></a></li>
     <li><a href="{{url('/asesoria/user/edit_photo')}}"><i class="fa fa-user text-yellow"></i> <span>Cambiar Foto de Perfil</span></a></li>
   </ul>
 </li>

 <li class="treeview">
  <a href="#">
    <i class="fa fa-file-text-o text-white" aria-hidden="true"></i>
    <span>Generarar Contratos</span>
    <i class="fa fa-angle-left pull-right"></i>
  </a>
  <ul class="treeview-menu">
   <li><a href="{{url('/asesoria/contrato/consumo')}}"><i class="fa fa-file-text-o text-yellow"></i> <span>Consumo</span></a></li>
   <li><a href="{{url('/asesoria/contrato/consumo_sola_firma')}}"><i class="fa fa-file-text-o text-yellow"></i> <span>Consumo a sola firma</span></a></li>
   <li><a href="{{url('/asesoria/contrato/consumo_garantia_hipotecaria')}}"><i class="fa fa-file-text-o text-yellow"></i> <span>Consumo con Garantía Hipotecaria</span></a></li>
   <li><a href="{{url('/asesoria/contrato/credito_vivienda')}}"><i class="fa fa-file-text-o text-yellow"></i> <span>Credito de Vivienda</span></a></li> 
   <li><a href="{{url('/asesoria/contrato/hipotecario_vivienda')}}"><i class="fa fa-file-text-o text-yellow"></i> <span>Hipotecario de Vivienda</span></a></li>  
   <li><a href="{{url('/asesoria/contrato/microcredito')}}"><i class="fa fa-file-text-o text-yellow"></i> <span>Microcrédito</span></a></li> 
   <li><a href="{{url('/asesoria/contrato/microcredito_sola_firma')}}"><i class="fa fa-file-text-o text-yellow"></i> <span>Microcrédito a Sola Firma</span></a></li> 
      <li><a href="{{url('/asesoria/contrato/microcredito_garantia_hipotecaria')}}"><i class="fa fa-file-text-o text-yellow"></i> <span>Microcrédito con Garantía Hipotecaria</span></a></li> 
 </ul>
</li>

<li><a href="{{url('/asesoria/seguimiento/create')}}"><i class="fa fa-eye text-yellow"></i> <span>Seguimiento</span></a></li>
<!-- End menú perfil-->

</ul>
@endif
@if ( Auth::user()->id_rol==8 )
<ul class="sidebar-menu" data-widget="tree">
  <li class="header">Navegación</li>
  <!-- Optionally, you can add icons to the links -->
  <!-- seleccionar id persona-->
  <!--<li><a href="{{url('/comite/seleccionar/')}}"><i class="fa fa-circle-o text-green"></i> <span>Seleccionar Socio</span></a></li>-->
  <li><a href="{{url('/comite/seleccionar_credito/')}}"><i class="fa fa-circle-o text-green"></i> <span>Seleccionar Crédito</span></a></li>

  <!--Perfil de usuario plataforma menú-->

  <li class="treeview">
    <a href="#">
      <i class=" fa fa-users text-yellow" aria-hidden="true"></i>
      <span>Perfil</span>
      <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">

     <li><a href="{{url('/comite/user/')}}"><i class="fa fa-user text-yellow"></i> <span>Gestionar Perfil Usuario</span></a></li>
     <li><a href="{{url('/comite/user/edit_photo')}}"><i class="fa fa-user text-yellow"></i> <span>Cambiar Foto de Perfil</span></a></li>
   </ul>
 </li>
 <li><a href="{{url('/comite/seguimiento/create')}}"><i class="fa fa-eye text-yellow"></i> <span>Seguimiento</span></a></li>
 <!-- End menú perfil-->

</ul>

@endif

</section>
<!-- /.sidebar -->
</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Sis5cs</h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <!--Contenido-->
                @yield('contenido')
                <!--Fin Contenido-->
              </div>
            </div>
          </div>
        </div><!-- /.row -->
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </section><!-- /.content --><section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="pull-right hidden-xs">
        Team - Sistemas JE
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2018 <a href="#">Cooperativa de Ahorro y Crédito Societaria "San Martín" R.L</a>.</strong> Todos los derechos reservados.
    </footer>

    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED JS SCRIPTS -->

  <!-- jQuery 3 -->

  <script src="{{asset('admin2/bower_components/jquery/dist/jquery.min.js')}}"></script>
  @stack('scripts')

  <!-- Bootstrap 3.3.7 -->
  <script src="{{asset('/admin2/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('/admin2/dist/js/adminlte.min.js')}}"></script>

  <!--ajax cruds-->

  <script src="{{asset('/admin2/dist/js/crudajax/user.js')}}"></script>
  <!--select min-->
  <script src="{{asset('/admin2/dist/js/bootstrap-select.min.js')}}"></script>
  <!--- ajax-->
  {{-- dataTables --}}
  <script src="{{asset('/admin2/datatables/datatables.min.js')}}"></script>
  <script src="{{asset('/admin2/datatables/pdfmake.min.js')}}"></script>
  <script src="{{asset('/admin2/datatables/vfs_fonts.js')}}"></script> 

  {{-- Validator --}}
  <script src="{{ asset('/ajax/validator/validator.min.js') }}"></script>
  <script src="{{ asset('/ajax/bootstrap/js/ie10-viewport-bug-workaround.js') }}"></script>

 <!-- {{-- PrintArea--}}
   <script src="{{asset('admin2/dist/js/jquery-2.1.0.js')}}"></script>
   <script src="{{asset('admin2/dist/js/jquery.PrintArea.js')}}"></script> -->

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->

     <!--script para ajax crud-->
     <script type="text/javascript">
       var idioma_es={
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "Último",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      }
    //DATATABLE----------------------------------
    jQuery(document).ready(function ($) {
        //DATATABLES DE ADMINISTRADOR DEL SIS5CS
        $('#seg_credito_color').DataTable({
          dom: 'Bfrtip',
          buttons: [
          'copy', 'excel', 'print'
          ],
          'paging'      : true,
          'lengthChange': false,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : false,
          'responsive': true,
          "language":idioma_es,
        });

        $('#a_datos_llenados').DataTable({
          dom: 'Bfrtip',
          buttons: [
          'copy', 'excel', 'print'
          ],
          'paging'      : false,
          'lengthChange': false,
          'searching'   : false,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : false,
          'responsive': true,
          "language":idioma_es,
        });

        $('#buscar').DataTable({
          'paging'      : true,
          'lengthChange': false,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : false,
          'responsive': true,
          "language":idioma_es,
        });
        $('#scor-socio').DataTable({
          'paging'      : true,
          'lengthChange': false,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : false,
          'responsive': true,
          "language":idioma_es,
        });
        $('#auditoria').DataTable({
          'paging'      : true,
          'lengthChange': false,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : false,
          'responsive': true,
          "scrollX": true,
          "language":idioma_es,
        });
        $('#oficial_seleccionar_persona').DataTable({
          'paging'      : true,
          'lengthChange': false,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : false,
          'responsive': true,
          "scrollX": true,
          "language":idioma_es,
        });

      //DATATABLES PLATAFO
      $('#p_persona').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });


      //DATATABLES OFICIAL DE CREDITOS

      //C1
      $('#o_inmueble').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });

      $('#o_cuentas_pagar').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });

      $('#o_persona').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'pageLength'  : 5 ,
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });
      $('#o_datos_empresa').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });

      $('#o_mano_obra').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });


      $('#o_venta_comercializacion').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });

      $('#o_gastos_familiares').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });

      $('#o_capacidad_pago').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });

      $('#o_gastos_operativos').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });

      $('#o_credito').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : false,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });

      $('#o_direccion').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : false,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });


      $('#o_actividad_economica').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : false,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });

      $('#o_garantias').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : false,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });

      $('#o_garantia_hipotecaria').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : false,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });

      $('#o_prestamo_bancario').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : false,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });

      $('#o_conyugue').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : false,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });

      $('#o_garante').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : false,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });
      $('#o_codeudor').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : false,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });
      $('#o_bienes_hogar').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : false,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });

      $('#o_reporte_buro').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : false,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });
      $('#o_seguimiento').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : false,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });

      $('#o_vehiculo').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : false,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });

      $('#o_financiera').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : false,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });
      $('#o_deposito_bancario').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : false,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });
      $('#o_efectivo_caja').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : false,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });



      $('#o_detalle_conyugue').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : false,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });
      


      //DATATABLES DE OFICIAL - GARANTES
      $('#o_g_cuentas_pagar').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : false,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });

      //TADATABLES PLATAFORMA
      $('#p_user').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });

      //DATATABLES CLIENTE
      $('#c_datos_empresa').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });

      $('#c_user').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });

      //DATATABLES JEFE DE CRÉDITOS
      $('#f_user').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es,
      });
      //------------------DATATABLES ADMINISTRADOR----------------------

      //-----------------DATATABLES ADMIN SISTEMA GESTION-------------
      $('#a_afp').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es
      });

      $('#a_nacionalidad').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es
      });
      //-----------------DATATABKES ADMIN SISTEMA GESTION ENDS--------
      $('#a_seguimiento').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es
      });

      $('#a_user').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es
      });

      $('#a_garantias').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es
      });
      
      $('#a_direccion').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'print'
        ],
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'responsive': true,
        "scrollX": true,
        "language":idioma_es
      });
    });
      //DATATABLE ENDS---------------
    </script>
  </body>
  </html>