<?php

use Illuminate\Database\Seeder;
use sis5cs\Requisitos;
class RequisitosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Crédito de consumo  Con garantía a sola firma
     Requisitos::create([
        'descripcion'=>'Fotocopias de C.I. del deudor, codeudor (cónyuge)',       
        'id_tcredito'=>1      
    ]);
     Requisitos::create([
        'descripcion'=>'Comprobante de pago servicios básicos último mes (luz, agua, o gas)',       
        'id_tcredito'=>1      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar la capacidad de pago de los deudores (últimas tres papeletas de sueldo, certificado de trabajo, extracto reciente de aportes a las AFPs, cuaderno de registros de compra-venta, talonarios de facturación y/o recibos de ventas, otros respaldos)',       
        'id_tcredito'=>1      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar la actividad de deudores (NIT, licencia de funcionamiento, certificaciones, afiliaciones, credenciales u otros respaldos si corresponde)',       
        'id_tcredito'=>1      
    ]);
     Requisitos::create([
        'descripcion'=>'Informe de la Aseguradora autorizada sobre la aceptación o rechazo del Seguro de Desgravamen del socio solicitante.',       
        'id_tcredito'=>1      
    ]);
     Requisitos::create([
        'descripcion'=>'Información sobre riesgo crediticio de los deudores (INFOCRED, RUI-SEGIP u otro autorizado por los solicitantes a travez de la institución)',       
        'id_tcredito'=>1      
    ]);

     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar puntualidad en pago de deudas a entidades financieras de los deudores (último recibo de pago, extracto de crédito o plan de pagos)',       
        'id_tcredito'=>1      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos paras medir el nivel patrimonial de los deudores en relación al préstamo (deudores directos 200 % relación entre el préstamo y su patrimonio).',       
        'id_tcredito'=>1      
    ]);
     Requisitos::create([
        'descripcion'=>'Fotocopia de documentos terreno, inmueble a nombre del socio o por secesión hereditaria.',       
        'id_tcredito'=>1      
    ]);
     Requisitos::create([
        'descripcion'=>'Número de tarjeta de UNINET o similar, donde le depositan sus haberes (si corresponde) o convenio interinstitucional.',       
        'id_tcredito'=>1      
    ]);
     Requisitos::create([
        'descripcion'=>'Plazo 24 meses.',       
        'id_tcredito'=>1      
    ]);     
     //Consumo Con garantia personal
     Requisitos::create([
        'descripcion'=>'Fotocopias de C.I. del deudor, codeudor y garante si corresponde',       
        'id_tcredito'=>2      
    ]);
     Requisitos::create([
        'descripcion'=>'Comprobante de pago servicios básicos último mes del deudor, codeudor y garantes (luz, agua o gas)',       
        'id_tcredito'=>2      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar la capacidad de pago de los deudores (últimas tres papeletas de sueldo y/o rentas, certificado de trabajo, extracto reciente de aportes a las AFPs, cuaderno de registros de compra-venta, talonarios de facturación y/o recibos de ventas, otros respaldos); de los garantes (última papeleta de sueldo y una papeleta de sueldo de hace 12 meses atrás; si no presentara extracto de reportes a las AFPs)',       
        'id_tcredito'=>2      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar la actividad de deudores y garantes (NIT, licencia de funcionamiento, certificaciones, afiliaciones, credenciales u otros respaldos)',       
        'id_tcredito'=>2      
    ]);
     Requisitos::create([
        'descripcion'=>'Informe de la Aseguradora autorizada sobre la aceptación o rechazo del Seguro de Desgravamen de los socios solicitantes',       
        'id_tcredito'=>2      
    ]);
     Requisitos::create([
        'descripcion'=>'Información sobre riesgo crediticio de los deudores y garantes (INFOCRED u otro autorizado por la institución y el socio)',       
        'id_tcredito'=>2      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos del destino del crédito (cotizaciones, contrato de pre-compra u otros respaldos)',       
        'id_tcredito'=>2      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar puntualidad en pago de deudas a entidades financieras de los deudores y garantes (último recibo de pago, extractos de crédito o plan de pagos)',       
        'id_tcredito'=>2      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos paras medir el nivel patrimonial de deudores y garantes en relación al préstamo (deudores directos 200% la relación entre el préstamo y su patrimonio; garantes 100% la relación entre el préstamo y su patrimonio)',       
        'id_tcredito'=>2      
    ]);
     Requisitos::create([
        'descripcion'=>'Los deudores y garantes asalariados deben presentar un Poder Notariado específico para cobro de haberes.',       
        'id_tcredito'=>2      
    ]);
     //Consumo Con otras garantías Y/O personal  
     Requisitos::create([
        'descripcion'=>'Fotocopias de C.I. del deudor, codeudor y garante (este último si corresponde)',       
        'id_tcredito'=>3      
    ]);
     Requisitos::create([
        'descripcion'=>'Comprobante de pago servicios básicos último mes del deudor y garantes (luz, agua o gas)',       
        'id_tcredito'=>3      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar la capacidad de pago del deudor (últimas tres papeletas de sueldo y/o rentas, certificado de trabajo, extracto reciente de aportes a las AFPs, cuaderno de registros de compra-venta, talonarios de facturación y/o recibos de ventas u otros respaldos); de los garantes (última papeleta de sueldo y una papeleta de sueldo de hace 12 meses atrás)',       
        'id_tcredito'=>3      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar la actividad de deudores y garantes (NIT, licencia de funcionamiento, certificaciones, afiliaciones, credenciales u otros respaldos)',       
        'id_tcredito'=>3      
    ]);
     Requisitos::create([
        'descripcion'=>'Informe de la Aseguradora autorizada sobre la aceptación o rechazo del Seguro de Desgravamen de los socios solicitantes)',       
        'id_tcredito'=>3      
    ]);
     Requisitos::create([
        'descripcion'=>'Información sobre riesgo crediticio de deudores y garantes (INFOCRED u otro autorizado por la institución y el socio)',       
        'id_tcredito'=>3      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar puntualidad en pago de deudas a entidades financieras de los deudores y garantes (último recibo de pago, extractos de crédito, plan de pagos)',       
        'id_tcredito'=>3      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos paras medir el nivel patrimonial de deudores y garantes en relación al préstamo (deudores directos 200 % la relación entre el préstamo y su patrimonio; garantes 100% la relación entre el préstamo y su patrimonio)',       
        'id_tcredito'=>3      
    ]);
     Requisitos::create([
        'descripcion'=>'Los deudores y garantes asalariados deben presentar un Poder Notariado específico para cobro de haberes.',       
        'id_tcredito'=>3      
    ]);
     Requisitos::create([
        'descripcion'=>'Presentación de garantías (documentos originales: inmuebles (folio real actualizado o información rápida de Derechos Reales, testimonio, plano aprobado de lote, plano de construcción si corresponde, último pago de impuestos u otros si corresponde; vehículos (RUA, póliza de importación, Poder notariado si corresponde, Formulario de registro de vehículo FRV, último pago de impuestos, certificado alodial si corresponde, resolución de inscripción de tránsito si corresponde, informe técnico de autenticidad de DIPROVE si corresponde, fotocopia de SOAT actualizado, informe de inspección técnica si corresponde); maquinaria pesada (póliza de importación, FRV, contrato de transferencia con reconocimiento de firmas si corresponde, Factura o Nota de compra si corresponde)',       
        'id_tcredito'=>3      
    ]);
     Requisitos::create([
        'descripcion'=>'Informe de verificación por el Oficial de Créditos',       
        'id_tcredito'=>3      
    ]);
     Requisitos::create([
        'descripcion'=>'Informe Legal de la garantía, realizado por Asesor Legal interno.',       
        'id_tcredito'=>3      
    ]);
     Requisitos::create([
        'descripcion'=>'Poder especifico del dueño a los acreedores (si corresponde)',       
        'id_tcredito'=>3      
    ]);
     Requisitos::create([
        'descripcion'=>'Verificación de la relación garantía-préstamo: inmuebles 1.25 a 1 sobre el valor hipotecario; vehículos y equipo y maquinaria pesada: 1.75 a 1, todos sobre el valor realización.',       
        'id_tcredito'=>3      
    ]);
       //Consumo debidamente garantizado
     Requisitos::create([
        'descripcion'=>'Fotocopias de C.I. del deudor, codeudor y garante (este último si corresponde)',       
        'id_tcredito'=>4      
    ]);
     Requisitos::create([
        'descripcion'=>'Comprobante de pago servicios básicos último mes de deudores y garantes (luz, agua, o gas)',       
        'id_tcredito'=>4      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar la capacidad de pago del deudor (últimas tres papeletas de sueldo y/o rentas, certificado de trabajo, extracto reciente de aportes a las AFPs, cuaderno de registros de compra-venta, talonarios de facturación y/o recibos de ventas u otros respaldos); de los garantes (última papeleta de sueldo y una papeleta de sueldo de hace 12 meses atrás; si no presentara extracto de reportes a las AFPs)',       
        'id_tcredito'=>4     
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar la actividad de deudores y garantes (NIT, licencia de funcionamiento, certificaciones, afiliaciones, credenciales u otros respaldos)',       
        'id_tcredito'=>4     
    ]);
     Requisitos::create([
        'descripcion'=>'Informe de la Aseguradora autorizada sobre la aceptación o rechazo del Seguro de Desgravamen de los socios solicitantes)',       
        'id_tcredito'=>4     
    ]);
     Requisitos::create([
        'descripcion'=>'Información sobre riesgo crediticio de deudores y garantes (INFOCRED u otro autorizado por la institución y el socio)',       
        'id_tcredito'=>4     
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos del destino del crédito (cotizaciones, contrato de pre-compra u otros respaldos) si corresponde.',       
        'id_tcredito'=>4     
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar puntualidad en pago de deudas a entidades financieras de los deudores y garantes (último recibo de pago, extractos de crédito o plan de pagos)',       
        'id_tcredito'=>4     
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos paras medir el nivel patrimonial de deudores y garantes en relación al préstamo (deudores directos 200% la relación entre el préstamo y su patrimonio; garantes 100% la relación entre el préstamo y su patrimonio)',       
        'id_tcredito'=>4     
    ]);
     Requisitos::create([
        'descripcion'=>'Los deudores y/o garantes asalariados deben otorgar Poder Notariado específico para cobro de haberes.',       
        'id_tcredito'=>4     
    ]);
     Requisitos::create([
        'descripcion'=>'Presentación de garantías (documentos originales: inmuebles (folio real actualizado o información rápida de Derechos Reales, testimonio, plano aprobado de lote, plano de construcción si corresponde, último pago de impuestos u otros si corresponde; vehículos (RUA, póliza de importación, Poder notariado si corresponde, Formulario de registro de vehículo FRV, último pago de impuestos, certificado alodial si corresponde, resolución de inscripción de tránsito si corresponde, informe técnico de autenticidad de DIPROVE si corresponde, fotocopia de SOAT actualizado, informe de inspección técnica actualizado si corresponde)',       
        'id_tcredito'=>4     
    ]);
     Requisitos::create([
        'descripcion'=>'Informe técnico de la garantía, realizado por perito tasador.',       
        'id_tcredito'=>4     
    ]);
     Requisitos::create([
        'descripcion'=>'Informe Legal de la garantía',       
        'id_tcredito'=>4     
    ]);
     Requisitos::create([
        'descripcion'=>'Poder especifico del dueño a los acreedores (si corresponde)',       
        'id_tcredito'=>4     
    ]);
     Requisitos::create([
        'descripcion'=>'Verificación de la relación garantía-préstamo: inmuebles 1.25 a 1 sobre el valor hipotecario; vehículos y equipo y maquinaria pesada: 1.75 a 1, todos sobre el valor de venta rápida.',       
        'id_tcredito'=>4     
    ]);     

     //Microcredito  Con garantía a sola firma
     Requisitos::create([
        'descripcion'=>'Fotocopias de C.I. del deudor, codeudor (cónyuge)',       
        'id_tcredito'=>5      
    ]);
     Requisitos::create([
        'descripcion'=>'Comprobante de pago servicios básicos último mes (luz, agua, o gas)',       
        'id_tcredito'=>5     
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar la capacidad de pago de los deudores (últimas tres papeletas de sueldo, certificado de trabajo, extracto reciente de aportes a las AFPs, cuaderno de registros de compra-venta, talonarios de facturación y/o recibos de ventas, otros respaldos)',       
        'id_tcredito'=>5     
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar la actividad de deudores (NIT, licencia de funcionamiento, certificaciones, afiliaciones, credenciales u otros respaldos)',       
        'id_tcredito'=>5     
    ]);
     Requisitos::create([
        'descripcion'=>'Informe de la Aseguradora autorizada sobre la aceptación o rechazo del Seguro de Desgravamen del socio solicitante.',       
        'id_tcredito'=>5     
    ]);
     Requisitos::create([
        'descripcion'=>'Información sobre riesgo crediticio de los deudores (INFOCRED, RUI-SEGIP u otro autorizado por los solicitantes a travez de la institución)',       
        'id_tcredito'=>5     
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar puntualidad en pago de deudas a entidades financieras de los deudores (último recibo de pago, extracto de crédito o plan de pagos)',       
        'id_tcredito'=>5     
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos paras medir el nivel patrimonial de los deudores en relación al préstamo (deudores directos 200 % relación entre el préstamo y su patrimonio).',       
        'id_tcredito'=>5     
    ]);
     Requisitos::create([
        'descripcion'=>'Fotocopia de documentos terreno, inmueble a nombre del socio o por secesión hereditaria.',       
        'id_tcredito'=>5     
    ]);
     Requisitos::create([
        'descripcion'=>'Número de tarjeta de UNINET o similar, donde le depositan sus haberes (si corresponde)',       
        'id_tcredito'=>5     
    ]);
     Requisitos::create([
        'descripcion'=>'Plazo 24 meses.',       
        'id_tcredito'=>5     
    ]);
        // Microcredito  Con garantía personal:
     Requisitos::create([
        'descripcion'=>'Fotocopias de C.I. del deudor, codeudor y garante si corresponde',       
        'id_tcredito'=>6     
    ]);
     Requisitos::create([
        'descripcion'=>'Comprobante de pago servicios básicos último mes del deudor, codeudor y garantes (luz, agua o gas)',       
        'id_tcredito'=>6      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar la capacidad de pago de los deudores (últimas tres papeletas de sueldo y/o rentas, certificado de trabajo, extracto reciente de aportes a las AFPs, cuaderno de registros de compra-venta, talonarios de facturación y/o recibos de ventas, otros respaldos); de los garantes (última papeleta de sueldo y una papeleta de sueldo de hace 12 meses atrás, si no presenta extracto de aportes a las AFPs)',       
        'id_tcredito'=>6      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar la actividad de deudores y garantes (NIT, licencia de funcionamiento, certificaciones, afiliaciones, credenciales u otros respaldos)',       
        'id_tcredito'=>6      
    ]);
     Requisitos::create([
        'descripcion'=>'Informe de la Aseguradora autorizada sobre la aceptación o rechazo del Seguro de Desgravamen de los socios solicitantes',       
        'id_tcredito'=>6      
    ]);
     Requisitos::create([
        'descripcion'=>'Información sobre riesgo crediticio de los deudores y garantes (INFOCRED, RUI-SEGIP autorizado por el socio a travez dela institución u otro autorizado por la institución)',       
        'id_tcredito'=>6      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos del destino del crédito (cotizaciones, contrato de pre-compra u otros respaldos)',       
        'id_tcredito'=>6      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar puntualidad en pago de deudas a entidades financieras de los deudores y garantes (último recibo de pago, extractos de crédito o plan de pagos)',       
        'id_tcredito'=>6      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos paras medir el nivel patrimonial de deudores y garantes en relación al préstamo (deudores directos 200 % la relación entre el préstamo y su patrimonio; garantes 100% la relación entre el préstamo y su patrimonio)',       
        'id_tcredito'=>6      
    ]);
     Requisitos::create([
        'descripcion'=>'Los deudores y garantes asalariados deben presentar un Poder Notariado específico para cobro de haberes, si corresponde.',       
        'id_tcredito'=>6      
    ]);
     Requisitos::create([
        'descripcion'=>'Fotocopias de C.I. del deudor, codeudor y garante (este último si corresponde)',       
        'id_tcredito'=>6      
    ]);
     Requisitos::create([
        'descripcion'=>'Comprobante de pago servicios básicos último mes del deudor y garantes (luz, agua o gas)',       
        'id_tcredito'=>6      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar la capacidad de pago del deudor (últimas tres papeletas de sueldo y/o rentas, certificado de trabajo, extracto reciente de aportes a las AFPs, cuaderno de registros de compra-venta, talonarios de facturación y/o recibos de ventas u otros respaldos); de los garantes (última papeleta de sueldo y una papeleta de sueldo de hace 12 meses atrás, si no presenta extracto de aportes a las AFPs)',       
        'id_tcredito'=>6      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar la actividad de deudores y garantes (NIT, licencia de funcionamiento, certificaciones, afiliaciones, credenciales u otros respaldos)',       
        'id_tcredito'=>6      
    ]);
     Requisitos::create([
        'descripcion'=>'Informe de la Aseguradora autorizada sobre la aceptación o rechazo del Seguro de Desgravamen del socio o solicitantes)',       
        'id_tcredito'=>6      
    ]);
     Requisitos::create([
        'descripcion'=>'Información sobre riesgo crediticio de deudores y garantes (INFOCRED u otro autorizado por la institución)',       
        'id_tcredito'=>6      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar puntualidad en pago de deudas a entidades financieras de los deudores y garantes (último recibo de pago, extractos de crédito o plan de pagos)',       
        'id_tcredito'=>6      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos paras medir el nivel patrimonial de deudores y garantes en relación al préstamo (deudores directos 200% la relación entre el préstamo y su patrimonio; garantes 100% la relación entre el préstamo y su patrimonio)',       
        'id_tcredito'=>6      
    ]);
     Requisitos::create([
        'descripcion'=>'Los deudores y garantes asalariados deben presentar un Poder Notariado específico para cobro de haberes.',       
        'id_tcredito'=>6      
    ]);
     Requisitos::create([
        'descripcion'=>'Presentación de garantías (documentos originales: inmuebles (folio real actualizado o información rápida de Derechos Reales, testimonio, plano aprobado de lote, plano de construcción si corresponde, último pago de impuestos u otros si corresponde; vehículos (RUA, póliza de importación, Poder notariado si corresponde, Formulario de registro de vehículo FRV, último pago de impuestos, certificado alodial si corresponde, resolución de inscripción de tránsito si corresponde, informe técnico de autenticidad de DIPROVE si corresponde, fotocopia de SOAT actualizado, informe de inspección técnica si corresponde); maquinaria pesada (póliza de importación, FRV, contrato de transferencia con reconocimiento de firmas si corresponde, Factura o Nota de compra si corresponde)',       
        'id_tcredito'=>6      
    ]);
     Requisitos::create([
        'descripcion'=>'Informe de verificación por el Oficial de Créditos',       
        'id_tcredito'=>6      
    ]);
     Requisitos::create([
        'descripcion'=>'Informe Legal de la garantía, realizado por Asesor Legal interno.',       
        'id_tcredito'=>6      
    ]);
     Requisitos::create([
        'descripcion'=>'Poder especifico del dueño a los prestatarios (si corresponde)',       
        'id_tcredito'=>6      
    ]);
     Requisitos::create([
        'descripcion'=>'Verificación de la relación garantía-préstamo: inmuebles 1.25 a 1 sobre el valor hipotecario; vehículos y equipo y maquinaria pesada: 1.75 a 1, sobre el valor comercial.',       
        'id_tcredito'=>6      
    ]);
        //Microcredito Con otras garantias y/o personal
     Requisitos::create([
        'descripcion'=>'Fotocopias de C.I. del deudor, codeudor y garante (este último si corresponde)',       
        'id_tcredito'=>7      
    ]);
     Requisitos::create([
        'descripcion'=>'Comprobante de pago servicios básicos último mes de deudores y garantes (luz, agua o gas)',       
        'id_tcredito'=>7      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar la capacidad de pago del deudor (últimas tres papeletas de sueldo y/o rentas, certificado de trabajo, extracto reciente de aportes a las AFPs, cuaderno de registros de compra-venta, talonarios de facturación y/o recibos de ventas u otros respaldos); de los garantes (última papeleta de sueldo y una papeleta de sueldo de hace 12 meses atrás; si no presentara extracto de reportes a las AFPs)',       
        'id_tcredito'=>7      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar la actividad de deudores y garantes (NIT, licencia de funcionamiento, certificaciones, afiliaciones, credenciales u otros respaldos)',       
        'id_tcredito'=>7      
    ]);
     Requisitos::create([
        'descripcion'=>'Informe de la Aseguradora autorizada sobre la aceptación o rechazo del Seguro de Desgravamen de los socios solicitantes',       
        'id_tcredito'=>7      
    ]);
     Requisitos::create([
        'descripcion'=>'Información sobre riesgo crediticio de deudores y garantes (INFOCRED u otro autorizado por la institución)',       
        'id_tcredito'=>7      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos del destino del crédito (cotizaciones, contrato de pre-compra u otros respaldos) si corresponde.',       
        'id_tcredito'=>7      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar puntualidad en pago de deudas a entidades financieras de los deudores y garantes (último recibo de pago, extractos de crédito o plan de pagos)',       
        'id_tcredito'=>7      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos paras medir el nivel patrimonial de deudores y garantes en relación al préstamo (deudores directos 200% la relación entre el préstamo y su patrimonio; garantes 100% la relación entre el préstamo y su patrimonio)',       
        'id_tcredito'=>7      
    ]);
     Requisitos::create([
        'descripcion'=>'Los deudores y/o garantes asalariados deben presentar un Poder Notariado específico para cobro de haberes.',       
        'id_tcredito'=>7      
    ]);
     Requisitos::create([
        'descripcion'=>'Presentación de garantías (documentos originales: inmuebles (folio real actualizado o información rápida de Derechos Reales, testimonio, plano aprobado de lote, plano de construcción si corresponde, último pago de impuestos u otros si corresponde; vehículos (RUA, póliza de importación, Poder notariado si corresponde, Formulario de registro de vehículo FRV, último pago de impuestos, certificado alodial si corresponde, resolución de inscripción de tránsito si corresponde, informe técnico de autenticidad de DIPROVE si corresponde, fotocopia de SOAT actualizado, informe de inspección técnica actualizado si corresponde)',       
        'id_tcredito'=>7      
    ]);
     Requisitos::create([
        'descripcion'=>'Informe técnico de la garantía, realizado por perito tasador.',       
        'id_tcredito'=>7      
    ]);
     Requisitos::create([
        'descripcion'=>'Informe Legal de la garantía',       
        'id_tcredito'=>7      
    ]);
     Requisitos::create([
        'descripcion'=>'Poder especifico del dueño a los acreedores (si corresponde)',       
        'id_tcredito'=>7      
    ]);
     Requisitos::create([
        'descripcion'=>'Verificación de la relación garantía-préstamo: inmuebles 1.25 a 1 sobre el valor hipotecario; vehículos y equipo y maquinaria pesada: 1.75 a 1 sobre el valor de venta rápida.',       
        'id_tcredito'=>7      
    ]);
        //Microcredito  debidamente garantizado

   Requisitos::create([
        'descripcion'=>'Fotocopias de C.I. del deudor, codeudor y garante (este último si corresponde)',       
        'id_tcredito'=>8      
    ]);
   Requisitos::create([
        'descripcion'=>'Comprobante de pago servicios básicos último mes de deudores y garantes (luz, agua o gas)',       
        'id_tcredito'=>8     
    ]);
    Requisitos::create([
        'descripcion'=>'Respaldos para sustentar la capacidad de pago del deudor (últimas tres papeletas de sueldo y/o rentas, certificado de trabajo, extracto reciente de aportes a las AFPs, cuaderno de registros de compra-venta, talonarios de facturación y/o recibos de ventas u otros respaldos); de los garantes (última papeleta de sueldo y una papeleta de sueldo de hace 12 meses atrás; si no presentara extracto de reportes a las AFPs)',       
        'id_tcredito'=>8     
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar la actividad de deudores y garantes (NIT, licencia de funcionamiento, certificaciones, afiliaciones, credenciales u otros respaldos)',       
        'id_tcredito'=>8     
    ]);
      Requisitos::create([
        'descripcion'=>'Informe de la Aseguradora autorizada sobre la aceptación o rechazo del Seguro de Desgravamen de los socios solicitantes',       
        'id_tcredito'=>8     
    ]);

       Requisitos::create([
        'descripcion'=>'Información sobre riesgo crediticio de deudores y garantes (INFOCRED u otro autorizado por la institución)',       
        'id_tcredito'=>8     
    ]);
        Requisitos::create([
        'descripcion'=>'Respaldos del destino del crédito (cotizaciones, contrato de pre-compra u otros respaldos) si corresponde.',       
        'id_tcredito'=>8     
    ]);
         Requisitos::create([
        'descripcion'=>'Respaldos para sustentar puntualidad en pago de deudas a entidades financieras de los deudores y garantes (último recibo de pago, extractos de crédito o plan de pagos)',       
        'id_tcredito'=>8     
    ]);
          Requisitos::create([
        'descripcion'=>'Respaldos paras medir el nivel patrimonial de deudores y garantes en relación al préstamo (deudores directos 200% la relación entre el préstamo y su patrimonio; garantes 100% la relación entre el préstamo y su patrimonio)',       
        'id_tcredito'=>8     
    ]);
           Requisitos::create([
        'descripcion'=>'Los deudores y/o garantes asalariados deben presentar un Poder Notariado específico para cobro de haberes.',       
        'id_tcredito'=>8     
    ]);
            Requisitos::create([
        'descripcion'=>'Presentación de garantías (documentos originales: inmuebles (folio real actualizado o información rápida de Derechos Reales, testimonio, plano aprobado de lote, plano de construcción si corresponde, último pago de impuestos u otros si corresponde; vehículos (RUA, póliza de importación, Poder notariado si corresponde, Formulario de registro de vehículo FRV, último pago de impuestos, certificado alodial si corresponde, resolución de inscripción de tránsito si corresponde, informe técnico de autenticidad de DIPROVE si corresponde, fotocopia de SOAT actualizado, informe de inspección técnica actualizado si corresponde)',       
        'id_tcredito'=>8     
    ]);

             Requisitos::create([
        'descripcion'=>'Informe técnico de la garantía, realizado por perito tasador.',       
        'id_tcredito'=>8     
    ]);
              Requisitos::create([
        'descripcion'=>'Informe Legal de la garantía',       
        'id_tcredito'=>8     
    ]);
               Requisitos::create([
        'descripcion'=>'Poder especifico del dueño a los acreedores (si corresponde)',       
        'id_tcredito'=>8     
    ]);
                Requisitos::create([
        'descripcion'=>'Verificación de la relación garantía-préstamo: inmuebles 1.25 a 1 sobre el valor hipotecario; vehículos y equipo y maquinaria pesada: 1.75 a 1 sobre el valor de venta rápida.',       
        'id_tcredito'=>8     
    ]);  
    	//Créditos de vivienda sin garantia a sola fima
     Requisitos::create([
        'descripcion'=>'Fotocopias de C.I. del deudor, codeudor (cónyuge)',       
        'id_tcredito'=>9      
    ]);
     Requisitos::create([
        'descripcion'=>'Comprobante de pago servicios básicos último mes (luz, agua, o gas)',       
        'id_tcredito'=>9      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar la capacidad de pago de los deudores (últimas tres papeletas de sueldo, certificado de trabajo, extracto reciente de aportes a las AFPs, cuaderno de registros de compra-venta, talonarios de facturación y/o recibos de ventas, otros respaldos)',       
        'id_tcredito'=>9      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar la actividad de deudores (NIT, licencia de funcionamiento, certificaciones, afiliaciones, credenciales u otros respaldos)',       
        'id_tcredito'=>9      
    ]);
     Requisitos::create([
        'descripcion'=>'Informe de la Aseguradora autorizada sobre la aceptación o rechazo del Seguro de Desgravamen del socio solicitante.',       
        'id_tcredito'=>9      
    ]);
     Requisitos::create([
        'descripcion'=>'Información sobre riesgo crediticio de los deudores (INFOCRED, RUI-SEGIP u otro autorizado por los solicitantes a travez de la institución)',       
        'id_tcredito'=>9      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar puntualidad en pago de deudas a entidades financieras de los deudores (último recibo de pago, extracto de crédito o plan de pagos)',       
        'id_tcredito'=>9      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos paras medir el nivel patrimonial de los deudores en relación al préstamo (deudores directos 200 % relación entre el préstamo y su patrimonio).',       
        'id_tcredito'=>9      
    ]);
     Requisitos::create([
        'descripcion'=>'Fotocopia de documentos terreno, inmueble a nombre del socio o por secesión hereditaria.',       
        'id_tcredito'=>9      
    ]);
     Requisitos::create([
        'descripcion'=>'Número de tarjeta de UNINET o similar, donde le depositan sus haberes (si corresponde)',       
        'id_tcredito'=>9      
    ]);
     Requisitos::create([
        'descripcion'=>'Plazo 24 meses.',       
        'id_tcredito'=>9      
    ]);
     Requisitos::create([
        'descripcion'=>'Presupuesto de obra elaborada por lo menos por un albañil.',       
        'id_tcredito'=>9      
    ]);
        //vivienda  Con documentos en custodia
     Requisitos::create([
        'descripcion'=>'Fotocopias de C.I. del deudor, codeudor y garante si corresponde',       
        'id_tcredito'=>10      
    ]);
     Requisitos::create([
        'descripcion'=>'Comprobante de pago servicios básicos último mes de los deudores (luz, agua, o gas)',       
        'id_tcredito'=>10      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar la capacidad de pago de deudores y garantes si corresponde (últimas tres papeletas de sueldo y/o rentas, certificados de trabajo, extracto reciente de aportes a las AFPs, cuaderno de registros de compra-venta, talonarios de facturación y/o recibos de ventas, otros respaldos)',       
        'id_tcredito'=>10      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar la actividad de deudores y garantes (NIT, licencia de funcionamiento, certificaciones, afiliaciones, credenciales u otros respaldos)',       
        'id_tcredito'=>10      
    ]);
     Requisitos::create([
        'descripcion'=>'Informe de la Aseguradora autorizada sobre la aceptación o rechazo del Seguro de Desgravamen del socio',       
        'id_tcredito'=>10      
    ]);
     Requisitos::create([
        'descripcion'=>'Información sobre riesgo crediticio de deudores y garantes (INFOCRED, RUI-SEGIP autorizado por los solicitantes a travez de la instituciónu otro autorizado por la institución)',       
        'id_tcredito'=>10      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos del destino del crédito (cotizaciones, presupuestos, fotocopia u originales de inmueble a adquirir en calidad de compra u otros respaldos)',       
        'id_tcredito'=>10      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar puntualidad en pago de deudas a entidades financieras, de deudores y garantes (último recibo de pago, extractos de crédito o plan de pagos)',       
        'id_tcredito'=>10      
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos paras medir el nivel patrimonial de deudores y garantes en relación al préstamo (deudores directos 200 % la relación entre el préstamo y su patrimonio; garantes 140% la relación entre el préstamo y su patrimonio)',       
        'id_tcredito'=>10      
    ]);
     Requisitos::create([
        'descripcion'=>'Presentación de garantías (créditos hipotecario y/o en custodia: documentos originales del mismo inmueble (folio real, información rápida de Derechos Reales si corresponde, testimonio, plano aprobado de lote, plano de construcción si corresponde, último pago de impuestos u otros si corresponde) (créditos sin hipoteca: originales del mismo inmueble (folio real, información rápida si corresponde, testimonio, plano aprobado de lote, plano de construcción si corresponde, último pago de impuestos u otros si corresponde)',       
        'id_tcredito'=>10      
    ]);
     Requisitos::create([
        'descripcion'=>'Informes del perito tasador del inmueble (si corresponde)',       
        'id_tcredito'=>10      
    ]);
     Requisitos::create([
        'descripcion'=>'Informe Legal de la garantía.',       
        'id_tcredito'=>10      
    ]);
     Requisitos::create([
        'descripcion'=>'Poder especifico del dueño al o los prestatarios (si corresponde)',       
        'id_tcredito'=>10      
    ]);
     Requisitos::create([
        'descripcion'=>'Presupuesto de ampliación, refacción y/o construcción nueva, elaborado por perito ó albañil si corresponde; para determinar las fases de seguimiento y desembolsos.',       
        'id_tcredito'=>10      
    ]);
     Requisitos::create([
        'descripcion'=>'Verificar si la garantía cubre el 1.25 a 1 sobre el valor de Hipotecario',       
        'id_tcredito'=>10      
    ]);
        
        
            //Créditos hipotecario de vivienda
     Requisitos::create([
        'descripcion'=>'Fotocopias de C.I. del deudor, codeudor (cónyuge)',       
        'id_tcredito'=>11     
    ]);
     Requisitos::create([
        'descripcion'=>'Comprobante de pago servicios básicos último mes (luz, agua, o gas)',       
        'id_tcredito'=>11     
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar la capacidad de pago de los deudores (últimas tres papeletas de sueldo, certificado de trabajo, extracto reciente de aportes a las AFPs, cuaderno de registros de compra-venta, talonarios de facturación y/o recibos de ventas, otros respaldos)',       
        'id_tcredito'=>11     
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar la actividad de deudores (NIT, licencia de funcionamiento, certificaciones, afiliaciones, credenciales u otros respaldos)',       
        'id_tcredito'=>11     
    ]);
     Requisitos::create([
        'descripcion'=>'Informe de la Aseguradora autorizada sobre la aceptación o rechazo del Seguro de Desgravamen del socio solicitante.',       
        'id_tcredito'=>11     
    ]);
     Requisitos::create([
        'descripcion'=>'Información sobre riesgo crediticio de los deudores (INFOCRED, RUI-SEGIP u otro autorizado por los solicitantes a travez de la institución)',       
        'id_tcredito'=>11     
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos para sustentar puntualidad en pago de deudas a entidades financieras de los deudores (último recibo de pago, extracto de crédito o plan de pagos)',       
        'id_tcredito'=>11     
    ]);
     Requisitos::create([
        'descripcion'=>'Respaldos paras medir el nivel patrimonial de los deudores en relación al préstamo (deudores directos 200 % relación entre el préstamo y su patrimonio).',       
        'id_tcredito'=>11     
    ]);
     Requisitos::create([
        'descripcion'=>'Fotocopia de documentos terreno, inmueble a nombre del socio o por secesión hereditaria.',       
        'id_tcredito'=>11     
    ]);
     Requisitos::create([
        'descripcion'=>'Número de tarjeta de UNINET o similar, donde le depositan sus haberes (si corresponde)',       
        'id_tcredito'=>11     
    ]);
     Requisitos::create([
        'descripcion'=>'Plazo 24 meses.',       
        'id_tcredito'=>11     
    ]);
     Requisitos::create([
        'descripcion'=>'Presupuesto de obra elaborada por lo menos por un albañil.',       
        'id_tcredito'=>11     
    ]); 
 }
}
