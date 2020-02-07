<?php
namespace sis5cs\Http\Controllers\Oficial;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use sis5cs\PrestamoBancario;
use sis5cs\TipoCredito;
use sis5cs\EntidadBancaria;
use sis5cs\Http\Requests\PrestamoBancarioFormRequest;
use DB;


class PrestamoBancarioGaranteController extends Controller
{
    public $id_persona_garante;
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index(Request $request)
	{
		if(Session::get('id_persona_garante')==null)
		{
			alert()->info('Info','Seleccione un Garante')->showConfirmButton();
			return redirect('oficial/garante/');
		}
		else
		{
			$prestamo=DB::table('prestamo_bancario')            
			->join('entidad_bancaria','prestamo_bancario.id_entidad_bancaria','=','entidad_bancaria.id_entidad_bancaria')           
			->join('tipo_credito','prestamo_bancario.id_tcredito','=','tipo_credito.id_tcredito')           
			->select('prestamo_bancario.*','entidad_bancaria.nombre_entidad','tipo_credito.tipo_credito')
			->where('id_persona',Session::get('id_persona_garante'))
			->get();			
			return view('oficial.a_garantes.prestamo_bancario.index')->with(compact('prestamo'));
		}

	}
	public function create()
	{    
		if(Session::get('id_persona_garante')==null)
		{
			alert()->info('Info','Seleccione un garante')->showConfirmButton();
			return redirect('oficial/garante/');
		}
		else
		{
			$if_exist=PrestamoBancario::where('id_persona',Session::get('id_persona_garante'))->count();
			if($if_exist>100)
			{
				alert()->info('Info','Ya registro los datos de prestamo Bancario.')->showConfirmButton();
				return redirect('oficial/a_garantes/prestamo_bancario/');
			}
			else
			{
				$entidad=EntidadBancaria::all();
				$tipo_credito=TipoCredito::all();
				return view('oficial.a_garantes.prestamo_bancario.create')->with(compact('entidad','tipo_credito'));
			}


		}

	}
	public function store(PrestamoBancarioFormRequest $request)
	{
		$this->id_persona_garante=Session::get('id_persona_garante');  
		$prestamo = new PrestamoBancario(); 
		$prestamo->importe_original=$request->input('importe_original');
		$prestamo->duracion_credito=$request->input('duracion_credito');
		$prestamo->importe_ultimo_pago=$request->input('importe_ultimo_pago');
		$prestamo->destino_credito=$request->input('destino_credito');
		$prestamo->saldo=$request->input('saldo');
		$prestamo->id_entidad_bancaria=$request->input('id_entidad_bancaria');
		$prestamo->id_persona=$this->id_persona_garante;
		$prestamo->id_tcredito=$request->input('id_tcredito');
        $prestamo->save(); //metodo se encarga de ejecutar un insert sobre la tabla
        return redirect('oficial/a_garantes/prestamo_bancario');
    }

    public function edit($id)
    {
    	if(Session::get('id_persona_garante')==null)
    	{
    		alert()->info('Info','Seleccione un garante')->showConfirmButton();
    		return redirect('oficial/garante/');
    	}
    	else
    	{
    		$prestamo=PrestamoBancario::find($id);
    		$credito=TipoCredito::All();
    		$entidad=EntidadBancaria::All();
      return view('oficial.a_garantes.prestamo_bancario.edit')->with(compact('prestamo','credito','entidad')); //formulario de registro
  }

}
public function update(PrestamoBancarioFormRequest $request,$id)
{

	$this->id_persona_garante=Session::get('id_persona_garante');
	$prestamo=PrestamoBancario::find($id); 
	$prestamo->importe_original=$request->input('importe_original');
	$prestamo->duracion_credito=$request->input('duracion_credito');
	$prestamo->importe_ultimo_pago=$request->input('importe_ultimo_pago');
	$prestamo->destino_credito=$request->input('destino_credito');
	$prestamo->saldo=$request->input('saldo');
	$prestamo->id_entidad_bancaria=$request->input('id_entidad_bancaria');
	$prestamo->id_persona=$this->id_persona_garante;
	$prestamo->id_tcredito=$request->input('id_tcredito');
    $prestamo->save(); //metodo se encarga de ejecutar un insert sobre la tabla
    return redirect('/oficial/a_garantes/prestamo_bancario');
}

    /*-------------
    public function destroy($id)
    {

     $cro=Croquis::find($id); 
      $cro->delete(); //delete
      return back();
  }--------------*/
}
