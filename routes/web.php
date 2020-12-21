<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
 */
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/notifications', 'NotificationsController@index')->name('notifications.index');
Route::get('/notifications/{id}', 'NotificationsController@show')->name('notifications.show');
Route::patch('notifications/{id}','NotificationsController@read')->name('notifications.read');
Route::delete('notifications/{id}','NotificationsController@destroy')->name('notifications.destroy');
Route::middleware(['auth', 'admin'])->group(function () {
    //---------------------------- CARLOS RUTAS DE ADMINISTRADOR CONFIGURACION----------------
    //datos actividad economica
    Route::get('/afp', 'AfpController@index'); //listado
    Route::get('/afp/create', 'AfpController@create'); //crear
    Route::post('/afp', 'AfpController@store'); //crear
    Route::get('/afp/{id}/edit', 'AfpController@edit'); //formulario de edicion
    Route::post('/afp/{id}/edit', 'AfpController@update'); //actualizar
    Route::delete('/afp/{id}', 'AfpController@destroy'); //actualizar

    //Rutas de entidades bancarias
    Route::get('/entidad_bancaria', 'EntidadBancariaController@index'); //listado
    Route::get('/entidad_bancaria/create', 'EntidadBancariaController@create'); //crear
    Route::post('/entidad_bancaria', 'EntidadBancariaController@store'); //crear
    Route::get('/entidad_bancaria/{id}/edit', 'EntidadBancariaController@edit'); //formulario de edicion
    Route::post('/entidad_bancaria/{id}/edit', 'EntidadBancariaController@update'); //actualizar
    Route::delete('/entidad_bancaria/{id}', 'EntidadBancariaController@destroy'); //actualizar

    Route::get('/profesion', 'ProfesionController@index'); //listado
    Route::get('/profesion/create', 'ProfesionController@create'); //crear
    Route::post('/profesion', 'ProfesionController@store'); //crear
    Route::get('/profesion/{id}/edit', 'ProfesionController@edit'); //formulario de edicion
    Route::post('/profesion/{id}/edit', 'ProfesionController@update'); //actualizar
    Route::delete('/profesion/{id}', 'ProfesionController@destroy'); //actualizar

    Route::get('/nacionalidad', 'NacionalidadController@index'); //listado
    Route::get('/nacionalidad/create', 'NacionalidadController@create'); //crear
    Route::post('/nacionalidad', 'NacionalidadController@store'); //crear
    Route::get('/nacionalidad/{id}/edit', 'NacionalidadController@edit'); //formulario de edicion
    Route::post('/nacionalidad/{id}/edit', 'NacionalidadController@update'); //actualizar
    Route::delete('/nacionalidad/{id}', 'NacionalidadController@destroy'); //actualizar
    //-----------------------------END CONFIGURATION ADMIN-------------------------------------
    //------------------------CARLOS RUTAS REV.-------------------------------
    //Rutas Seguimiento
    Route::get('/seguimiento', 'SeguimientoController@index'); //listado
    Route::get('/seguimiento/{id}/{id_cre}/documentos', 'SeguimientoController@documentos'); //listado documentos llenados
    Route::post('/seguimiento', 'SeguimientoController@store'); //crear
    Route::get('/seguimiento/{id}/{id_cre}/seguimiento', 'SeguimientoController@seguimiento'); //formulario de edicion
    Route::post('/seguimiento/{id}/edit', 'SeguimientoController@update'); //actualizar
    Route::get('/seguimiento_reporte', 'SeguimientoController@seguimiento_reporte'); //listado
    //Rutas de escritorio
    Route::get('/home/home', 'HomeController@index')->name('home');
    
    //ruta seleccionar persona
    Route::get('/seleccionar/', 'SeleccionarSocioController@index');
    Route::get('/seleccionar/{id}/seleccionar', 'SeleccionarSocioController@seleccionar'); //formulario de edicion
     //rutas de dashboard oficial de creditos
    Route::get('/dashboard/', 'DashboardAdminController@index');
    //datos actividad economica
    Route::get('/actividad_economica', 'ActividadEconomicaController@index'); //listado
    Route::get('/actividad_economica/create', 'ActividadEconomicaController@create'); //crear
    Route::post('/actividad_economica/', 'ActividadEconomicaController@store'); //crear
    Route::get('/actividad_economica/{id}/edit', 'ActividadEconomicaController@edit'); //formulario de edicion
    Route::post('/actividad_economica/{id}/edit', 'ActividadEconomicaController@update'); //actualizar
    Route::delete('/actividad_economica/{id}', 'ActividadEconomicaController@destroy'); //actualizar
    //rutas persona
    Route::get('/persona', 'PersonaController@index'); //listado
    Route::get('/persona/create', 'PersonaController@create'); //crear
    Route::post('/persona', 'PersonaController@store'); //crear
    Route::get('/persona/{id}/edit', 'PersonaController@edit'); //formulario de edicion
    Route::post('/persona/{id}/edit', 'PersonaController@update'); //actualizar
    Route::delete('/persona/{id}', 'PersonaController@destroy');

    //rutas bienes del hogar
    Route::get('/bienes_hogar', 'BienesHogarController@index'); //listado
    Route::get('/bienes_hogar/create', 'BienesHogarController@create'); //crear
    Route::post('/bienes_hogar', 'BienesHogarController@store'); //crear
    Route::get('/bienes_hogar/{id}/edit', 'BienesHogarController@edit'); //formulario de edicion
    Route::post('/bienes_hogar/{id}/edit', 'BienesHogarController@update'); //actualizar
    Route::delete('/bienes_hogar/{id}', 'BienesHogarController@destroy'); //

    //datos capacidad de pago
    Route::get('/capacidad_pago', 'CapacidadPagoController@index'); //listado
    Route::get('/capacidad_pago/create', 'CapacidadPagoController@create'); //crear
    Route::post('/capacidad_pago', 'CapacidadPagoController@store'); //crear
    Route::get('/capacidad_pago/{id}/edit', 'CapacidadPagoController@edit'); //formulario de edicion
    Route::post('/capacidad_pago/{id}/edit', 'CapacidadPagoController@update'); //actualizar
    Route::delete('/capacidad_pago/{id}', 'CapacidadPagoController@destroy'); //actualizar

     //Rutas Crédito
    Route::get('/credito', 'CreditoController@index'); //listado
    Route::get('/credito/create', 'CreditoController@create'); //crear
    Route::post('/credito', 'CreditoController@store'); //crear
    Route::get('/credito/{id}/edit', 'CreditoController@edit'); //formulario de edicion
    Route::post('/credito/{id}/edit', 'CreditoController@update'); //actualizar
    Route::delete('/credito/{id}', 'CreditoController@destroy'); //actualizar

    //rutas de garantia
     Route::get('/garantias/', 'GarantiaController@index'); //listado
    Route::get('/garantias/create', 'GarantiaController@create'); //crear
    Route::post('/garantias/', 'GarantiaController@store'); //crear
    Route::get('/garantias/{id}/edit', 'GarantiaController@edit'); //formulario de edicion
    Route::post('/garantias/{id}/edit', 'GarantiaController@update'); //actualizar
    Route::delete('/garantias/{id}', 'GarantiaController@destroy'); //actualizar

    //ruta direccion
    Route::get('/direccion', 'DireccionController@index'); //listado
    Route::get('/direccion/create', 'DireccionController@create'); //crear
    Route::post('/direccion', 'DireccionController@store'); //crear
    Route::get('/direccion/{id}/edit', 'DireccionController@edit'); //formulario de edicion
    Route::post('/direccion/{id}/edit', 'DireccionController@update'); //actualizar
    Route::delete('/direccion/{id}', 'DireccionController@destroy'); //actualizar

      //Rutas de croquis
    Route::get('/croquis/', 'CroquisController@index'); //listado
    Route::get('/croquis/create', 'CroquisController@create'); //crear
    Route::post('/croquis/', 'CroquisController@store'); //crear
    Route::get('/croquis/{id}/see', 'CroquisController@see'); //formulario para ver mapa
    Route::post('/croquis/{id}/edit', 'CroquisController@update'); //actualizar
    Route::get('/croquis/{id}/edit', 'CroquisController@edit'); //actualizar
    Route::delete('/croquis/{id}', 'CroquisController@destroy'); //actualizar
     //rutas datos empresa
    Route::get('/datos_empresa', 'DatosEmpresaController@index'); //listado
    Route::get('/datos_empresa/create', 'DatosEmpresaController@create'); //crear
    Route::post('/datos_empresa', 'DatosEmpresaController@store'); //crear
    Route::get('/datos_empresa/{id}/edit', 'DatosEmpresaController@edit'); //formulario de edicion
    Route::post('/datos_empresa/{id}/edit', 'DatosEmpresaController@update'); //actualizar
    Route::delete('/datos_empresa/{id}', 'DatosEmpresaController@destroy'); //actualizar
    //Rutas Conyugues
    Route::get('/conyugue/', 'ConyugueController@index'); //listado
    Route::get('/conyugue/create', 'ConyugueController@create'); //crear
    Route::post('/conyugue/', 'ConyugueController@store'); //crear
    Route::get('/conyugue/{id}/edit', 'ConyugueController@edit'); //formulario de edicion
    Route::post('/conyugue/{id}/edit', 'ConyugueController@update'); //actualizar
    Route::delete('/conyugue/{id}', 'ConyugueController@destroy'); //actualizar
    //Rutas detalle conyugue
    Route::get('/detalle_conyugue/', 'DetalleConyugueController@index'); //listado
    Route::get('/detalle_conyugue/create', 'DetalleConyugueController@create'); //crear
    Route::post('/detalle_conyugue/', 'DetalleConyugueController@store'); //crear
    Route::get('/detalle_conyugue/{id}/edit', 'DetalleConyugueController@edit'); //formulario de edicion
    Route::post('/detalle_conyugue/{id}/edit', 'DetalleConyugueController@update'); //actualizar
    Route::delete('/detalle_conyugue/{id}', 'DetalleConyugueController@destroy'); //actualizar

    //Rutas Referencias Solicitante
    Route::get('/referencias_solicitante/', 'ReferenciaSolicitanteController@index'); //listado
    Route::get('/referencias_solicitante/create', 'ReferenciaSolicitanteController@create'); //crear
    Route::post('/referencias_solicitante/', 'ReferenciaSolicitanteController@store'); //crear
    Route::get('/referencias_solicitante/{id}/edit', 'ReferenciaSolicitanteController@edit'); //formulario de edicion
    Route::post('/referencias_solicitante/{id}/edit', 'ReferenciaSolicitanteController@update'); //actualizar
    Route::delete('/referencias_solicitante/{id}', 'ReferenciaSolicitanteController@destroy'); //actualizar

     //ruta reporte buro
    Route::get('/reporte_buro/', 'ReporteBuroController@index'); //listado
    Route::get('/reporte_buro/create', 'ReporteBuroController@create'); //crear
    Route::post('/reporte_buro/', 'ReporteBuroController@store'); //crear
    Route::get('/reporte_buro/{id}/edit', 'ReporteBuroController@edit'); //formulario de edicion
    Route::post('/reporte_buro/{id}/edit', 'ReporteBuroController@update'); //actualizar
    Route::delete('/reporte_buro/{id}', 'ReporteBuroController@destroy'); //actualizar

    //rutas deposito bancario
    Route::get('/deposito_bancario/', 'DepositoBancarioController@index'); //listado
    Route::get('/deposito_bancario/create', 'DepositoBancarioController@create'); //crear
    Route::post('/deposito_bancario/', 'DepositoBancarioController@store'); //crear
    Route::get('/deposito_bancario/{id}/edit', 'DepositoBancarioController@edit'); //formulario de edicion
    Route::post('/deposito_bancario/{id}/edit', 'DepositoBancarioController@update'); //actualizar
    Route::delete('/deposito_bancario/{id}', 'DepositoBancarioController@destroy'); //actualizar


    //Rutas Inversiones financieras
    Route::get('/inversiones_financieras/', 'InversionesFinancierasController@index'); //listado
    Route::get('/inversiones_financieras/create', 'InversionesFinancierasController@create'); //crear
    Route::post('/inversiones_financieras/', 'InversionesFinancierasController@store'); //crear
    Route::get('/inversiones_financieras/{id}/edit', 'InversionesFinancierasController@edit'); //formulario de edicion
    Route::post('/inversiones_financieras/{id}/edit', 'InversionesFinancierasController@update'); //actualizar
    Route::delete('/inversiones_financieras/{id}', 'InversionesFinancierasController@destroy'); //actualizar

     //Rutas Cuentas Documentos por Cobrar
    Route::get('/cuentas_documentos_cobrar/', 'CuentasDocumentosCobrarController@index'); //listado
    Route::get('/cuentas_documentos_cobrar/create', 'CuentasDocumentosCobrarController@create'); //crear
    Route::post('/cuentas_documentos_cobrar/', 'CuentasDocumentosCobrarController@store'); //crear
    Route::get('/cuentas_documentos_cobrar/{id}/edit', 'CuentasDocumentosCobrarController@edit'); //formulario de edicion
    Route::post('/cuentas_documentos_cobrar/{id}/edit', 'CuentasDocumentosCobrarController@update'); //actualizar
    Route::delete('/cuentas_documentos_cobrar/{id}', 'CuentasDocumentosCobrarController@destroy'); //actualizar


    //Rutas Inventario de mercaderias
    Route::get('/inventario_mercaderia/', 'InventarioMercaderiaController@index'); //listado
    Route::get('/inventario_mercaderia/create', 'InventarioMercaderiaController@create'); //crear
    Route::post('/inventario_mercaderia/', 'InventarioMercaderiaController@store'); //crear
    Route::get('/inventario_mercaderia/{id}/edit', 'InventarioMercaderiaController@edit'); //formulario de edicion
    Route::post('/inventario_mercaderia/{id}/edit', 'InventarioMercaderiaController@update'); //actualizar
    Route::delete('/inventario_mercaderia/{id}', 'InventarioMercaderiaController@destroy'); //actualizar

    //Rutas Maquinaria
    Route::get('/maquinaria_equipo/', 'MaquinariaEquipoController@index'); //listado
    Route::get('/maquinaria_equipo/create', 'MaquinariaEquipoController@create'); //crear
    Route::post('/maquinaria_equipo/', 'MaquinariaEquipoController@store'); //crear
    Route::get('/maquinaria_equipo/{id}/edit', 'MaquinariaEquipoController@edit'); //formulario de edicion
    Route::post('/maquinaria_equipo/{id}/edit', 'MaquinariaEquipoController@update'); //actualizar
    Route::delete('/maquinaria_equipo/{id}', 'MaquinariaEquipoController@destroy'); //actualizar

    //Rutas Inmuebles
    Route::get('/inmueble/', 'InmuebleController@index'); //listado
    Route::get('/inmueble/create', 'InmuebleController@create'); //crear
    Route::post('/inmueble/', 'InmuebleController@store'); //crear
    Route::get('/inmueble/{id}/edit', 'InmuebleController@edit'); //formulario de edicion
    Route::post('/inmueble/{id}/edit', 'InmuebleController@update'); //actualizar
    Route::delete('/inmueble/{id}', 'InmuebleController@destroy'); //actualizar

    Route::get('/vehiculo/', 'VehiculoController@index'); //listado
    Route::get('/vehiculo/create', 'VehiculoController@create'); //crear
    Route::post('/vehiculo/', 'VehiculoController@store'); //crear
    Route::get('/vehiculo/{id}/edit', 'VehiculoController@edit'); //formulario de edicion
    Route::post('/vehiculo/{id}/edit', 'VehiculoController@update'); //actualizar
    Route::delete('/vehiculo/{id}', 'VehiculoController@destroy'); //actualizar

    //Rutas Efectivos en Caja
    Route::get('/efectivos_caja/', 'EfectivoCajaController@index'); //listado
    Route::get('/efectivos_caja/create', 'EfectivoCajaController@create'); //crear
    Route::post('/efectivos_caja/', 'EfectivoCajaController@store'); //crear
    Route::get('/efectivos_caja/{id}/edit', 'EfectivoCajaController@edit'); //formulario de edicion
    Route::post('/efectivos_caja/{id}/edit', 'EfectivoCajaController@update'); //actualizar
    Route::delete('/efectivos_caja/{id}', 'EfectivoCajaController@destroy'); //actualizar

    //Rutas Otros Activos
    Route::get('/otros_activos/', 'OtroActivoController@index'); //listado
    Route::get('/otros_activos/create', 'OtroActivoController@create'); //crear
    Route::post('/otros_activos/', 'OtroActivoController@store'); //crear
    Route::get('/otros_activos/{id}/edit', 'OtroActivoController@edit'); //formulario de edicion
    Route::post('/otros_activos/{id}/edit', 'OtroActivoController@update'); //actualizar
    Route::delete('/otros_activos/{id}', 'OtroActivoController@destroy'); //actualizar

    //Rutas Prestamo bancario
    Route::get('/prestamo_bancario/', 'PrestamoBancarioController@index'); //listado
    Route::get('/prestamo_bancario/create', 'PrestamoBancarioController@create'); //crear
    Route::post('/prestamo_bancario/', 'PrestamoBancarioController@store'); //crear
    Route::get('/prestamo_bancario/{id}/edit', 'PrestamoBancarioController@edit'); //formulario de edicion
    Route::post('/prestamo_bancario/{id}/edit', 'PrestamoBancarioController@update'); //actualizar
    Route::delete('/prestamo_bancario/{id}', 'PrestamoBancarioController@destroy'); //actualizar

    //Rutas Cuentas por Pagar
    Route::get('/cuentas_por_pagar/', 'CuentasPagarController@index'); //listado
    Route::get('/cuentas_por_pagar/create', 'CuentasPagarController@create'); //crear
    Route::post('/cuentas_por_pagar/', 'CuentasPagarController@store'); //crear
    Route::get('/cuentas_por_pagar/{id}/edit', 'CuentasPagarController@edit'); //formulario de edicion
    Route::post('/cuentas_por_pagar/{id}/edit', 'CuentasPagarController@update'); //actualizar
    Route::delete('/cuentas_por_pagar/{id}', 'CuentasPagarController@destroy'); //actualizar

    //rutas de gastos familiares
    Route::get('/gastos_familiares/', 'GastosFamiliaresController@index'); //listado
    Route::get('/gastos_familiares/create', 'GastosFamiliaresController@create'); //crear
    Route::post('/gastos_familiares/', 'GastosFamiliaresController@store'); //crear
    Route::get('/gastos_familiares/{id}/edit', 'GastosFamiliaresController@edit'); //formulario de edicion
    Route::post('/gastos_familiares/{id}/edit', 'GastosFamiliaresController@update'); //actualizar
    Route::delete('/gastos_familiares/{id}', 'GastosFamiliaresController@destroy'); //actualizar

    //Rutas Gastos Operativos
    Route::get('/gastos_operativos/', 'GastosOperativosComercializacionController@index'); //listado
    Route::get('/gastos_operativos/create', 'GastosOperativosComercializacionController@create'); //crear
    Route::post('/gastos_operativos/', 'GastosOperativosComercializacionController@store'); //crear
    Route::get('/gastos_operativos/{id}/edit', 'GastosOperativosComercializacionController@edit'); //formulario de edicion
    Route::post('/gastos_operativos/{id}/edit', 'GastosOperativosComercializacionController@update'); //actualizar
    Route::delete('/gastos_operativos/{id}', 'GastosOperativosComercializacionController@destroy'); //actualizar

     //rutas de mano de obra
    Route::get('/mano_obra/', 'ManoObraMensualController@index'); //listado
    Route::get('/mano_obra/create', 'ManoObraMensualController@create'); //crear
    Route::post('/mano_obra/', 'ManoObraMensualController@store'); //crear
    Route::get('/mano_obra/{id}/edit', 'ManoObraMensualController@edit'); //formulario de edicion
    Route::post('/mano_obra/{id}/edit', 'ManoObraMensualController@update'); //actualizar
    Route::delete('/mano_obra/{id}', 'ManoObraMensualController@destroy'); //actualizar


    //rutas de ingreso mensual
    Route::get('/ingreso_mensual/', 'IngresoMensualController@index'); //listado
    Route::get('/ingreso_mensual/create', 'IngresoMensualController@create'); //crear
    Route::post('/ingreso_mensual/', 'IngresoMensualController@import'); //crear
    Route::get('/ingreso_mensual/descarga', 'IngresoMensualController@download'); //listado
    Route::get('/ingreso_mensual/{id}/edit', 'IngresoMensualController@edit'); //formulario de edicion
    Route::post('/ingreso_mensual/{id}/edit', 'IngresoMensualController@update'); //actualizar
    Route::delete('/ingreso_mensual/{id}', 'IngresoMensualController@destroy'); //actualizar


//RUTAS DE VENTA COMERCIALIZACION DE PRODUCTOS
    Route::get('/venta_comercializacion_producto/', 'VentaComercializacionProductoController@index'); //listado
    Route::get('/venta_comercializacion_producto/create', 'VentaComercializacionProductoController@create'); //crear
    Route::post('/venta_comercializacion_producto/', 'VentaComercializacionProductoController@import'); //crear
    Route::get('/venta_comercializacion_producto/descarga', 'VentaComercializacionProductoController@download'); //listado
    Route::get('/venta_comercializacion_producto/descarga_transporte', 'VentaComercializacionProductoController@download_transporte'); //listado
    Route::get('/venta_comercializacion_producto/comercio', 'VentaComercializacionProductoController@download_comercio'); //listado
    Route::get('/venta_comercializacion_producto/{id}/edit', 'VentaComercializacionProductoController@edit'); //formulario de edicion
    Route::post('/venta_comercializacion_producto/{id}/edit', 'VentaComercializacionProductoController@update'); //actualizar
    Route::delete('/venta_comercializacion_producto/{id}', 'VentaComercializacionProductoController@destroy'); //actualizar



    //-------------------------------------CARLOS END----------------------------------------------
     //rutas ventas
    Route::get('/ventas/crud', 'VentasController@index'); //listado
    Route::get('/ventas/crud/create', 'VentasController@create'); //crear
    Route::post('/ventas/crud', 'VentasController@store'); //crear
    Route::get('/ventas/crud/{id}/edit', 'VentasController@edit'); //formulario de edicion
    Route::post('/ventas/crud/{id}/edit', 'VentasController@update'); //actualizar
    Route::delete('/ventas/crud/{id}', 'VentasController@destroy'); //actualizar
       
    
    //rutas dashbord
    Route::get('/dashbord', 'DashboardController@index'); //listado
    //rutas usuario
    Route::get('/user/crud', 'UserController@index'); //listado
    Route::get('/user/crud/create', 'UserController@create'); //crear
    Route::post('/user/crud', 'UserController@store'); //crear
    Route::get('/user/crud/{id}/edit', 'UserController@edit'); //formulario de edicion
    Route::patch('/user/crud/{id}/edit', 'UserController@update'); //actualizar
    Route::delete('/user/crud/{id}', 'UserController@destroy'); //actualizar

    //rutas scor
    Route::get('/scor', 'ScorSocioController@index'); //listado
    Route::post('/scor', 'ScorSocioController@store'); //crear
    Route::get('/scor/{id}/scor', 'ScorSocioController@scor'); //formulario de edicion
    Route::post('/scor/{id}/edit', 'ScorSocioController@update'); //actualizar
    //rutas auditoria
    Route::get('/auditoria', 'AuditoriaController@index'); //listado
    Route::post('/auditoria', 'AuditoriaController@store'); //crear
    Route::get('/auditoria/{id}/scor', 'AuditoriaController@scor'); //formulario de edicion

    
    
    //rutas codeudores
    Route::get('/codeudor/crud', 'CodeudorController@index'); //listado
    Route::get('/codeudor/crud/create', 'CodeudorController@create'); //crear
    Route::post('/codeudor/crud', 'CodeudorController@store'); //crear
    Route::get('/codeudor/crud/{id}/edit', 'CodeudorController@edit'); //formulario de edicion
    Route::post('/codeudor/crud/{id}/edit', 'CodeudorController@update'); //actualizar
    Route::delete('/codeudor/crud/{id}', 'CodeudorController@destroy'); //actualizar

});
//Rutas del rol de plataforma
Route::middleware(['auth', 'plataforma'])->prefix('plataforma')->group(function () {
    //Rutas de Reporte solicitud Modulo reportes
   /* Route::get('/solicitud', 'Oficial\ReportePlataformaController@solicitudOficial');
    Route::get('/caratulas', 'Oficial\ReportePlataformaController@caratulasOficial');
    Route::get('/control_documentos', 'Oficial\ReportePlataformaController@controlDocumentos');
    Route::get('/informe_credito', 'Oficial\ReportePlataformaController@informeCredito');*/

    //ruta persona
    Route::get('/persona/crud', 'Plataforma\PersonaController@index'); //listado
    Route::get('/persona/crud/create', 'Plataforma\PersonaController@create'); //crear
    Route::post('/persona/crud', 'Plataforma\PersonaController@store'); //crear
    Route::get('/persona/crud/{id}/edit', 'Plataforma\PersonaController@edit'); //formulario de edicion
    Route::post('/persona/crud/{id}/edit', 'Plataforma\PersonaController@update'); //actualizar
    Route::delete('/persona/crud/{id}', 'Plataforma\PersonaController@destroy'); //actualizar
    Route::get('/persona/crud/reporte', 'Plataforma\PersonaController@reporte');
    Route::get('/word/{id}', 'PersonaController@word'); //actualizar
    //rutas de plataforma
    Route::get('/requisitos/requisitos', 'Plataforma\MostrarRequisitosController@requisitos'); //listar
    Route::get('/simulador', 'Plataforma\SimuladorController@index');

    //Rutas usuario
    Route::get('/user', 'Plataforma\UserController@index'); //listado
    Route::get('/user/{id}/edit', 'Plataforma\UserController@edit'); //formulario de edicion
    Route::get('/user/edit_photo', 'Plataforma\UserController@edit_photo'); //formulario de edicion
    Route::patch('/user/{id}/edit_datos', 'Plataforma\UserController@update_datos'); //actualizar
    Route::patch('/user/{id}/edit_picture', 'Plataforma\UserController@update_picture'); //actualizar

    //rutas seguimiento
    Route::get('/seguimiento/', 'Plataforma\SeguimientoController@index'); //listado
    Route::get('/seguimiento/create', 'Plataforma\SeguimientoController@create'); //crear
    Route::post('/seguimiento/', 'Plataforma\SeguimientoController@store'); //crear
    Route::get('/seguimiento/{id}/edit_fin', 'Plataforma\SeguimientoController@edit_fin'); //formulario de edicion
    Route::post('/seguimiento/{id}/edit_fin', 'Plataforma\SeguimientoController@update_fin'); //actualizar
    Route::get('/seguimiento/{id}/edit_derivar', 'Plataforma\SeguimientoController@edit_derivar'); //formulario de edicion
    Route::post('/seguimiento/{id}/edit_derivar', 'Plataforma\SeguimientoController@update_derivar'); //

    //Rutas seleccionar
    Route::get('/seleccionar/', 'Plataforma\SeleccionarSocioController@index');
    Route::get('/seleccionar/{id}/seleccionar', 'Plataforma\SeleccionarSocioController@seleccionar'); //
    //Rutas seleccionar credito

    Route::get('/seleccionar_credito/', 'Plataforma\SeleccionarCreditoController@index');
    Route::get('/seleccionar_credito/{id_persona}/{id_credito}/seleccionar_credito', 'Plataforma\SeleccionarCreditoController@seleccionar_credito');

    //rutas de dashboard oficial de creditos
    Route::get('/dashboard/', 'Plataforma\DashboardPlataformaController@index');

    //Rutas de credito
    Route::get('/credito', 'Plataforma\CreditoController@index'); //listado
    Route::get('/credito/create', 'Plataforma\CreditoController@create'); //crear
    Route::post('/credito', 'Plataforma\CreditoController@store'); //crear
    Route::get('/credito/{id}/edit', 'Plataforma\CreditoController@edit'); //formulario de edicion
    Route::post('/credito/{id}/edit', 'Plataforma\CreditoController@update'); //actualizar
    Route::delete('/credito/{id}', 'Plataforma\CreditoController@destroy'); //actualizar
    //Rutas Direccion
    Route::get('/direccion', 'Plataforma\DireccionController@index'); //listado
    Route::get('/direccion/create', 'Plataforma\DireccionController@create'); //crear
    Route::post('/direccion', 'Plataforma\DireccionController@store'); //crear
    Route::get('/direccion/{id}/edit', 'Plataforma\DireccionController@edit'); //formulario de edicion
    Route::post('/direccion/{id}/edit', 'Plataforma\DireccionController@update'); //actualizar
    Route::delete('/direccion/{id}', 'Plataforma\DireccionController@destroy'); //actualizar
    //Rutas de actividad economica
    Route::get('/actividad_economica', 'Plataforma\ActividadEconomicaController@index'); //listado
    Route::get('/actividad_economica/create', 'Plataforma\ActividadEconomicaController@create'); //crear
    Route::post('/actividad_economica', 'Plataforma\ActividadEconomicaController@store'); //crear
    Route::get('/actividad_economica/{id}/edit', 'Plataforma\ActividadEconomicaController@edit'); //formulario de edicion
    Route::post('/actividad_economica/{id}/edit', 'Plataforma\ActividadEconomicaController@update'); //actualizar
    Route::delete('/actividad_economica/{id}', 'Plataforma\ActividadEconomicaController@destroy'); //actualizar
    //Rutas datos empresa
    Route::get('/datos_empresa', 'Plataforma\DatosEmpresaController@index'); //listado
    Route::get('/datos_empresa/create', 'Plataforma\DatosEmpresaController@create'); //crear
    Route::post('/datos_empresa', 'Plataforma\DatosEmpresaController@store'); //crear
    Route::get('/datos_empresa/{id}/edit', 'Plataforma\DatosEmpresaController@edit'); //formulario de edicion
    Route::post('/datos_empresa/{id}/edit', 'Plataforma\DatosEmpresaController@update'); //actualizar
    Route::delete('/datos_empresa/{id}', 'Plataforma\DatosEmpresaController@destroy'); //actualizar
    //Rutas
    Route::get('/solicitud', 'Oficial\ReporteOficialController@solicitudOficial');
});
//Rutas del rol Cliente
Route::middleware(['auth', 'cliente'])->prefix('cliente')->group(function () {
    //rutas de dashboard oficial de creditos
    Route::get('/dashboard/', 'Cliente\DashboardClienteController@index');

    Route::get('/persona/', 'Cliente\PersonaController@index'); //listado
    Route::get('/persona/create', 'Cliente\PersonaController@create'); //crear
    Route::post('/persona', 'Cliente\PersonaController@store'); //crear
    Route::get('/requisitos/seleccionar', 'Cliente\PersonaController@seleccionar'); //listar
    Route::get('/simulador', 'Cliente\SimuladorController@index');
    //Route::get('/persona/mensaje', 'PersonaController@mensaje');

    //Rutas de direccion
    Route::get('/direccion/', 'Cliente\DireccionController@index'); //listado
    Route::get('/direccion/mensaje', 'Cliente\DireccionController@mensaje'); //mensaje
    Route::get('/direccion/create', 'Cliente\DireccionController@create'); //crear
    Route::post('/direccion/', 'Cliente\DireccionController@store'); //crear

    //Rutas de croquis
    Route::get('/croquis/', 'Cliente\CroquisDireccionController@index'); //listado
    Route::get('/crquis/mensaje', 'Cliente\CroquisDireccionController@mensaje'); //mensaje
    Route::get('/croquis/create', 'Cliente\CroquisDireccionController@create'); //crear
    Route::post('/croquis/', 'Cliente\CroquisDireccionController@store'); //crear
    //Rutas conyugue
    Route::get('/conyugue/', 'Cliente\ConyugueController@index'); //listado
    Route::get('/conyugue/create', 'Cliente\ConyugueController@create'); //crear
    Route::post('/conyugue/', 'Cliente\ConyugueController@store'); //crear
    //Rutas Garante
    Route::get('/garante/', 'Cliente\GaranteController@index'); //listado
    Route::get('/garante/create', 'Cliente\GaranteController@create'); //crear
    Route::post('/garante/', 'Cliente\GaranteController@store'); //crear
    //Reportes de cliente
    Route::get('/solicitud', 'Cliente\ReporteClienteController@solicitud');
    //Rutas Crédito
    Route::get('/credito/', 'Cliente\CreditoController@index'); //listado
    Route::get('/credito/create', 'Cliente\CreditoController@create'); //crear
    Route::post('/credito/', 'Cliente\CreditoController@store'); //crear
    //Rutas de Actividad economica
    Route::get('/actividad_economica/', 'Cliente\ActividadEconomicaController@index'); //listado
    Route::get('/actividad_economica/create', 'Cliente\ActividadEconomicaController@create'); //crear
    Route::post('/actividad_economica/', 'Cliente\ActividadEconomicaController@store'); //crear

    //Rutas datos  empresa
    Route::get('/datos_empresa/', 'Cliente\DatosEmpresaClienteController@index'); //listado
    Route::get('/datos_empresa/create', 'Cliente\DatosEmpresaClienteController@create'); //crear
    Route::post('/datos_empresa/', 'Cliente\DatosEmpresaClienteController@store'); //crear

    //Rutas usuario
    Route::get('/user', 'Cliente\UserController@index'); //listado
    Route::get('/user/{id}/edit', 'Cliente\UserController@edit'); //formulario de edicion
    Route::get('/user/edit_photo', 'Cliente\UserController@edit_photo'); //formulario de edicion
    Route::patch('/user/{id}/edit_datos', 'Cliente\UserController@update_datos'); //actualizar
    Route::patch('/user/{id}/edit_picture', 'Cliente\UserController@update_picture'); //actualizar
});

    //Rutas del rol Jefe de creditos
