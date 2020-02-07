<?php
namespace sis5cs\Http\Controllers;
use Illuminate\Http\Request;
use sis5cs\Http\Requests\VentasFormRequest;
use sis5cs\Ventas;
use sis5cs\Persona;
use DB;

use RealRashid\SweetAlert\Facades\Alert;

class VentasController extends Controller
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
           $ventas=DB::table('ventas as v')
            ->join('persona as p','p.id_persona','=','v.id_persona')
            ->select('v.id_ventas','v.producto','v.venta_diaria_min','v.venta_diaria_max',
            	'v.venta_semanal_min','v.venta_semanal_max','v.venta_mensual_min','v.venta_mensual_max','p.id_persona')
            ->where('v.producto','ILIKE','%'.$query.'%')
            ->orderBy('id_ventas','desc')
            ->paginate(7);
            return view('ventas.crud.index',["ventas"=>$ventas,"searchText"=>$query]);
        }//busqueda por nombre y ci
      /*$clientes=Cliente::paginate(7);
        return view('cliente.crud.index')->with(compact('clientes'));//listado*/
    }
    public function create()
    {
       $ventas=Ventas::All();
       $personas=Persona::All();
       return view('ventas.crud.create')->with(compact('ventas','personas'));
    }
    public function store(VentasFormRequest $request)
    {
       // registrar el nuevo cliente
      // dd($request->all()); método dd muestra el contenido del array
     //concatenar     
      $ve= new Ventas(); 
      $ve->producto=$request->input('producto');
      $ve->venta_diaria_min=$request->input('venta_diaria_min');
      $ve->venta_diaria_max=$request->input('venta_diaria_max');
      $ve->venta_semanal_min=$request->input('venta_semanal_min');
      $ve->venta_semanal_max=$request->input('venta_semanal_max');
      $ve->venta_mensual_min=$request->input('venta_mensual_min');
      $ve->venta_mensual_max=$request->input('venta_mensual_max');
      $ve->id_persona=$request->input('id_persona');   
      $ve->save(); //metodo se encarga de ejecutar un insert sobre la tabla
      return redirect('/ventas/crud');
    }

     public function edit($id)
    {
      $Ventas=Ventas::find($id);
      $persona=Persona::All();
      return view('ventas.crud.edit')->with(compact('Ventas','persona')); //formulario de registro
    }
    public function update(VentasFormRequest $request,$id)
    {
      // registrar el nuevo cliente
      // dd($request->all()); método dd muestra el contenido del array
      $vehi=Ventas::find($id); 
      $vehi->tipo=$request->input('tipo');
      $vehi->marca=$request->input('marca');
      $vehi->modelo=$request->input('modelo');
      $vehi->placa=$request->input('placa');
      $vehi->rua=$request->input('rua');
      $vehi->en_garantia=$request->input('en_garantia');
      $vehi->valor=$request->input('valor');
      //$vehi->id_persona=$request->input('id_persona');
      $vehi->save(); //metodo se encarga de ejecutar un insert sobre la tabla
      return redirect('/Ventas/crud');
    }
    public function destroy($id)
    {
      $vehi=Ventas::find($id); 
      $vehi->delete(); //delete      
       alert() -> error ( ' Oops ... ' , '¡ Algo salió mal! ' );
      $notification= 'El vehículo ha sido eliminado correctamente';
      return back()->with(compact('notification'));
    }
}
