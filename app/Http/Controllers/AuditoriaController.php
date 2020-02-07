<?php

namespace sis5cs\Http\Controllers;

use Illuminate\Http\Request;
use sis5cs\Auditoria;
class AuditoriaController extends Controller
{
   public function __construct()
	{
		$this->middleware('auth');
	}
	public function index(Request $request)
	{
		if ($request)
		{
			$auditorias=Auditoria::All();
			return view('auditoria.index')->with(compact('auditorias'));
        }//busqueda por nombre y ci
    	/*$clientes=Cliente::paginate(7);
    	return view('cliente.crud.index')->with(compact('clientes'));//listado*/
    }  


    public function scor($id)
    {
    	$persona=Persona::find($id);
       //tabla credito
    	$credito=Credito::where('id_persona',$id)->firstOrFail();
    	$tipo_credito=TipoCredito::where('id_tcredito',$credito->id_tcredito)->firstOrFail()->tipo_credito;
       $edad = Carbon::parse($persona->fec_nac)->age; // 1990-10-25 
      //Tabla direccion
       $direccion=Direccion::where('id_persona',$id)->firstOrFail();
       $tipo_vivienda=TipoVivienda::where('id_tipo_vivienda',$direccion->id_tipo_vivienda)->firstOrFail()->tipo_vivienda;
       $tiempo_residencia=Carbon::parse($direccion->tiempo_residencia)->month;
       return view('scor.scor')->with(compact('persona','credito','direccion'))->with('tipo_credito',$tipo_credito)->with('edad',$edad)->with('tipo_vivienda',$tipo_vivienda)->with('tiempo_residencia',$tiempo_residencia); //formulario de registro
   }
}