Route::middleware(['auth', 'jefecredito'])->prefix('jefecredito')->group(function () {
    //rutas de dashboard jefe de créditos
    Route::get('/dashboard/', 'JefeCredito\DashboardJefeCreditoController@index');
    //Reportes de cliente
    Route::get('/cartera/', 'JefeCredito\ReporteJefeCreditoController@cartera_masiva');
    //ruta seleccionar persona
    Route::get('/seleccionar/', 'JefeCredito\SeleccionarSocioController@index');
    Route::get('/seleccionar/{id}/seleccionar', 'JefeCredito\SeleccionarSocioController@seleccionar');
    //Rutas seleccionar creditos
    Route::get('/seleccionar_credito/', 'JefeCredito\SeleccionarCreditoController@index');
    Route::get('/seleccionar_credito/{id_persona}/{id_credito}/seleccionar_credito', 'JefeCredito\SeleccionarCreditoController@seleccionar_credito');

    //rutas seguimiento---------------------
    Route::get('/seguimiento/', 'JefeCredito\SeguimientoController@index'); //listado
    Route::get('/seguimiento/create', 'JefeCredito\SeguimientoController@create'); //crear
    Route::post('/seguimiento/', 'JefeCredito\SeguimientoController@store'); //crear
    Route::get('/seguimiento/{id}/edit_fin', 'JefeCredito\SeguimientoController@edit_fin'); //formulario de edicion
    Route::post('/seguimiento/{id}/edit_fin', 'JefeCredito\SeguimientoController@update_fin'); //actualizar
    Route::get('/seguimiento/{id}/edit_derivar', 'JefeCredito\SeguimientoController@edit_derivar'); //formulario de edicion
    Route::post('/seguimiento/{id}/edit_derivar', 'JefeCredito\SeguimientoController@update_derivar'); //

    //Rutas usuario-------------------
    Route::get('/user', 'JefeCredito\UserController@index'); //listado
    Route::get('/user/{id}/edit', 'JefeCredito\UserController@edit'); //formulario de edicion
    Route::get('/user/edit_photo', 'JefeCredito\UserController@edit_photo'); //formulario de edicion
    Route::patch('/user/{id}/edit_datos', 'JefeCredito\UserController@update_datos'); //actualizar
    Route::patch('/user/{id}/edit_picture', 'JefeCredito\UserController@update_picture'); //actualizar
    //Rutas marcar
    Route::get('/marcar_credito/', 'JefeCredito\MarcarController@index'); //listado
    Route::get('/marcar_credito/create', 'JefeCredito\MarcarController@create'); //crear
    Route::post('/marcar_credito/', 'JefeCredito\MarcarController@import'); //crear
    Route::get('/marcar_credito/descarga', 'JefeCredito\MarcarController@download'); //listado
    Route::get('/marcar_credito/{id}/edit', 'JefeCredito\MarcarController@edit'); //formulario de edicion
    Route::post('/marcar_credito/{id}/edit', 'JefeCredito\MarcarController@update'); //actualizar

});
//Rutas del rol Oficial de créditos
Route::middleware(['auth', 'oficialcredito'])->prefix('oficial')->group(function () {
    //rutas de dashboard oficial de creditos
    Route::get('/dashboard/', 'Oficial\DashboardOficialController@index');
    //Rutas de croquis
    Route::get('/croquis/', 'Oficial\CroquisController@index'); //listado
    Route::get('/croquis/create', 'Oficial\CroquisController@create'); //crear
    Route::post('/croquis/', 'Oficial\CroquisController@store'); //crear
    Route::get('/croquis/{id}/see', 'Oficial\CroquisController@see'); //formulario para ver mapa
    Route::post('/croquis/{id}/edit', 'Oficial\CroquisController@update'); //actualizar
    Route::get('/croquis/{id}/edit', 'Oficial\CroquisController@edit'); //actualizar
    Route::delete('/croquis/{id}', 'Oficial\CroquisController@destroy'); //actualizar


    //ruta solicitud de credito
    Route::get('/garantia_hipotecaria/', 'Oficial\GarantiaHipotecariaController@index'); //listado
    Route::get('/garantia_hipotecaria/create', 'Oficial\GarantiaHipotecariaController@create'); //crear
    Route::post('/garantia_hipotecaria/', 'Oficial\GarantiaHipotecariaController@store'); //crear
    Route::get('/garantia_hipotecaria/{id}/edit', 'Oficial\GarantiaHipotecariaController@edit'); //formulario de edicion
    Route::post('/garantia_hipotecaria/{id}/edit', 'Oficial\GarantiaHipotecariaController@update'); //actualizar
    Route::delete('/garantia_hipotecaria/{id}', 'Oficial\GarantiaHipotecariaController@destroy'); //actualizar



    //ruta seleccionar persona
    Route::get('/seleccionar/', 'Oficial\SeleccionarSocioController@index');
    Route::get('/seleccionar/{id}/seleccionar', 'Oficial\SeleccionarSocioController@seleccionar'); //formulario de edicion
    //ruta seleccionar garante
    Route::get('/seleccionar/garante/{id}/seleccionar', 'Oficial\SeleccionarGaranteController@seleccionar'); //formulario de edicion

    //ruta seleccionar codeudor
    Route::get('/seleccionar/codeudor/{id}/seleccionar', 'Oficial\SeleccionarCodeudorController@seleccionar'); //formulario de edicion
    //Rutas seleccionar Crédito
    Route::get('/seleccionar_credito/', 'Oficial\SeleccionarCreditoController@index');
    Route::get('/seleccionar_credito/{id_persona}/{id_credito}/seleccionar_credito', 'Oficial\SeleccionarCreditoController@seleccionar_credito'); //formulario de edicion

    //ruta reporte buro
    Route::get('/reporte_buro/', 'Oficial\ReporteBuroController@index'); //listado
    Route::get('/reporte_buro/create', 'Oficial\ReporteBuroController@create'); //crear
    Route::post('/reporte_buro/', 'Oficial\ReporteBuroController@store'); //crear
    Route::get('/reporte_buro/{id}/edit', 'Oficial\ReporteBuroController@edit'); //formulario de edicion
    Route::post('/reporte_buro/{id}/edit', 'Oficial\ReporteBuroController@update'); //actualizar
    //ruta situacion personal confidencial
    Route::get('/situacion_personal/', 'Oficial\SituacionPersonalController@index'); //listado
    Route::get('/situacion_personal/create', 'Oficial\SituacionPersonalController@create'); //crear
    Route::post('/situacion_personal/', 'Oficial\SituacionPersonalController@store'); //crear
    //scoring socio
    Route::get('/scor/', 'Oficial\ScorSocioController@index'); //listado
    Route::get('/scor/scor', 'Oficial\ScorSocioController@scor'); //formulario de edicion

    //ruta situacion personal confidencial
    Route::get('/analisis_capacidad_pago/', 'Oficial\AnalisisCapacidadPagoController@index'); //listado
    Route::get('/analisis_capacidad_pago/create', 'Oficial\AnalisisCapacidadPagoController@create'); //crear
    Route::post('/analisis_capacidad_pago/', 'Oficial\AnalisisCapacidadPagoController@store'); //crear
    //rutas de ingreso mensual
    Route::get('/ingreso_mensual/', 'Oficial\IngresoMensualController@index'); //listado
    Route::get('/ingreso_mensual/create', 'Oficial\IngresoMensualController@create'); //crear
    Route::post('/ingreso_mensual/', 'Oficial\IngresoMensualController@import'); //crear
    Route::get('/ingreso_mensual/descarga', 'Oficial\IngresoMensualController@download'); //listado
    Route::get('/ingreso_mensual/{id}/edit', 'Oficial\IngresoMensualController@edit'); //formulario de edicion
    Route::post('/ingreso_mensual/{id}/edit', 'Oficial\IngresoMensualController@update'); //actualizar
    //rutas de mano de obra
    Route::get('/mano_obra/', 'Oficial\ManoObraMensualController@index'); //listado
    Route::get('/mano_obra/create', 'Oficial\ManoObraMensualController@create'); //crear
    Route::post('/mano_obra/', 'Oficial\ManoObraMensualController@store'); //crear
    Route::get('/mano_obra/{id}/edit', 'Oficial\ManoObraMensualController@edit'); //formulario de edicion
    Route::post('/mano_obra/{id}/edit', 'Oficial\ManoObraMensualController@update'); //actualizar
    Route::delete('/mano_obra/{id}', 'Oficial\ManoObraMensualController@destroy'); //actualizar

    //RUTAS DE VENTA COMERCIALIZACION DE PRODUCTOS
    Route::get('/venta_comercializacion_producto/', 'Oficial\VentaComercializacionProductoController@index'); //listado
    Route::get('/venta_comercializacion_producto/create', 'Oficial\VentaComercializacionProductoController@create'); //crear
    Route::post('/venta_comercializacion_producto/', 'Oficial\VentaComercializacionProductoController@import'); //crear
    Route::get('/venta_comercializacion_producto/descarga', 'Oficial\VentaComercializacionProductoController@download'); //listado
    Route::get('/venta_comercializacion_producto/descarga_transporte', 'Oficial\VentaComercializacionProductoController@download_transporte'); //listado
    Route::get('/venta_comercializacion_producto/comercio', 'Oficial\VentaComercializacionProductoController@download_comercio'); //listado
    Route::get('/venta_comercializacion_producto/{id}/edit', 'Oficial\VentaComercializacionProductoController@edit'); //formulario de edicion
    Route::post('/venta_comercializacion_producto/{id}/edit', 'Oficial\VentaComercializacionProductoController@update'); //actualizar
    Route::delete('/venta_comercializacion_producto/{id}', 'Oficial\VentaComercializacionProductoController@destroy'); //actualizar

    //rutas de gastos familiares
    Route::get('/gastos_familiares/', 'Oficial\GastosFamiliaresController@index'); //listado
    Route::get('/gastos_familiares/create', 'Oficial\GastosFamiliaresController@create'); //crear
    Route::post('/gastos_familiares/', 'Oficial\GastosFamiliaresController@store'); //crear
    Route::get('/gastos_familiares/{id}/edit', 'Oficial\GastosFamiliaresController@edit'); //formulario de edicion
    Route::post('/gastos_familiares/{id}/edit', 'Oficial\GastosFamiliaresController@update'); //actualizar
    Route::delete('/gastos_familiares/{id}', 'Oficial\GastosFamiliaresController@destroy'); //actualizar

    //Rutas Gastos Operativos
    Route::get('/gastos_operativos/', 'Oficial\GastosOperativosComercializacionController@index'); //listado
    Route::get('/gastos_operativos/create', 'Oficial\GastosOperativosComercializacionController@create'); //crear
    Route::post('/gastos_operativos/', 'Oficial\GastosOperativosComercializacionController@store'); //crear
    Route::get('/gastos_operativos/{id}/edit', 'Oficial\GastosOperativosComercializacionController@edit'); //formulario de edicion
    Route::post('/gastos_operativos/{id}/edit', 'Oficial\GastosOperativosComercializacionController@update'); //actualizar
    Route::delete('/gastos_operativos/{id}', 'Oficial\GastosOperativosComercializacionController@destroy'); //actualizar

    //Rutas Capacidad de pago
    Route::get('/capacidad_pago/', 'Oficial\CapacidadPagoController@index'); //listado
    Route::get('/capacidad_pago/create', 'Oficial\CapacidadPagoController@create'); //crear
    Route::post('/capacidad_pago/', 'Oficial\CapacidadPagoController@store'); //crear
    Route::get('/capacidad_pago/{id}/edit', 'Oficial\CapacidadPagoController@edit'); //formulario de edicion
    Route::post('/capacidad_pago/{id}/edit', 'Oficial\CapacidadPagoController@update'); //actualizar
    Route::delete('/capacidad_pago/{id}', 'Oficial\CapacidadPagoController@destroy'); //actualizar

    //Rutas Prestamo bancario
    Route::get('/prestamo_bancario/', 'Oficial\PrestamoBancarioController@index'); //listado
    Route::get('/prestamo_bancario/create', 'Oficial\PrestamoBancarioController@create'); //crear
    Route::post('/prestamo_bancario/', 'Oficial\PrestamoBancarioController@store'); //crear
    Route::get('/prestamo_bancario/{id}/edit', 'Oficial\PrestamoBancarioController@edit'); //formulario de edicion
    Route::post('/prestamo_bancario/{id}/edit', 'Oficial\PrestamoBancarioController@update'); //actualizar
    Route::delete('/prestamo_bancario/{id}', 'Oficial\PrestamoBancarioController@destroy'); //actualizar

    //ruta solicitud de credito
    Route::get('/credito/', 'Oficial\CreditoController@index'); //listado
    Route::get('/credito/create', 'Oficial\CreditoController@create'); //crear
    Route::post('/credito/', 'Oficial\CreditoController@store'); //crear
    Route::get('/credito/{id}/edit', 'Oficial\CreditoController@edit'); //formulario de edicion
    Route::post('/credito/{id}/edit', 'Oficial\CreditoController@update'); //actualizar
    Route::delete('/credito/{id}', 'Oficial\CreditoController@destroy'); //actualizar

    //ruta direccion
    Route::get('/direccion/', 'Oficial\DireccionController@index'); //listado
    Route::get('/direccion/create', 'Oficial\DireccionController@create'); //crear
    Route::post('/direccion/', 'Oficial\DireccionController@store'); //crear
    Route::get('/direccion/{id}/edit', 'Oficial\DireccionController@edit'); //formulario de edicion
    Route::post('/direccion/{id}/edit', 'Oficial\DireccionController@update'); //actualizar
    Route::delete('/direccion/{id}', 'Oficial\DireccionController@destroy'); //actualizar
    //ruta actividad economica
    Route::get('/actividad_economica/', 'Oficial\ActividadEconomicaController@index'); //listado
    Route::get('/actividad_economica/create', 'Oficial\ActividadEconomicaController@create'); //crear
    Route::post('/actividad_economica/', 'Oficial\ActividadEconomicaController@store'); //crear
    Route::get('/actividad_economica/{id}/edit', 'Oficial\ActividadEconomicaController@edit'); //formulario de edicion
    Route::post('/actividad_economica/{id}/edit', 'Oficial\ActividadEconomicaController@update'); //actualizar
    Route::delete('/actividad_economica/{id}', 'Oficial\ActividadEconomicaController@destroy'); //actualizar
    //ruta datos empresa
    Route::get('/datos_empresa/', 'Oficial\DatosEmpresaController@index'); //listado
    Route::get('/datos_empresa/create', 'Oficial\DatosEmpresaController@create'); //crear
    Route::post('/datos_empresa/', 'Oficial\DatosEmpresaController@store'); //crear
    Route::get('/datos_empresa/{id}/edit', 'Oficial\DatosEmpresaController@edit'); //formulario de edicion
    Route::post('/datos_empresa/{id}/edit', 'Oficial\DatosEmpresaController@update'); //actualizar
    Route::delete('/datos_empresa/{id}', 'Oficial\DatosEmpresaController@destroy'); //actualizar
    //Rutas Prestamo bancario
    Route::get('/prestamo_bancario/', 'Oficial\PrestamoBancarioController@index'); //listado
    Route::get('/prestamo_bancario/create', 'Oficial\PrestamoBancarioController@create'); //crear
    Route::post('/prestamo_bancario/', 'Oficial\PrestamoBancarioController@store'); //crear
    Route::get('/prestamo_bancario/{id}/edit', 'Oficial\PrestamoBancarioController@edit'); //formulario de edicion
    Route::post('/prestamo_bancario/{id}/edit', 'Oficial\PrestamoBancarioController@update'); //actualizar
    Route::delete('/prestamo_bancario/{id}', 'Oficial\PrestamoBancarioController@destroy'); //actualizar
    //Rutas C2
    //Rutas Deposito bancario
    Route::get('/deposito_bancario/', 'Oficial\DepositoBancarioController@index'); //listado
    Route::get('/deposito_bancario/create', 'Oficial\DepositoBancarioController@create'); //crear
    Route::post('/deposito_bancario/', 'Oficial\DepositoBancarioController@store'); //crear
    Route::get('/deposito_bancario/{id}/edit', 'Oficial\DepositoBancarioController@edit'); //formulario de edicion
    Route::post('/deposito_bancario/{id}/edit', 'Oficial\DepositoBancarioController@update'); //actualizar
    Route::delete('/deposito_bancario/{id}', 'Oficial\DepositoBancarioController@destroy'); //actualizar
    //Rutas Cuentas Documentos por Cobrar
    Route::get('/cuentas_documentos_cobrar/', 'Oficial\CuentasDocumentosCobrarController@index'); //listado
    Route::get('/cuentas_documentos_cobrar/create', 'Oficial\CuentasDocumentosCobrarController@create'); //crear
    Route::post('/cuentas_documentos_cobrar/', 'Oficial\CuentasDocumentosCobrarController@store'); //crear
    Route::get('/cuentas_documentos_cobrar/{id}/edit', 'Oficial\CuentasDocumentosCobrarController@edit'); //formulario de edicion
    Route::post('/cuentas_documentos_cobrar/{id}/edit', 'Oficial\CuentasDocumentosCobrarController@update'); //actualizar
    Route::delete('/cuentas_documentos_cobrar/{id}', 'Oficial\CuentasDocumentosCobrarController@destroy'); //actualizar

    //Rutas Inversiones financieras
    Route::get('/inversiones_financieras/', 'Oficial\InversionesFinancierasController@index'); //listado
    Route::get('/inversiones_financieras/create', 'Oficial\InversionesFinancierasController@create'); //crear
    Route::post('/inversiones_financieras/', 'Oficial\InversionesFinancierasController@store'); //crear
    Route::get('/inversiones_financieras/{id}/edit', 'Oficial\InversionesFinancierasController@edit'); //formulario de edicion
    Route::post('/inversiones_financieras/{id}/edit', 'Oficial\InversionesFinancierasController@update'); //actualizar
    Route::delete('/inversiones_financieras/{id}', 'Oficial\InversionesFinancierasController@destroy'); //actualizar

    //rutas c5
    //rutas de gastos familiares
    Route::get('/garantias/', 'Oficial\GarantiaController@index'); //listado
    Route::get('/garantias/create', 'Oficial\GarantiaController@create'); //crear
    Route::post('/garantias/', 'Oficial\GarantiaController@store'); //crear
    Route::get('/garantias/{id}/edit', 'Oficial\GarantiaController@edit'); //formulario de edicion
    Route::post('/garantias/{id}/edit', 'Oficial\GarantiaController@update'); //actualizar
    //Route::delete('/garantias/{id}', 'Oficial\GarantiaController@destroy');//actualizar

    //rutas c1
    //rutas persona
    Route::get('/persona/', 'Oficial\PersonaController@index'); //listado
    Route::get('/persona/create', 'Oficial\PersonaController@create'); //crear
    Route::post('/persona/', 'Oficial\PersonaController@store'); //crear
    Route::get('/persona/{id}/edit', 'Oficial\PersonaController@edit'); //formulario de edicion
    Route::post('/persona/{id}/edit', 'Oficial\PersonaController@update'); //actualizar
    //Route::delete('/persona/{id}', 'Oficial\PersonaController@destroy');//actualizar
    //rutas c2

    //Rutas Inmuebles
    Route::get('/inmueble/', 'Oficial\InmuebleController@index'); //listado
    Route::get('/inmueble/create', 'Oficial\InmuebleController@create'); //crear
    Route::post('/inmueble/', 'Oficial\InmuebleController@store'); //crear
    Route::get('/inmueble/{id}/edit', 'Oficial\InmuebleController@edit'); //formulario de edicion
    Route::post('/inmueble/{id}/edit', 'Oficial\InmuebleController@update'); //actualizar
    Route::delete('/inmueble/{id}', 'Oficial\InmuebleController@destroy'); //actualizar
    //Rutas Vehiculo
    Route::get('/vehiculo/', 'Oficial\VehiculoController@index'); //listado
    Route::get('/vehiculo/create', 'Oficial\VehiculoController@create'); //crear
    Route::post('/vehiculo/', 'Oficial\VehiculoController@store'); //crear
    Route::get('/vehiculo/{id}/edit', 'Oficial\VehiculoController@edit'); //formulario de edicion
    Route::post('/vehiculo/{id}/edit', 'Oficial\VehiculoController@update'); //actualizar
    Route::delete('/vehiculo/{id}', 'Oficial\VehiculoController@destroy'); //actualizar
    //Rutas Maquinaria
    Route::get('/maquinaria_equipo/', 'Oficial\MaquinariaEquipoController@index'); //listado
    Route::get('/maquinaria_equipo/create', 'Oficial\MaquinariaEquipoController@create'); //crear
    Route::post('/maquinaria_equipo/', 'Oficial\MaquinariaEquipoController@store'); //crear
    Route::get('/maquinaria_equipo/{id}/edit', 'Oficial\MaquinariaEquipoController@edit'); //formulario de edicion
    Route::post('/maquinaria_equipo/{id}/edit', 'Oficial\MaquinariaEquipoController@update'); //actualizar
    Route::delete('/maquinaria_equipo/{id}', 'Oficial\MaquinariaEquipoController@destroy'); //actualizar
    //Rutas Inventario de mercaderias
    Route::get('/inventario_mercaderia/', 'Oficial\InventarioMercaderiaController@index'); //listado
    Route::get('/inventario_mercaderia/create', 'Oficial\InventarioMercaderiaController@create'); //crear
    Route::post('/inventario_mercaderia/', 'Oficial\InventarioMercaderiaController@store'); //crear
    Route::get('/inventario_mercaderia/{id}/edit', 'Oficial\InventarioMercaderiaController@edit'); //formulario de edicion
    Route::post('/inventario_mercaderia/{id}/edit', 'Oficial\InventarioMercaderiaController@update'); //actualizar
    Route::delete('/inventario_mercaderia/{id}', 'Oficial\InventarioMercaderiaController@destroy'); //actualizar
    //Rutas Cuentas por Pagar
    Route::get('/cuentas_por_pagar/', 'Oficial\CuentasPagarController@index'); //listado
    Route::get('/cuentas_por_pagar/create', 'Oficial\CuentasPagarController@create'); //crear
    Route::post('/cuentas_por_pagar/', 'Oficial\CuentasPagarController@store'); //crear
    Route::get('/cuentas_por_pagar/{id}/edit', 'Oficial\CuentasPagarController@edit'); //formulario de edicion
    Route::post('/cuentas_por_pagar/{id}/edit', 'Oficial\CuentasPagarController@update'); //actualizar
    Route::delete('/cuentas_por_pagar/{id}', 'Oficial\CuentasPagarController@destroy'); //actualizar
    //Rutas de formulario de reporte
    Route::get('/formulario/', 'Oficial\FormularioController@index'); //listado
    Route::get('/formulario/{id}/formulario', 'Oficial\FormularioController@formulario'); //formulario de edicion
    //Rutas Conyugues
    Route::get('/conyugue/', 'Oficial\ConyugueController@index'); //listado
    Route::get('/conyugue/create', 'Oficial\ConyugueController@create'); //crear
    Route::post('/conyugue/', 'Oficial\ConyugueController@store'); //crear
    Route::get('/conyugue/{id}/edit', 'Oficial\ConyugueController@edit'); //formulario de edicion
    Route::post('/conyugue/{id}/edit', 'Oficial\ConyugueController@update'); //actualizar
    Route::delete('/conyugue/{id}', 'Oficial\ConyugueController@destroy'); //actualizar
    //Rutas detalle conyugue
    Route::get('/detalle_conyugue/', 'Oficial\DetalleConyugueController@index'); //listado
    Route::get('/detalle_conyugue/create', 'Oficial\DetalleConyugueController@create'); //crear
    Route::post('/detalle_conyugue/', 'Oficial\DetalleConyugueController@store'); //crear
    Route::get('/detalle_conyugue/{id}/edit', 'Oficial\DetalleConyugueController@edit'); //formulario de edicion
    Route::post('/detalle_conyugue/{id}/edit', 'Oficial\DetalleConyugueController@update'); //actualizar
    Route::delete('/detalle_conyugue/{id}', 'Oficial\DetalleConyugueController@destroy'); //actualizar
    //-----------------GARANTES BEGIN------------------
    //Ruta Garante
    Route::get('/garante/', 'Oficial\GaranteController@index'); //listado
    Route::get('/garante/create', 'Oficial\GaranteController@create'); //crear
    Route::post('/garante/', 'Oficial\GaranteController@store'); //crear
    Route::get('/garante/{id}/edit', 'Oficial\GaranteController@edit'); //formulario de edicion
    Route::post('/garante/{id}/edit', 'Oficial\GaranteController@update'); //actualizar
    Route::delete('/garante/{id}', 'Oficial\GaranteController@destroy'); //actualizar
    // GARANTES END
    //Rutas Codeudores
    Route::get('/codeudor/', 'Oficial\CodeudorController@index'); //listado
    Route::get('/codeudor/create', 'Oficial\CodeudorController@create'); //crear
    Route::post('/codeudor/', 'Oficial\CodeudorController@store'); //crear
    Route::get('/codeudor/{id}/edit', 'Oficial\CodeudorController@edit'); //formulario de edicion
    Route::post('/codeudor/{id}/edit', 'Oficial\CodeudorController@update'); //actualizar
    Route::delete('/codeudor/{id}', 'Oficial\CodeudorController@destroy'); //actualizar
    //Rutas usuario
    Route::get('/user', 'Oficial\UserController@index'); //listado
    Route::get('/user/{id}/edit', 'Oficial\UserController@edit'); //formulario de edicion
    Route::get('/user/edit_photo', 'Oficial\UserController@edit_photo'); //formulario de edicion
    Route::patch('/user/{id}/edit_datos', 'Oficial\UserController@update_datos'); //actualizar
    Route::patch('/user/{id}/edit_picture', 'Oficial\UserController@update_picture'); //actualizar
    //Rutas bienes hogar
    Route::get('/bienes_hogar/', 'Oficial\BienesHogarController@index'); //listado
    Route::get('/bienes_hogar/create', 'Oficial\BienesHogarController@create'); //crear
    Route::post('/bienes_hogar/', 'Oficial\BienesHogarController@store'); //crear
    Route::get('/bienes_hogar/{id}/edit', 'Oficial\BienesHogarController@edit'); //formulario de edicion
    Route::post('/bienes_hogar/{id}/edit', 'Oficial\BienesHogarController@update'); //actualizar
    Route::delete('/bienes_hogar/{id}', 'Oficial\BienesHogarController@destroy'); //actualizar
    //Rutas Efectivos en Caja
    Route::get('/efectivos_caja/', 'Oficial\EfectivoCajaController@index'); //listado
    Route::get('/efectivos_caja/create', 'Oficial\EfectivoCajaController@create'); //crear
    Route::post('/efectivos_caja/', 'Oficial\EfectivoCajaController@store'); //crear
    Route::get('/efectivos_caja/{id}/edit', 'Oficial\EfectivoCajaController@edit'); //formulario de edicion
    Route::post('/efectivos_caja/{id}/edit', 'Oficial\EfectivoCajaController@update'); //actualizar
    Route::delete('/efectivos_caja/{id}', 'Oficial\EfectivoCajaController@destroy'); //actualizar
    //Rutas Otros Activos
    Route::get('/otros_activos/', 'Oficial\OtroActivoController@index'); //listado
    Route::get('/otros_activos/create', 'Oficial\OtroActivoController@create'); //crear
    Route::post('/otros_activos/', 'Oficial\OtroActivoController@store'); //crear
    Route::get('/otros_activos/{id}/edit', 'Oficial\OtroActivoController@edit'); //formulario de edicion
    Route::post('/otros_activos/{id}/edit', 'Oficial\OtroActivoController@update'); //actualizar
    Route::delete('/otros_activos/{id}', 'Oficial\OtroActivoController@destroy'); //actualizar
    //rutas seguimiento
    Route::get('/seguimiento/', 'Oficial\SeguimientoController@index'); //listado
    Route::get('/seguimiento/create', 'Oficial\SeguimientoController@create'); //crear
    Route::post('/seguimiento/', 'Oficial\SeguimientoController@store'); //crear
    Route::get('/seguimiento/{id}/edit_fin', 'Oficial\SeguimientoController@edit_fin'); //formulario de edicion
    Route::post('/seguimiento/{id}/edit_fin', 'Oficial\SeguimientoController@update_fin'); //actualizar
    Route::get('/seguimiento/{id}/edit_derivar', 'Oficial\SeguimientoController@edit_derivar'); //formulario de edicion
    Route::post('/seguimiento/{id}/edit_derivar', 'Oficial\SeguimientoController@update_derivar'); //
    //Rutas de Reporte solicitud Modulo reportes
    Route::get('/solicitud', 'Oficial\ReporteOficialController@solicitudOficial');
    Route::get('/caratulas', 'Oficial\ReporteOficialController@caratulasOficial');
    Route::get('/control_documentos', 'Oficial\ReporteOficialController@controlDocumentos');
    Route::get('/informe_credito', 'Oficial\ReporteOficialController@informeCredito');
    //Rutas de Fotografias
    Route::get('/foto/', 'Oficial\FotoController@index'); //listado
    Route::get('/foto/create', 'Oficial\FotoController@create'); //crear
    Route::post('/foto/', 'Oficial\FotoController@store'); //crear
    Route::get('/foto/{id}/edit', 'Oficial\FotoController@edit'); //formulario de edicion
    Route::post('/foto/{id}/edit', 'Oficial\FotoController@update'); //actualizar
    Route::delete('/foto/{id}', 'Oficial\FotoController@destroy'); //actualizar
    Route::get('/foto/{id}/descarga', 'Oficial\FotoController@descarga'); //actualizar
    //Rutas de archivos
    Route::get('/archivo/', 'Oficial\ArchivoController@index'); //listado
    Route::get('/archivo/create', 'Oficial\ArchivoController@create'); //crear
    Route::post('/archivo/', 'Oficial\ArchivoController@store'); //crear
    Route::get('/archivo/{id}/edit', 'Oficial\ArchivoController@edit'); //formulario de edicion
    Route::post('/archivo/{id}/edit', 'Oficial\ArchivoController@update'); //actualizar
    Route::delete('/archivo/{id}', 'Oficial\ArchivoController@destroy'); //actualizar
    Route::get('/archivo/{id}/descarga', 'Oficial\ArchivoController@descarga'); //actualizar
    //Rutas control de documentos
    //Rutas Referencias Solicitante
    Route::get('/referencias_solicitante/', 'Oficial\ReferenciaSolicitanteController@index'); //listado
    Route::get('/referencias_solicitante/create', 'Oficial\ReferenciaSolicitanteController@create'); //crear
    Route::post('/referencias_solicitante/', 'Oficial\ReferenciaSolicitanteController@store'); //crear
    Route::get('/referencias_solicitante/{id}/edit', 'Oficial\ReferenciaSolicitanteController@edit'); //formulario de edicion
    Route::post('/referencias_solicitante/{id}/edit', 'Oficial\ReferenciaSolicitanteController@update'); //actualizar
    Route::delete('/referencias_solicitante/{id}', 'Oficial\ReferenciaSolicitanteController@destroy'); //actualizar

    //Rutas Tipo Cambio
    Route::get('/tipo_cambio/', 'Oficial\TipoCambioController@index'); //listado
    Route::get('/tipo_cambio/create', 'Oficial\TipoCambioController@create'); //crear
    Route::post('/tipo_cambio/', 'Oficial\TipoCambioController@store'); //crear
    Route::get('/tipo_cambio/{id}/edit', 'Oficial\TipoCambioController@edit'); //formulario de edicion
    Route::post('/tipo_cambio/{id}/edit', 'Oficial\TipoCambioController@update'); //actualizar
    Route::delete('/tipo_cambio/{id}', 'Oficial\TipoCambioController@destroy'); //actualizar

    //RUTAS DE GARANTES------------BEGIN
    //rutas direccion garante
    Route::get('/a_garantes/direccion/', 'Oficial\DireccionGaranteController@index'); //listado
    Route::get('/a_garantes/direccion/create', 'Oficial\DireccionGaranteController@create'); //crear
    Route::post('/a_garantes/direccion/', 'Oficial\DireccionGaranteController@store'); //crear
    Route::get('/a_garantes/direccion/{id}/edit', 'Oficial\DireccionGaranteController@edit'); //formulario de edicion
    Route::post('/a_garantes/direccion/{id}/edit', 'Oficial\DireccionGaranteController@update'); //actualizar
    Route::delete('/a_garantes/direccion/{id}', 'Oficial\DireccionGaranteController@destroy'); //actualizar
    //rutas datos empresa garante
    //ruta datos empresa
    Route::get('/a_garantes/datos_empresa/', 'Oficial\DatosEmpresaGaranteController@index'); //listado
    Route::get('/a_garantes/datos_empresa/create', 'Oficial\DatosEmpresaGaranteController@create'); //crear
    Route::post('/a_garantes/datos_empresa/', 'Oficial\DatosEmpresaGaranteController@store'); //crear
    Route::get('/a_garantes/datos_empresa/{id}/edit', 'Oficial\DatosEmpresaGaranteController@edit'); //formulario de edicion
    Route::post('/a_garantes/datos_empresa/{id}/edit', 'Oficial\DatosEmpresaGaranteController@update'); //actualizar
    Route::delete('/a_garantes/datos_empresa/{id}', 'Oficial\DatosEmpresaGaranteController@destroy'); //actualizar
//ruta actividad economica
    Route::get('/a_garantes/actividad_economica/', 'Oficial\ActividadEconomicaGaranteController@index'); //listado
    Route::get('/a_garantes/actividad_economica/create', 'Oficial\ActividadEconomicaGaranteController@create'); //crear
    Route::post('/a_garantes/actividad_economica/', 'Oficial\ActividadEconomicaGaranteController@store'); //crear
    Route::get('/a_garantes/actividad_economica/{id}/edit', 'Oficial\ActividadEconomicaGaranteController@edit'); //formulario de edicion
    Route::post('/a_garantes/actividad_economica/{id}/edit', 'Oficial\ActividadEconomicaGaranteController@update'); //actualizar
    Route::delete('/a_garantes/actividad_economica/{id}', 'Oficial\ActividadEconomicaGaranteController@destroy'); //actualizar

    //Rutas Referencias Del garante
    Route::get('/a_garantes/referencias_solicitante/', 'Oficial\ReferenciaSolicitanteGaranteController@index'); //listado
    Route::get('/a_garantes/referencias_solicitante/create', 'Oficial\ReferenciaSolicitanteGaranteController@create'); //crear
    Route::post('/a_garantes/referencias_solicitante/', 'Oficial\ReferenciaSolicitanteGaranteController@store'); //crear
    Route::get('/a_garantes/referencias_solicitante/{id}/edit', 'Oficial\ReferenciaSolicitanteGaranteController@edit'); //formulario de edicion
    Route::post('/a_garantes/referencias_solicitante/{id}/edit', 'Oficial\ReferenciaSolicitanteGaranteController@update'); //actualizar
    Route::delete('/a_garantes/referencias_solicitante/{id}', 'Oficial\ReferenciaSolicitanteGaranteController@destroy'); //actualizar

    //Rutas Deposito bancario
    Route::get('/a_garantes/deposito_bancario/', 'Oficial\DepositoBancarioGaranteController@index'); //listado
    Route::get('/a_garantes/deposito_bancario/create', 'Oficial\DepositoBancarioGaranteController@create'); //crear
    Route::post('/a_garantes/deposito_bancario/', 'Oficial\DepositoBancarioGaranteController@store'); //crear
    Route::get('/a_garantes/deposito_bancario/{id}/edit', 'Oficial\DepositoBancarioGaranteController@edit'); //formulario de edicion
    Route::post('/a_garantes/deposito_bancario/{id}/edit', 'Oficial\DepositoBancarioGaranteController@update'); //actualizar
    Route::delete('/a_garantes/deposito_bancario/{id}', 'Oficial\DepositoBancarioGaranteController@destroy'); //actualizar

    //Rutas Inversiones financieras
    Route::get('/a_garantes/inversiones_financieras/', 'Oficial\InversionesFinancierasGaranteController@index'); //listado
    Route::get('/a_garantes/inversiones_financieras/create', 'Oficial\InversionesFinancierasGaranteController@create'); //crear
    Route::post('/a_garantes/inversiones_financieras/', 'Oficial\InversionesFinancierasGaranteController@store'); //crear
    Route::get('/a_garantes/inversiones_financieras/{id}/edit', 'Oficial\InversionesFinancierasGaranteController@edit'); //formulario de edicion
    Route::post('/a_garantes/inversiones_financieras/{id}/edit', 'Oficial\InversionesFinancierasGaranteController@update'); //actualizar
    Route::delete('/a_garantes/inversiones_financieras/{id}', 'Oficial\InversionesFinancierasGaranteController@destroy'); //actualizar

    //Rutas Cuentas Documentos por Cobrar
    Route::get('/a_garantes/cuentas_documentos_cobrar/', 'Oficial\CuentasDocumentosCobrarGaranteController@index'); //listado
    Route::get('/a_garantes/cuentas_documentos_cobrar/create', 'Oficial\CuentasDocumentosCobrarGaranteController@create'); //crear
    Route::post('/a_garantes/cuentas_documentos_cobrar/', 'Oficial\CuentasDocumentosCobrarGaranteController@store'); //crear
    Route::get('/a_garantes/cuentas_documentos_cobrar/{id}/edit', 'Oficial\CuentasDocumentosCobrarGaranteController@edit'); //formulario de edicion
    Route::post('/a_garantes/cuentas_documentos_cobrar/{id}/edit', 'Oficial\CuentasDocumentosCobrarGaranteController@update'); //actualizar
    Route::delete('/a_garantes/cuentas_documentos_cobrar/{id}', 'Oficial\CuentasDocumentosCobrarGaranteController@destroy'); //actualizar

     //Rutas Inventario de mercaderias
    Route::get('/a_garantes/inventario_mercaderia/', 'Oficial\InventarioMercaderiaGaranteController@index'); //listado
    Route::get('/a_garantes/inventario_mercaderia/create', 'Oficial\InventarioMercaderiaGaranteController@create'); //crear
    Route::post('/a_garantes/inventario_mercaderia/', 'Oficial\InventarioMercaderiaGaranteController@store'); //crear
    Route::get('/a_garantes/inventario_mercaderia/{id}/edit', 'Oficial\InventarioMercaderiaGaranteController@edit'); //formulario de edicion
    Route::post('/a_garantes/inventario_mercaderia/{id}/edit', 'Oficial\InventarioMercaderiaGaranteController@update'); //actualizar
    Route::delete('/a_garantes/inventario_mercaderia/{id}', 'Oficial\InventarioMercaderiaGaranteController@destroy'); //actualizar

     //Rutas Maquinaria
    Route::get('/a_garantes/maquinaria_equipo/', 'Oficial\MaquinariaEquipoGaranteController@index'); //listado
    Route::get('/a_garantes/maquinaria_equipo/create', 'Oficial\MaquinariaEquipoGaranteController@create'); //crear
    Route::post('/a_garantes/maquinaria_equipo/', 'Oficial\MaquinariaEquipoGaranteController@store'); //crear
    Route::get('/a_garantes/maquinaria_equipo/{id}/edit', 'Oficial\MaquinariaEquipoGaranteController@edit'); //formulario de edicion
    Route::post('/a_garantes/maquinaria_equipo/{id}/edit', 'Oficial\MaquinariaEquipoGaranteController@update'); //actualizar
    Route::delete('/a_garantes/maquinaria_equipo/{id}', 'Oficial\MaquinariaEquipoGaranteController@destroy'); //actualizar

    //Rutas bienes hogar
    Route::get('/a_garantes/bienes_hogar/', 'Oficial\BienesHogarGaranteController@index'); //listado
    Route::get('/a_garantes/bienes_hogar/create', 'Oficial\BienesHogarGaranteController@create'); //crear
    Route::post('/a_garantes/bienes_hogar/', 'Oficial\BienesHogarGaranteController@store'); //crear
    Route::get('/a_garantes/bienes_hogar/{id}/edit', 'Oficial\BienesHogarGaranteController@edit'); //formulario de edicion
    Route::post('/a_garantes/bienes_hogar/{id}/edit', 'Oficial\BienesHogarGaranteController@update'); //actualizar
    Route::delete('/a_garantes/bienes_hogar/{id}', 'Oficial\BienesHogarGaranteController@destroy'); //actualizar

    //Rutas Inmuebles
    Route::get('/a_garantes/inmueble/', 'Oficial\InmuebleGaranteController@index'); //listado
    Route::get('/a_garantes/inmueble/create', 'Oficial\InmuebleGaranteController@create'); //crear
    Route::post('/a_garantes/inmueble/', 'Oficial\InmuebleGaranteController@store'); //crear
    Route::get('/a_garantes/inmueble/{id}/edit', 'Oficial\InmuebleGaranteController@edit'); //formulario de edicion
    Route::post('/a_garantes/inmueble/{id}/edit', 'Oficial\InmuebleGaranteController@update'); //actualizar
    Route::delete('/a_garantes/inmueble/{id}', 'Oficial\InmuebleGaranteController@destroy'); //actualizar

    //Rutas Vehiculo
    Route::get('/a_garantes/vehiculo/', 'Oficial\VehiculoGaranteController@index'); //listado
    Route::get('/a_garantes/vehiculo/create', 'Oficial\VehiculoGaranteController@create'); //crear
    Route::post('/a_garantes/vehiculo/', 'Oficial\VehiculoGaranteController@store'); //crear
    Route::get('/a_garantes/vehiculo/{id}/edit', 'Oficial\VehiculoGaranteController@edit'); //formulario de edicion
    Route::post('/a_garantes/vehiculo/{id}/edit', 'Oficial\VehiculoGaranteController@update'); //actualizar
    Route::delete('/a_garantes/vehiculo/{id}', 'Oficial\VehiculoGaranteController@destroy'); //actualizar

    //Rutas Otros Activos
    Route::get('/a_garantes/otros_activos/', 'Oficial\OtroActivoGaranteController@index'); //listado
    Route::get('/a_garantes/otros_activos/create', 'Oficial\OtroActivoGaranteController@create'); //crear
    Route::post('/a_garantes/otros_activos/', 'Oficial\OtroActivoGaranteController@store'); //crear
    Route::get('/a_garantes/otros_activos/{id}/edit', 'Oficial\OtroActivoGaranteController@edit'); //formulario de edicion
    Route::post('/a_garantes/otros_activos/{id}/edit', 'Oficial\OtroActivoGaranteController@update'); //actualizar
    Route::delete('/a_garantes/otros_activos/{id}', 'Oficial\OtroActivoGaranteController@destroy'); //actualizar

    //Rutas Prestamo bancario
    Route::get('/a_garantes/prestamo_bancario/', 'Oficial\PrestamoBancarioGaranteController@index'); //listado
    Route::get('/a_garantes/prestamo_bancario/create', 'Oficial\PrestamoBancarioGaranteController@create'); //crear
    Route::post('/a_garantes/prestamo_bancario/', 'Oficial\PrestamoBancarioGaranteController@store'); //crear
    Route::get('/a_garantes/prestamo_bancario/{id}/edit', 'Oficial\PrestamoBancarioGaranteController@edit'); //formulario de edicion
    Route::post('/a_garantes/prestamo_bancario/{id}/edit', 'Oficial\PrestamoBancarioGaranteController@update'); //actualizar
    Route::delete('/a_garantes/prestamo_bancario/{id}', 'Oficial\PrestamoBancarioGaranteController@destroy'); //actualizar

     //Rutas Cuentas por Pagar
    Route::get('/a_garantes/cuentas_por_pagar/', 'Oficial\CuentasPagarGaranteController@index'); //listado
    Route::get('/a_garantes/cuentas_por_pagar/create', 'Oficial\CuentasPagarGaranteController@create'); //crear
    Route::post('/a_garantes/cuentas_por_pagar/', 'Oficial\CuentasPagarGaranteController@store'); //crear
    Route::get('/a_garantes/cuentas_por_pagar/{id}/edit', 'Oficial\CuentasPagarGaranteController@edit'); //formulario de edicion
    Route::post('/a_garantes/cuentas_por_pagar/{id}/edit', 'Oficial\CuentasPagarGaranteController@update'); //actualizar
    Route::delete('/a_garantes/cuentas_por_pagar/{id}', 'Oficial\CuentasPagarGaranteController@destroy'); //actualizar


 //Rutas Capacidad de pago garante
    Route::get('/a_garantes/capacidad_pago/', 'Oficial\CapacidadPagoGaranteController@index'); //listado
    Route::get('/a_garantes/capacidad_pago/create', 'Oficial\CapacidadPagoGaranteController@create'); //crear
    Route::post('/a_garantes/capacidad_pago/', 'Oficial\CapacidadPagoGaranteController@store'); //crear
    Route::get('/a_garantes/capacidad_pago/{id}/edit', 'Oficial\CapacidadPagoGaranteController@edit'); //formulario de edicion
    Route::post('/a_garantes/capacidad_pago/{id}/edit', 'Oficial\CapacidadPagoGaranteController@update'); //actualizar
    Route::delete('/a_garantes/capacidad_pago/{id}', 'Oficial\CapacidadPagoGaranteController@destroy'); //actualizar

    //rutas de mano de obra
    Route::get('/a_garantes/mano_obra/', 'Oficial\ManoObraMensualGaranteController@index'); //listado
    Route::get('/a_garantes/mano_obra/create', 'Oficial\ManoObraMensualGaranteController@create'); //crear
    Route::post('/a_garantes/mano_obra/', 'Oficial\ManoObraMensualGaranteController@store'); //crear
    Route::get('/a_garantes/mano_obra/{id}/edit', 'Oficial\ManoObraMensualGaranteController@edit'); //formulario de edicion
    Route::post('/a_garantes/mano_obra/{id}/edit', 'Oficial\ManoObraMensualGaranteController@update'); //actualizar
    Route::delete('/a_garantes/mano_obra/{id}', 'Oficial\ManoObraMensualGaranteController@destroy'); //actualizar

    //rutas de gastos familiares
    Route::get('/a_garantes/gastos_familiares/', 'Oficial\GastosFamiliaresGaranteController@index'); //listado
    Route::get('/a_garantes/gastos_familiares/create', 'Oficial\GastosFamiliaresGaranteController@create'); //crear
    Route::post('/a_garantes/gastos_familiares/', 'Oficial\GastosFamiliaresGaranteController@store'); //crear
    Route::get('/a_garantes/gastos_familiares/{id}/edit', 'Oficial\GastosFamiliaresGaranteController@edit'); //formulario de edicion
    Route::post('/a_garantes/gastos_familiares/{id}/edit', 'Oficial\GastosFamiliaresGaranteController@update'); //actualizar
    Route::delete('/a_garantes/gastos_familiares/{id}', 'Oficial\GastosFamiliaresGaranteController@destroy'); //actualizar

    //Rutas Gastos Operativos
    Route::get('/a_garantes/gastos_operativos/', 'Oficial\GastosOperativosComercializacionGaranteController@index'); //listado
    Route::get('/a_garantes/gastos_operativos/create', 'Oficial\GastosOperativosComercializacionGaranteController@create'); //crear
    Route::post('/a_garantes/gastos_operativos/', 'Oficial\GastosOperativosComercializacionGaranteController@store'); //crear
    Route::get('/a_garantes/gastos_operativos/{id}/edit', 'Oficial\GastosOperativosComercializacionGaranteController@edit'); //formulario de edicion
    Route::post('/a_garantes/gastos_operativos/{id}/edit', 'Oficial\GastosOperativosComercializacionGaranteController@update'); //actualizar
    Route::delete('/a_garantes/gastos_operativos/{id}', 'Oficial\GastosOperativosComercializacionGaranteController@destroy'); //actualizar

    //Rutas de croquis
    Route::get('/a_garantes/croquis/', 'Oficial\CroquisGaranteController@index'); //listado
    Route::get('/a_garantes/croquis/create', 'Oficial\CroquisGaranteController@create'); //crear
    Route::post('/a_garantes/croquis/', 'Oficial\CroquisGaranteController@store'); //crear
    Route::get('/a_garantes/croquis/{id}/see', 'Oficial\CroquisGaranteController@see'); //formulario para ver mapa
    Route::post('/a_garantes/croquis/{id}/edit', 'Oficial\CroquisGaranteController@update'); //actualizar
    Route::get('/a_garantes/croquis/{id}/edit', 'Oficial\CroquisGaranteController@edit'); //actualizar
    Route::delete('/a_garantes/croquis/{id}', 'Oficial\CroquisGaranteController@destroy'); //actualizar

    //rutas de ingreso mensual
    Route::get('/a_garantes/ingreso_mensual/', 'Oficial\IngresoMensualGaranteController@index'); //listado
    Route::get('/a_garantes/ingreso_mensual/create', 'Oficial\IngresoMensualGaranteController@create'); //crear
    Route::post('/a_garantes/ingreso_mensual/', 'Oficial\IngresoMensualGaranteController@import'); //crear
    Route::get('/a_garantes/ingreso_mensual/descarga', 'Oficial\IngresoMensualGaranteController@download'); //listado
    Route::get('/a_garantes/ingreso_mensual/{id}/edit', 'Oficial\IngresoMensualGaranteController@edit'); //formulario de edicion
    Route::post('/a_garantes/ingreso_mensual/{id}/edit', 'Oficial\IngresoMensualGaranteController@update'); //actualizar

   //RUTAS DE VENTA COMERCIALIZACION DE PRODUCTOS
    Route::get('/a_garantes/venta_comercializacion_producto/', 'Oficial\VentaComercializacionProductoGaranteController@index'); //listado
    Route::get('/a_garantes/venta_comercializacion_producto/create', 'Oficial\VentaComercializacionProductoGaranteController@create'); //crear
    Route::post('/a_garantes/venta_comercializacion_producto/', 'Oficial\VentaComercializacionProductoGaranteController@import'); //crear
    Route::get('/a_garantes/venta_comercializacion_producto/descarga', 'Oficial\VentaComercializacionProductoGaranteController@download'); //listado
    Route::get('/a_garantes/venta_comercializacion_producto/descarga_transporte', 'Oficial\VentaComercializacionProductoGaranteController@download_transporte'); //listado
    Route::get('/a_garantes/venta_comercializacion_producto/comercio', 'Oficial\VentaComercializacionProductoGaranteController@download_comercio'); //listado
    Route::get('/a_garantes/venta_comercializacion_producto/{id}/edit', 'Oficial\VentaComercializacionProductoGaranteController@edit'); //formulario de edicion
    Route::post('/a_garantes/venta_comercializacion_producto/{id}/edit', 'Oficial\VentaComercializacionProductoGaranteController@update'); //actualizar
    Route::delete('/a_garantes/venta_comercializacion_producto/{id}', 'Oficial\VentaComercializacionProductoGaranteController@destroy'); //actualizar

    //Rutas de formulario de reporte
    Route::get('/a_garantes/formulario/', 'Oficial\FormularioGaranteController@index'); //listado
    Route::get('/a_garantes/formulario/{id}/formulario', 'Oficial\FormularioGaranteController@formulario'); //formulario de edicion

     //Rutas Efectivos en Caja
    Route::get('/a_garantes/efectivos_caja/', 'Oficial\EfectivoCajaGaranteController@index'); //listado
    Route::get('/a_garantes/efectivos_caja/create', 'Oficial\EfectivoCajaGaranteController@create'); //crear
    Route::post('/a_garantes/efectivos_caja/', 'Oficial\EfectivoCajaGaranteController@store'); //crear
    Route::get('/a_garantes/efectivos_caja/{id}/edit', 'Oficial\EfectivoCajaGaranteController@edit'); //formulario de edicion
    Route::post('/a_garantes/efectivos_caja/{id}/edit', 'Oficial\EfectivoCajaGaranteController@update'); //actualizar
    Route::delete('/a_garantes/efectivos_caja/{id}', 'Oficial\EfectivoCajaGaranteController@destroy'); //actualizar

    //Rutas Capacidad de pago
    Route::get('/a_garantes/capacidad_pago/', 'Oficial\CapacidadPagoGaranteController@index'); //listado
    Route::get('/a_garantes/capacidad_pago/create', 'Oficial\CapacidadPagoGaranteController@create'); //crear
    Route::post('/a_garantes/capacidad_pago/', 'Oficial\CapacidadPagoGaranteController@store'); //crear
    Route::get('/a_garantes/capacidad_pago/{id}/edit', 'Oficial\CapacidadPagoGaranteController@edit'); //formulario de edicion
    Route::post('/a_garantes/capacidad_pago/{id}/edit', 'Oficial\CapacidadPagoGaranteController@update'); //actualizar
    Route::delete('/a_garantes/capacidad_pago/{id}', 'Oficial\CapacidadPagoGaranteController@destroy'); //actualizar

    //Rutas Conyugues
    Route::get('/a_garantes/conyugue/', 'Oficial\ConyugueGaranteController@index'); //listado
    Route::get('/a_garantes/conyugue/create', 'Oficial\ConyugueGaranteController@create'); //crear
    Route::post('/a_garantes/conyugue/', 'Oficial\ConyugueGaranteController@store'); //crear
    Route::get('/a_garantes/conyugue/{id}/edit', 'Oficial\ConyugueGaranteController@edit'); //formulario de edicion
    Route::post('/a_garantes/conyugue/{id}/edit', 'Oficial\ConyugueGaranteController@update'); //actualizar
    Route::delete('/a_garantes/conyugue/{id}', 'Oficial\ConyugueGaranteController@destroy'); //actualizar

    //Rutas detalle conyugue
    Route::get('/a_garantes/detalle_conyugue/', 'Oficial\DetalleConyugueGaranteController@index'); //listado
    Route::get('/a_garantes/detalle_conyugue/create', 'Oficial\DetalleConyugueGaranteController@create'); //crear
    Route::post('/a_garantes/detalle_conyugue/', 'Oficial\DetalleConyugueGaranteController@store'); //crear
    Route::get('/a_garantes/detalle_conyugue/{id}/edit', 'Oficial\DetalleConyugueGaranteController@edit'); //formulario de edicion
    Route::post('/a_garantes/detalle_conyugue/{id}/edit', 'Oficial\DetalleConyugueGaranteController@update'); //actualizar
    Route::delete('/a_garantes/detalle_conyugue/{id}', 'Oficial\DetalleConyugueGaranteController@destroy'); //actualizar
    //RUTAS GARANTES FIN

    //-------------------------------RUTAS CODEUDORES BEGIN-------------------------

 //Rutas asignar codeudor existente
    Route::get('/a_codeudores/asignar_codeudor/', 'Oficial\AsignarCodeudorController@index');
    Route::get('/a_codeudores/asignar_codeudor/{id}/asignar', 'Oficial\AsignarCodeudorController@asignar'); //formulario de edicion
    //Rutas Conyugues
    Route::get('/a_codeudores/conyugue/', 'Oficial\ConyugueCodeudorController@index'); //listado
    Route::get('/a_codeudores/conyugue/create', 'Oficial\ConyugueCodeudorController@create'); //crear
    Route::post('/a_codeudores/conyugue/', 'Oficial\ConyugueCodeudorController@store'); //crear
    Route::get('/a_codeudores/conyugue/{id}/edit', 'Oficial\ConyugueCodeudorController@edit'); //formulario de edicion
    Route::post('/a_codeudores/conyugue/{id}/edit', 'Oficial\ConyugueCodeudorController@update'); //actualizar
    Route::delete('/a_codeudores/conyugue/{id}', 'Oficial\ConyugueCodeudorController@destroy'); //actualizar
    //rutas direccion garante
    Route::get('/a_codeudores/direccion/', 'Oficial\DireccionCodeudorController@index'); //listado
    Route::get('/a_codeudores/direccion/create', 'Oficial\DireccionCodeudorController@create'); //crear
    Route::post('/a_codeudores/direccion/', 'Oficial\DireccionCodeudorController@store'); //crear
    Route::get('/a_codeudores/direccion/{id}/edit', 'Oficial\DireccionCodeudorController@edit'); //formulario de edicion
    Route::post('/a_codeudores/direccion/{id}/edit', 'Oficial\DireccionCodeudorController@update'); //actualizar
    Route::delete('/a_codeudores/direccion/{id}', 'Oficial\DireccionCodeudorController@destroy'); //actualizar
    //Rutas de croquis
    Route::get('/a_codeudores/croquis/', 'Oficial\CroquisCodeudorController@index'); //listado
    Route::get('/a_codeudores/croquis/create', 'Oficial\CroquisCodeudorController@create'); //crear
    Route::post('/a_codeudores/croquis/', 'Oficial\CroquisCodeudorController@store'); //crear
    Route::get('/a_codeudores/croquis/{id}/see', 'Oficial\CroquisCodeudorController@see'); //formulario para ver mapa
    Route::post('/a_codeudores/croquis/{id}/edit', 'Oficial\CroquisCodeudorController@update'); //actualizar
    Route::get('/a_codeudores/croquis/{id}/edit', 'Oficial\CroquisCodeudorController@edit'); //actualizar
    Route::delete('/a_codeudores/croquis/{id}', 'Oficial\CroquisCodeudorController@destroy'); //actualizar

 //ruta datos empresa
    Route::get('/a_codeudores/datos_empresa/', 'Oficial\DatosEmpresaCodeudorController@index'); //listado
    Route::get('/a_codeudores/datos_empresa/create', 'Oficial\DatosEmpresaCodeudorController@create'); //crear
    Route::post('/a_codeudores/datos_empresa/', 'Oficial\DatosEmpresaCodeudorController@store'); //crear
    Route::get('/a_codeudores/datos_empresa/{id}/edit', 'Oficial\DatosEmpresaCodeudorController@edit'); //formulario de edicion
    Route::post('/a_codeudores/datos_empresa/{id}/edit', 'Oficial\DatosEmpresaCodeudorController@update'); //actualizar
    Route::delete('/a_codeudores/datos_empresa/{id}', 'Oficial\DatosEmpresaCodeudorController@destroy'); //actualizar

    //ruta actividad economica
    Route::get('/a_codeudores/actividad_economica/', 'Oficial\ActividadEconomicaCodeudorController@index'); //listado
    Route::get('/a_codeudores/actividad_economica/create', 'Oficial\ActividadEconomicaCodeudorController@create'); //crear
    Route::post('/a_codeudores/actividad_economica/', 'Oficial\ActividadEconomicaCodeudorController@store'); //crear
    Route::get('/a_codeudores/actividad_economica/{id}/edit', 'Oficial\ActividadEconomicaCodeudorController@edit'); //formulario de edicion
    Route::post('/a_codeudores/actividad_economica/{id}/edit', 'Oficial\ActividadEconomicaCodeudorController@update'); //actualizar
    Route::delete('/a_codeudores/actividad_economica/{id}', 'Oficial\ActividadEconomicaCodeudorController@destroy'); //actualizar


//Rutas Referencias Del Codeudor
    Route::get('/a_codeudores/referencias_solicitante/', 'Oficial\ReferenciaSolicitanteCodeudorController@index'); //listado
    Route::get('/a_codeudores/referencias_solicitante/create', 'Oficial\ReferenciaSolicitanteCodeudorController@create'); //crear
    Route::post('/a_codeudores/referencias_solicitante/', 'Oficial\ReferenciaSolicitanteCodeudorController@store'); //crear
    Route::get('/a_codeudores/referencias_solicitante/{id}/edit', 'Oficial\ReferenciaSolicitanteCodeudorController@edit'); //formulario de edicion
    Route::post('/a_codeudores/referencias_solicitante/{id}/edit', 'Oficial\ReferenciaSolicitanteCodeudorController@update'); //actualizar
    Route::delete('/a_codeudores/referencias_solicitante/{id}', 'Oficial\ReferenciaSolicitanteCodeudorController@destroy'); //actualizar

    //Rutas Deposito bancario
    Route::get('/a_codeudores/deposito_bancario/', 'Oficial\DepositoBancarioCodeudorController@index'); //listado
    Route::get('/a_codeudores/deposito_bancario/create', 'Oficial\DepositoBancarioCodeudorController@create'); //crear
    Route::post('/a_codeudores/deposito_bancario/', 'Oficial\DepositoBancarioCodeudorController@store'); //crear
    Route::get('/a_codeudores/deposito_bancario/{id}/edit', 'Oficial\DepositoBancarioCodeudorController@edit'); //formulario de edicion
    Route::post('/a_codeudores/deposito_bancario/{id}/edit', 'Oficial\DepositoBancarioCodeudorController@update'); //actualizar
    Route::delete('/a_codeudores/deposito_bancario/{id}', 'Oficial\DepositoBancarioCodeudorController@destroy'); //actualizar

    //Rutas Inversiones financieras
    Route::get('/a_codeudores/inversiones_financieras/', 'Oficial\InversionesFinancierasCodeudorController@index'); //listado
    Route::get('/a_codeudores/inversiones_financieras/create', 'Oficial\InversionesFinancierasCodeudorController@create'); //crear
    Route::post('/a_codeudores/inversiones_financieras/', 'Oficial\InversionesFinancierasCodeudorController@store'); //crear
    Route::get('/a_codeudores/inversiones_financieras/{id}/edit', 'Oficial\InversionesFinancierasCodeudorController@edit'); //formulario de edicion
    Route::post('/a_codeudores/inversiones_financieras/{id}/edit', 'Oficial\InversionesFinancierasCodeudorController@update'); //actualizar
    Route::delete('/a_codeudores/inversiones_financieras/{id}', 'Oficial\InversionesFinancierasCodeudorController@destroy'); //actualizar

    //Rutas Cuentas Documentos por Cobrar
    Route::get('/a_codeudores/cuentas_documentos_cobrar/', 'Oficial\CuentasDocumentosCobrarCodeudorController@index'); //listado
    Route::get('/a_codeudores/cuentas_documentos_cobrar/create', 'Oficial\CuentasDocumentosCobrarCodeudorController@create'); //crear
    Route::post('/a_codeudores/cuentas_documentos_cobrar/', 'Oficial\CuentasDocumentosCobrarCodeudorController@store'); //crear
    Route::get('/a_codeudores/cuentas_documentos_cobrar/{id}/edit', 'Oficial\CuentasDocumentosCobrarCodeudorController@edit'); //formulario de edicion
    Route::post('/a_codeudores/cuentas_documentos_cobrar/{id}/edit', 'Oficial\CuentasDocumentosCobrarCodeudorController@update'); //actualizar
    Route::delete('/a_codeudores/cuentas_documentos_cobrar/{id}', 'Oficial\CuentasDocumentosCobrarCodeudorController@destroy'); //actualizar

     //Rutas Inventario de mercaderias
    Route::get('/a_codeudores/inventario_mercaderia/', 'Oficial\InventarioMercaderiaCodeudorController@index'); //listado
    Route::get('/a_codeudores/inventario_mercaderia/create', 'Oficial\InventarioMercaderiaCodeudorController@create'); //crear
    Route::post('/a_codeudores/inventario_mercaderia/', 'Oficial\InventarioMercaderiaCodeudorController@store'); //crear
    Route::get('/a_codeudores/inventario_mercaderia/{id}/edit', 'Oficial\InventarioMercaderiaCodeudorController@edit'); //formulario de edicion
    Route::post('/a_codeudores/inventario_mercaderia/{id}/edit', 'Oficial\InventarioMercaderiaCodeudorController@update'); //actualizar
    Route::delete('/a_codeudores/inventario_mercaderia/{id}', 'Oficial\InventarioMercaderiaCodeudorController@destroy'); //actualizar

     //Rutas Maquinaria
    Route::get('/a_codeudores/maquinaria_equipo/', 'Oficial\MaquinariaEquipoCodeudorController@index'); //listado
    Route::get('/a_codeudores/maquinaria_equipo/create', 'Oficial\MaquinariaEquipoCodeudorController@create'); //crear
    Route::post('/a_codeudores/maquinaria_equipo/', 'Oficial\MaquinariaEquipoCodeudorController@store'); //crear
    Route::get('/a_codeudores/maquinaria_equipo/{id}/edit', 'Oficial\MaquinariaEquipoCodeudorController@edit'); //formulario de edicion
    Route::post('/a_codeudores/maquinaria_equipo/{id}/edit', 'Oficial\MaquinariaEquipoCodeudorController@update'); //actualizar
    Route::delete('/a_codeudores/maquinaria_equipo/{id}', 'Oficial\MaquinariaEquipoCodeudorController@destroy'); //actualizar

    //Rutas bienes hogar
    Route::get('/a_codeudores/bienes_hogar/', 'Oficial\BienesHogarCodeudorController@index'); //listado
    Route::get('/a_codeudores/bienes_hogar/create', 'Oficial\BienesHogarCodeudorController@create'); //crear
    Route::post('/a_codeudores/bienes_hogar/', 'Oficial\BienesHogarCodeudorController@store'); //crear
    Route::get('/a_codeudores/bienes_hogar/{id}/edit', 'Oficial\BienesHogarCodeudorController@edit'); //formulario de edicion
    Route::post('/a_codeudores/bienes_hogar/{id}/edit', 'Oficial\BienesHogarCodeudorController@update'); //actualizar
    Route::delete('/a_codeudores/bienes_hogar/{id}', 'Oficial\BienesHogarCodeudorController@destroy'); //actualizar

    //Rutas Inmuebles
    Route::get('/a_codeudores/inmueble/', 'Oficial\InmuebleCodeudorController@index'); //listado
    Route::get('/a_codeudores/inmueble/create', 'Oficial\InmuebleCodeudorController@create'); //crear
    Route::post('/a_codeudores/inmueble/', 'Oficial\InmuebleCodeudorController@store'); //crear
    Route::get('/a_codeudores/inmueble/{id}/edit', 'Oficial\InmuebleCodeudorController@edit'); //formulario de edicion
    Route::post('/a_codeudores/inmueble/{id}/edit', 'Oficial\InmuebleCodeudorController@update'); //actualizar
    Route::delete('/a_codeudores/inmueble/{id}', 'Oficial\InmuebleCodeudorController@destroy'); //actualizar

    //Rutas Vehiculo
    Route::get('/a_codeudores/vehiculo/', 'Oficial\VehiculoCodeudorController@index'); //listado
    Route::get('/a_codeudores/vehiculo/create', 'Oficial\VehiculoCodeudorController@create'); //crear
    Route::post('/a_codeudores/vehiculo/', 'Oficial\VehiculoCodeudorController@store'); //crear
    Route::get('/a_codeudores/vehiculo/{id}/edit', 'Oficial\VehiculoCodeudorController@edit'); //formulario de edicion
    Route::post('/a_codeudores/vehiculo/{id}/edit', 'Oficial\VehiculoCodeudorController@update'); //actualizar
    Route::delete('/a_codeudores/vehiculo/{id}', 'Oficial\VehiculoCodeudorController@destroy'); //actualizar

    //Rutas Otros Activos
    Route::get('/a_codeudores/otros_activos/', 'Oficial\OtroActivoCodeudorController@index'); //listado
    Route::get('/a_codeudores/otros_activos/create', 'Oficial\OtroActivoCodeudorController@create'); //crear
    Route::post('/a_codeudores/otros_activos/', 'Oficial\OtroActivoCodeudorController@store'); //crear
    Route::get('/a_codeudores/otros_activos/{id}/edit', 'Oficial\OtroActivoCodeudorController@edit'); //formulario de edicion
    Route::post('/a_codeudores/otros_activos/{id}/edit', 'Oficial\OtroActivoCodeudorController@update'); //actualizar
    Route::delete('/a_codeudores/otros_activos/{id}', 'Oficial\OtroActivoCodeudorController@destroy'); //actualizar

    //Rutas Prestamo bancario
    Route::get('/a_codeudores/prestamo_bancario/', 'Oficial\PrestamoBancarioCodeudorController@index'); //listado
    Route::get('/a_codeudores/prestamo_bancario/create', 'Oficial\PrestamoBancarioCodeudorController@create'); //crear
    Route::post('/a_codeudores/prestamo_bancario/', 'Oficial\PrestamoBancarioCodeudorController@store'); //crear
    Route::get('/a_codeudores/prestamo_bancario/{id}/edit', 'Oficial\PrestamoBancarioCodeudorController@edit'); //formulario de edicion
    Route::post('/a_codeudores/prestamo_bancario/{id}/edit', 'Oficial\PrestamoBancarioCodeudorController@update'); //actualizar
    Route::delete('/a_codeudores/prestamo_bancario/{id}', 'Oficial\PrestamoBancarioCodeudorController@destroy'); //actualizar

     //Rutas Cuentas por Pagar
    Route::get('/a_codeudores/cuentas_por_pagar/', 'Oficial\CuentasPagarCodeudorController@index'); //listado
    Route::get('/a_codeudores/cuentas_por_pagar/create', 'Oficial\CuentasPagarCodeudorController@create'); //crear
    Route::post('/a_codeudores/cuentas_por_pagar/', 'Oficial\CuentasPagarCodeudorController@store'); //crear
    Route::get('/a_codeudores/cuentas_por_pagar/{id}/edit', 'Oficial\CuentasPagarCodeudorController@edit'); //formulario de edicion
    Route::post('/a_codeudores/cuentas_por_pagar/{id}/edit', 'Oficial\CuentasPagarCodeudorController@update'); //actualizar
    Route::delete('/a_codeudores/cuentas_por_pagar/{id}', 'Oficial\CuentasPagarCodeudorController@destroy'); //actualizar



 //Rutas Capacidad de pago garante
    Route::get('/a_codeudores/capacidad_pago/', 'Oficial\CapacidadPagoCodeudorController@index'); //listado
    Route::get('/a_codeudores/capacidad_pago/create', 'Oficial\CapacidadPagoCodeudorController@create'); //crear
    Route::post('/a_codeudores/capacidad_pago/', 'Oficial\CapacidadPagoCodeudorController@store'); //crear
    Route::get('/a_codeudores/capacidad_pago/{id}/edit', 'Oficial\CapacidadPagoCodeudorController@edit'); //formulario de edicion
    Route::post('/a_codeudores/capacidad_pago/{id}/edit', 'Oficial\CapacidadPagoCodeudorController@update'); //actualizar
    Route::delete('/a_codeudores/capacidad_pago/{id}', 'Oficial\CapacidadPagoCodeudorController@destroy'); //actualizar

    //rutas de mano de obra
    Route::get('/a_codeudores/mano_obra/', 'Oficial\ManoObraMensualCodeudorController@index'); //listado
    Route::get('/a_codeudores/mano_obra/create', 'Oficial\ManoObraMensualCodeudorController@create'); //crear
    Route::post('/a_codeudores/mano_obra/', 'Oficial\ManoObraMensualCodeudorController@store'); //crear
    Route::get('/a_codeudores/mano_obra/{id}/edit', 'Oficial\ManoObraMensualCodeudorController@edit'); //formulario de edicion
    Route::post('/a_codeudores/mano_obra/{id}/edit', 'Oficial\ManoObraMensualCodeudorController@update'); //actualizar
    Route::delete('/a_codeudores/mano_obra/{id}', 'Oficial\ManoObraMensualCodeudorController@destroy'); //actualizar

    //rutas de gastos familiares
    Route::get('/a_codeudores/gastos_familiares/', 'Oficial\GastosFamiliaresCodeudorController@index'); //listado
    Route::get('/a_codeudores/gastos_familiares/create', 'Oficial\GastosFamiliaresCodeudorController@create'); //crear
    Route::post('/a_codeudores/gastos_familiares/', 'Oficial\GastosFamiliaresCodeudorController@store'); //crear
    Route::get('/a_codeudores/gastos_familiares/{id}/edit', 'Oficial\GastosFamiliaresCodeudorController@edit'); //formulario de edicion
    Route::post('/a_codeudores/gastos_familiares/{id}/edit', 'Oficial\GastosFamiliaresCodeudorController@update'); //actualizar
    Route::delete('/a_codeudores/gastos_familiares/{id}', 'Oficial\GastosFamiliaresCodeudorController@destroy'); //actualizar

    //Rutas Gastos Operativos
    Route::get('/a_codeudores/gastos_operativos/', 'Oficial\GastosOperativosComercializacionCodeudorController@index'); //listado
    Route::get('/a_codeudores/gastos_operativos/create', 'Oficial\GastosOperativosComercializacionCodeudorController@create'); //crear
    Route::post('/a_codeudores/gastos_operativos/', 'Oficial\GastosOperativosComercializacionCodeudorController@store'); //crear
    Route::get('/a_codeudores/gastos_operativos/{id}/edit', 'Oficial\GastosOperativosComercializacionCodeudorController@edit'); //formulario de edicion
    Route::post('/a_codeudores/gastos_operativos/{id}/edit', 'Oficial\GastosOperativosComercializacionCodeudorController@update'); //actualizar
    Route::delete('/a_codeudores/gastos_operativos/{id}', 'Oficial\GastosOperativosComercializacionCodeudorController@destroy'); //actualizar


    //Rutas detalle conyugue
    Route::get('/a_codeudores/detalle_conyugue/', 'Oficial\DetalleConyugueCodeudorController@index'); //listado
    Route::get('/a_codeudores/detalle_conyugue/create', 'Oficial\DetalleConyugueCodeudorController@create'); //crear
    Route::post('/a_codeudores/detalle_conyugue/', 'Oficial\DetalleConyugueCodeudorController@store'); //crear
    Route::get('/a_codeudores/detalle_conyugue/{id}/edit', 'Oficial\DetalleConyugueCodeudorController@edit'); //formulario de edicion
    Route::post('/a_codeudores/detalle_conyugue/{id}/edit', 'Oficial\DetalleConyugueCodeudorController@update'); //actualizar
    Route::delete('/a_codeudores/detalle_conyugue/{id}', 'Oficial\DetalleConyugueCodeudorController@destroy'); //actualizar    
    //rutas de ingreso mensual
    Route::get('/a_codeudores/ingreso_mensual/', 'Oficial\IngresoMensualCodeudorController@index'); //listado
    Route::get('/a_codeudores/ingreso_mensual/create', 'Oficial\IngresoMensualCodeudorController@create'); //crear
    Route::post('/a_codeudores/ingreso_mensual/', 'Oficial\IngresoMensualCodeudorController@import'); //crear
    Route::get('/a_codeudores/ingreso_mensual/descarga', 'Oficial\IngresoMensualCodeudorController@download'); //listado
    Route::get('/a_codeudores/ingreso_mensual/{id}/edit', 'Oficial\IngresoMensualCodeudorController@edit'); //formulario de edicion
    Route::post('/a_codeudores/ingreso_mensual/{id}/edit', 'Oficial\IngresoMensualCodeudorController@update'); //actualizar

   //RUTAS DE VENTA COMERCIALIZACION DE PRODUCTOS
    Route::get('/a_codeudores/venta_comercializacion_producto/', 'Oficial\VentaComercializacionProductoCodeudorController@index'); //listado
    Route::get('/a_codeudores/venta_comercializacion_producto/create', 'Oficial\VentaComercializacionProductoCodeudorController@create'); //crear
    Route::post('/a_codeudores/venta_comercializacion_producto/', 'Oficial\VentaComercializacionProductoCodeudorController@import'); //crear
    Route::get('/a_codeudores/venta_comercializacion_producto/descarga', 'Oficial\VentaComercializacionProductoCodeudorController@download'); //listado
    Route::get('/a_codeudores/venta_comercializacion_producto/descarga_transporte', 'Oficial\VentaComercializacionProductoCodeudorController@download_transporte'); //listado
    Route::get('/a_codeudores/venta_comercializacion_producto/comercio', 'Oficial\VentaComercializacionProductoCodeudorController@download_comercio'); //listado
    Route::get('/a_codeudores/venta_comercializacion_producto/{id}/edit', 'Oficial\VentaComercializacionProductoCodeudorController@edit'); //formulario de edicion
    Route::post('/a_codeudores/venta_comercializacion_producto/{id}/edit', 'Oficial\VentaComercializacionProductoCodeudorController@update'); //actualizar
    Route::delete('/a_codeudores/venta_comercializacion_producto/{id}', 'Oficial\VentaComercializacionProductoCodeudorController@destroy'); //actualizar
    //Rutas de formulario de reporte
    Route::get('/a_codeudores/formulario/', 'Oficial\FormularioCodeudorController@index'); //listado
    Route::get('/a_codeudores/formulario/{id}/formulario', 'Oficial\FormularioCodeudorController@formulario'); //formulario de edicion


    //Rutas Efectivos en Caja
    Route::get('/a_codeudores/efectivos_caja/', 'Oficial\EfectivoCajaCodeudorController@index'); //listado
    Route::get('/a_codeudores/efectivos_caja/create', 'Oficial\EfectivoCajaCodeudorController@create'); //crear
    Route::post('/a_codeudores/efectivos_caja/', 'Oficial\EfectivoCajaCodeudorController@store'); //crear
    Route::get('/a_codeudores/efectivos_caja/{id}/edit', 'Oficial\EfectivoCajaCodeudorController@edit'); //formulario de edicion
    Route::post('/a_codeudores/efectivos_caja/{id}/edit', 'Oficial\EfectivoCajaCodeudorController@update'); //actualizar
    Route::delete('/a_codeudores/efectivos_caja/{id}', 'Oficial\EfectivoCajaCodeudorController@destroy'); //actualizar

    //-------------------------------RUTAS DE CODEUDORES END-------------------------
});

