<?php

namespace sis5cs\Http\Controllers;

use Carbon\Carbon;
use sis5cs\Persona;
use DB;
use sis5cs\Seguimiento;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_socios = Persona::count();
        $creditos = DB::table('credito')
        ->join('persona', 'credito.id_persona', '=', 'persona.id_persona')
        ->select('credito.id_credito', 'credito.monto_solicitado', 'credito.id_tcredito', 'credito.desembolsado', 'persona.*')
        ->where('desembolsado', '=', null)
        ->get();
        $cont1 = 0;
        $cont2 = 0;
        foreach ($creditos as $cre) {
            if (Carbon::parse($cre->created_at)->diffInDays(Carbon::parse(Carbon::now())) > $this->limites($cre->id_tcredito)) {
                $cont1++;
            } else {
                $cont2++;
            }
        }
        return view('home.home')->with(compact('total_socios'))
        ->with('cont1',$cont1)
        ->with('cont2',$cont2)
        ;
    }


//mensajes
    public function show($id)
    {
        $observacion=Seguimiento::findOrFail($id);
        return view('mensaje.show',compact('observacion'));
    }
    protected function limites($a)
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

}
