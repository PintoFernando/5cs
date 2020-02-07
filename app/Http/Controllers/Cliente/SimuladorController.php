<?php

namespace sis5cs\Http\Controllers\Cliente;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use sis5cs\Persona;
use sis5cs\TipoCredito;
use sis5cs\Requisitos;
class SimuladorController extends Controller
{
	public function __construct()
    {
      $this->middleware('auth');
    }
	public $id_tcredito;
	public function index(Request $request){
		if ($request)
		{
			$this->id_tcredito=$request->input('id_tcredito');
			$requisitos=DB::table('requisitos')
			->where('id_tcredito','=',$this->id_tcredito)
			->get();
			$tipocredito=TipoCredito::all();
            //->paginate(7);
			return view('cliente.simulador.index',["requisitos"=>$requisitos,"id"=>$this->id_tcredito,"tipocredito"=>$tipocredito]);
		}
	}	
}