//RUTAS ROL DE RIESGOS
Route::middleware(['auth', 'riesgos'])->prefix('riesgos')->group(function () {
    //rutas de dashboard jefe de créditos
    Route::get('/dashboard/', 'Riesgos\DashboardRiesgosController@index');
    //Reportes de cliente
    //ruta seleccionar persona
    Route::get('/seleccionar/', 'Riesgos\SeleccionarSocioController@index');
    Route::get('/seleccionar/{id}/seleccionar', 'Riesgos\SeleccionarSocioController@seleccionar');

    //Rutas seleccionar creditos
    Route::get('/seleccionar_credito/', 'Riesgos\SeleccionarCreditoController@index');
    Route::get('/seleccionar_credito/{id_persona}/{id_credito}/seleccionar_credito', 'Riesgos\SeleccionarCreditoController@seleccionar_credito');

    //rutas seguimiento-----------------------------------------
    Route::get('/seguimiento/', 'Riesgos\SeguimientoController@index'); //listado
    Route::get('/seguimiento/create', 'Riesgos\SeguimientoController@create'); //crear
    Route::post('/seguimiento/', 'Riesgos\SeguimientoController@store'); //crear
    Route::get('/seguimiento/{id}/edit_fin', 'Riesgos\SeguimientoController@edit_fin'); //formulario de edicion
    Route::post('/seguimiento/{id}/edit_fin', 'Riesgos\SeguimientoController@update_fin'); //actualizar
    Route::get('/seguimiento/{id}/edit_derivar', 'Riesgos\SeguimientoController@edit_derivar'); //formulario de edicion
    Route::post('/seguimiento/{id}/edit_derivar', 'Riesgos\SeguimientoController@update_derivar'); //
    //Rutas usuario-------------------
    Route::get('/user', 'Riesgos\UserController@index'); //listado
    Route::get('/user/{id}/edit', 'Riesgos\UserController@edit'); //formulario de edicion
    Route::get('/user/edit_photo', 'Riesgos\UserController@edit_photo'); //formulario de edicion
    Route::patch('/user/{id}/edit_datos', 'Riesgos\UserController@update_datos'); //actualizar
    Route::patch('/user/{id}/edit_picture', 'Riesgos\UserController@update_picture'); //actualizar
    //--------------------------------------RUTAS GENERAR INFORME--------------------------------------
    Route::get('/consumo_sola_firma', 'Riesgos\InformeController@consumo_sola_firma'); //crear
    Route::get('/garantes', 'Riesgos\InformeController@garantes'); //crear
    Route::get('/hipotecaria', 'Riesgos\InformeController@garantia_hipotecaria'); 
});

