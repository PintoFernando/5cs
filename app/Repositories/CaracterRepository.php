<?php
namespace sis5cs\Repositories;

use sis5cs\Persona;
use sis5cs\Credito;
use sis5cs\TipoCredito;
use Carbon\Carbon;
use sis5cs\Direccion;
use sis5cs\TipoVivienda;
use sis5cs\ActividadEconomica;
//repositories
use sis5cs\Repositories\PuntajeRepository;
class CaracterRepository{   

    public  function caracter($id)
    {
    $persona = Persona::find($id);
    return $persona;
    //tabla credito    
    $this->$credito = Credito::where('id_persona', $id)->firstOrFail();
    $this->$capacidad_pago12 =CapacidadPago::where('id_persona', $id)->firstOrFail();
    $this->$tipo_credito = TipoCredito::where('id_tcredito', $credito->id_tcredito)->firstOrFail()->tipo_credito;
    $this->$edad = Carbon::parse($persona->fec_nac)->age; //1990-10-25 
        //Tabla direccion
    $this->$direccion = Direccion::where('id_persona', $id)->firstOrFail();
    $this->$tipo_vivienda = TipoVivienda::where('id_tipo_vivienda', $direccion->id_tipo_vivienda)->firstOrFail()->tipo_vivienda;

       //creación de 
    $now = Carbon::now();
    $this->$tiempo_residencia = Carbon::parse($direccion->tiempo_residencia)->diffInMonths($now);
       //cálculo de puntaje
    $this->$ptipo_residencia = PuntajeRepository::tipo_residencia($direccion->id_tipo_vivienda);
    $this->$ptiempo_residencia = PuntajeRepository::tiempo_residencia($tiempo_residencia);
    $this->$total_residencia = $ptipo_residencia + $ptiempo_residencia;
      //datos economicos Depenciente

      //datos de actividad economica (independiente)

       //calculo total de tiempo de negocio dependiente independiente
    $this->$total_tiempo_negocio = PuntajeRepository::tiempoNegocio($this->tiempoTrabajoEmpresa($id)) + PuntajeRepository::tiempoNegocio($this->tiempoTrabajoActividad($id));      
      //experiencia crediticia
       //calculo experiencia crediticia
      //calculo total de c1
    $this->$total_c1 = $total_residencia + $total_tiempo_negocio + PuntajeRepository::experiencia_cre_ultimo($this->experienciaCrediticia($id));
       //porcentaje de c1
    $this->$porcentaje_c1 = ($total_c1 * 25) / 50;
    
    }


    //FUNCIONES C1
    public function tiempoTrabajoEmpresa($id)
  {
         //Datos economicos Depenciente
    $if_exist_codeudor = DatosEmpresa::where('id_persona', $id)->exists();
    if ($if_exist_codeudor) {
      $now = Carbon::now();
      $datos_empresa = DatosEmpresa::where('id_persona', $id)->firstOrFail();
      $tiempo_de_trabajo_empresa = Carbon::parse($datos_empresa->antiguedad_empresa)->diffInMonths($now);
      return $tiempo_de_trabajo_empresa;
    } else {
      return 0;
    }
  }

  public function tiempoTrabajoActividad($id)
  {
   //Datos economicos Depenciente
    $if_exist_codeudor = ActividadEconomica::where('id_persona', $id)->count();
    if ($if_exist_codeudor > 0) {
      $now = Carbon::now();
      $actividad_economica = ActividadEconomica::where('id_persona', $id)->firstOrFail();
      $tiempo_de_trabajo = Carbon::parse($actividad_economica->antiguedad_trabajo_ae)->diffInMonths($now);
      return $tiempo_de_trabajo;
    } else {
      return 0;
    }
  }


  public function experienciaCrediticia($id)
  {
    $if_exist_codeudor = ReporteBuro::where('id_persona', $id)->count();
    if ($if_exist_codeudor > 0) {

      $tiempo_maximo_mora = ReporteBuro::where('id_persona', $id)->firstOrFail()->tiempo_maximo_mora;
      return $tiempo_maximo_mora;
    } else {
      return 0;
    }
  }

  public function penultima_experienciaCrediticia($id)
  {
    $if_exist_codeudor = ReporteBuro::where('id_persona', $id)->count();
    
    if ($if_exist_codeudor >=2) 
    {
      $reporte = ReporteBuro::where('id_persona', $id)->get()->last();
      return $reporte->tiempo_maximo_mora;
    } else 
    {
      return 0;
    }
  }
  //FIN FUNCIONES C1
}