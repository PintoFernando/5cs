<?php
namespace sis5cs\Http\Controllers\JefeCredito;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use sis5cs\Credito;

class MarcarController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index(Request $request)
  {
   $creditos= DB::table('credito')
   ->join('persona', 'credito.id_persona', '=', 'persona.id_persona')
   ->select('credito.*', 'persona.*')
   ->where('desembolsado',null)
   ->get();
   return view('jefecredito.marcar_credito.index')->with(compact('creditos'));
 }   
 public function edit($id)
 {
  $credito=Credito::find($id);
  if($credito->desembolsado==1){
    alert()->info('Info','Ya marcó crédito como desembolsado')->showConfirmButton();
    return redirect('jefecredito/marcar_credito/');
  }else
  {
     return view('jefecredito.marcar_credito.edit')->with(compact('credito')); //formulario de registro
  }
     
    }
    public function update(Request $request,$id)
    {   
      $cre=Credito::find($id); 
      $cre->desembolsado=$request->input('marcar');
      $cre->save(); 

      $notification= 'Exelente el crédito se ha marcado como desembolsado'; 
      return redirect('/jefecredito/marcar_credito/')->with(compact('notification'));
    }

  }