//RUTAS ROL DE ASESORIA
Route::middleware(['auth', 'asesoria'])->prefix('asesoria')->group(function () {
    //rutas de dashboard jefe de créditos
    Route::get('/dashboard/', 'Asesoria\DashboardAsesoriaController@index');
    Route::get('/seleccionar/', 'Asesoria\SeleccionarSocioController@index');
    Route::get('/seleccionar/{id}/seleccionar', 'Asesoria\SeleccionarSocioController@seleccionar');
    //Rutas de asesoria
    Route::get('/seleccionar_credito/', 'Asesoria\SeleccionarCreditoController@index');
    Route::get('/seleccionar_credito/{id_persona}/{id_credito}/seleccionar_credito', 'Asesoria\SeleccionarCreditoController@seleccionar_credito');

    //Rutas seguimiento---------------------
    Route::get('/seguimiento/', 'Asesoria\SeguimientoController@index'); //listado
    Route::get('/seguimiento/create', 'Asesoria\SeguimientoController@create'); //crear
    Route::post('/seguimiento/', 'Asesoria\SeguimientoController@store'); //crear
    Route::get('/seguimiento/{id}/edit_fin', 'Asesoria\SeguimientoController@edit_fin'); //formulario de edicion
    Route::post('/seguimiento/{id}/edit_fin', 'Asesoria\SeguimientoController@update_fin'); //actualizar
    Route::get('/seguimiento/{id}/edit_derivar', 'Asesoria\SeguimientoController@edit_derivar'); //formulario de edicion
    Route::post('/seguimiento/{id}/edit_derivar', 'Asesoria\SeguimientoController@update_derivar'); //

    //Rutas De Perfil de usuario-------------------
    Route::get('/user', 'Asesoria\UserController@index'); //listado
    Route::get('/user/{id}/edit', 'Asesoria\UserController@edit'); //formulario de edicion
    Route::get('/user/edit_photo', 'Asesoria\UserController@edit_photo'); //formulario de edicion
    Route::patch('/user/{id}/edit_datos', 'Asesoria\UserController@update_datos'); //actualizar
    Route::patch('/user/{id}/edit_picture', 'Asesoria\UserController@update_picture'); //actualizar

    //--------------------------GENERACION DE DOCUMENTOS------------------------------------------
    Route::get('/contrato/consumo_sola_firma', 'Asesoria\ContratosController@consumo_sola_firma'); //crear
    Route::get('/contrato/consumo', 'Asesoria\ContratosController@consumo'); //crear
    Route::get('/contrato/consumo_garantia_hipotecaria', 'Asesoria\ContratosController@consumo_garantia_hipotecaria'); 
    Route::get('/contrato/credito_vivienda', 'Asesoria\ContratosController@credito_vivienda'); 
    Route::get('/contrato/hipotecario_vivienda', 'Asesoria\ContratosController@hipotecario_vivienda'); 
    Route::get('/contrato/microcredito', 'Asesoria\ContratosController@microcredito'); 
    Route::get('/contrato/microcredito_sola_firma', 'Asesoria\ContratosController@microcreditoAsolaFirma'); 
    Route::get('/contrato/microcredito_garantia_hipotecaria', 'Asesoria\ContratosController@microcreditoGarantiaHipotecaria'); 
    //--------------------------Rutas generacion de documentos-----------------------------------

});

