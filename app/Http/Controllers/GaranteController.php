<?php

namespace sis5cs\Http\Controllers;

use Illuminate\Http\Request;
use sis5cs\Garante;
use sis5cs\Persona;
use sis5cs\Profesion;
use sis5cs\Http\Requests\GaranteFormRequest;
use sis5cs\Http\Requests\PersonaFormRequest;
use DB;

class GaranteController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
     public function index(Request $request)
    {
    	 if ($request)
        {
             $query=trim($request->get('searchText'));
             $garantes=DB::table('persona as p')
             ->join('garante as g','g.id_persona','=','p.id_persona')
             ->select('p.id_persona','p.ci','p.nombre','p.ap_paterno','p.ap_materno','p.ap_casada','p.fec_nac','p.genero','p.celular','p.dependientes','p.estado_civil','p.id_profesion','g.id_garante as id_garante')
            ->where('p.nombre','ILIKE','%'.$query.'%')
       
            ->orderBy('id_garante','desc')
            ->paginate(7);
            return view('garante.crud.index',["garantes"=>$garantes,"searchText"=>$query]);

        }//busqueda por nombre y ci
    	/*$clientes=Cliente::paginate(7);
        return view('cliente.crud.index')->with(compact('clientes'));//listado*/
    }
    public function create()
    {
        $personas=Persona::all();
        $clientes=DB::table('persona as p')
             ->join('cliente as c','c.id_persona','=','p.id_persona')
             ->select('p.id_persona','p.ci','p.nombre','p.ap_paterno','p.ap_materno','p.ap_casada','p.fec_nac','p.genero','p.celular','p.dependientes','p.estado_civil','p.id_profesion','c.id_cliente')->get();

        return view('garante.crud.create')->with(compact('personas','clientes'));//listado

    }
    public function store(GaranteFormRequest $request)
    {
       // registrar el nuevo cliente
    	//dd($request->all()); //método dd muestra el contenido del array
      $garante= new Garante();     
      $garante->id_persona=$request->input('id_persona');
      $garante->id_cliente=$request->input('id_cliente');
      $garante->save(); //metodo se encarga de ejecutar un insert sobre la tabla

      return redirect('/garante/crud');
    }

     public function edit($id)
    {
      $persona=Persona::find($id);
      $profesion=Profesion::all();
      return view('garante.crud.edit')->with(compact('persona','profesion')); //formulario de registro
    }
    public function update(PersonaFormRequest $request,$id)
    {
      // registrar el nuevo cliente
      // dd($request->all()); método dd muestra el contenido del array
      $persona= Persona::find($id);    	
     //concatenar     
  
      $persona->ci=$request->input('ci');
      $persona->nombre=$request->input('nombre');
      $persona->ap_paterno=$request->input('ap_paterno');
      $persona->ap_materno=$request->input('ap_materno');
      $persona->ap_casada=$request->input('ap_casada');
      $persona->fec_nac=$request->input('fec_nac');
      $persona->genero=$request->input('genero');
      $persona->celular=$request->input('celular');
      $persona->dependientes=$request->input('dependientes');
      $persona->estado_civil=$request->input('estado_civil');
      $persona->id_profesion=$request->input('id_profesion');
      $persona->save(); //update

      return redirect('/garante/crud');
    }

     public function destroy($id)
    {

      $persona= Persona::find($id); 
      $persona->delete(); //delete
      return back();
    }
}
