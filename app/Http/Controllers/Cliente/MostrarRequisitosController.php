<?php

namespace sis5cs\Http\Controllers;
use Illuminate\Http\Request;
use sis5cs\TipoCredito;
use sis5cs\Requisitos;
use DB;
class MostrarRequisitosController extends Controller
{
    public function requisitos(Request $request)
    {
      if ($request)
      {
       $this->id_tcredito=$request->input('id_tcredito');
       $requisitos=DB::table('requisitos')
       ->where('id_tcredito','=',$this->id_tcredito)
       ->get();
       $tipocredito=TipoCredito::all();
      //->paginate(7);
       return view('/requisitos.requisitos',["requisitos"=>$requisitos,"id"=>$this->id_tcredito,"tipocredito"=>$tipocredito]);
     }
   }
}