//RUTAS ROL DE COMITE
Route::middleware(['auth', 'comite'])->prefix('comite')->group(function () {
    //rutas de dashboard jefe de créditos
    Route::get('/dashboard/', 'Comite\DashboardComiteController@index');
    // Rutas de credito
    Route::get('/seleccionar_credito/', 'Comite\SeleccionarCreditoController@index');
    Route::get('/seleccionar_credito/{id_persona}/{id_credito}/seleccionar_credito', 'Comite\SeleccionarCreditoController@seleccionar_credito');

    //rutas seguimiento---------------------
    Route::get('/seguimiento/', 'Comite\SeguimientoController@index'); //listado
    Route::get('/seguimiento/create', 'Comite\SeguimientoController@create'); //crear
    Route::post('/seguimiento/', 'Comite\SeguimientoController@store'); //crear
    Route::get('/seguimiento/{id}/edit_fin', 'Comite\SeguimientoController@edit_fin'); //formulario de edicion
    Route::post('/seguimiento/{id}/edit_fin', 'Comite\SeguimientoController@update_fin'); //actualizar
    Route::get('/seguimiento/{id}/edit_derivar', 'Comite\SeguimientoController@edit_derivar'); //formulario de edicion
    Route::post('/seguimiento/{id}/edit_derivar', 'Comite\SeguimientoController@update_derivar'); //
    //Rutas De Perfil de Usuario-------------------
    Route::get('/user', 'Comite\UserController@index'); //listado
    Route::get('/user/{id}/edit', 'Comite\UserController@edit'); //formulario de edicion
    Route::get('/user/edit_photo', 'Comite\UserController@edit_photo'); //formulario de edicion
    Route::patch('/user/{id}/edit_datos', 'Comite\UserController@update_datos'); //actualizar
    Route::patch('/user/{id}/edit_picture', 'Comite\UserController@update_picture'); //actualizar
});
