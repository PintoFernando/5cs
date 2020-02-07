<?php

namespace sis5cs\Http\Controllers;

use Illuminate\Http\Request;
use App\Directorio;
use App\Http\Requests\DirectorioFormRequest;
use DB;
use COM;

class DirectorioController extends Controller
{
 public function index(Request $request)
 {
   if ($request)
   {
    $query=trim($request->get('searchText'));
    $directorios=DB::table('directorio')
    ->where('nombre','ILIKE','%'.$query.'%')
    ->orderBy('id','desc')
    ->paginate(7);
    return view('directorio.crud.index',["directorios"=>$directorios,"searchText"=>$query]);

        }//busqueda por nombre y ci
    	/*$clientes=Cliente::paginate(7);
      return view('cliente.crud.index')->with(compact('clientes'));//listado*/
    }
    public function create()
    {
      $directorios=Directorio::all();
        return view('directorio.crud.create')->with(compact('directorios'));//listado
      }
      public function store(DirectorioFormRequest $request)
      {
        $directorio= new Directorio();     
        $directorio->nombre=$request->input('nombre');
        $directorio->telefono='+591'.$request->input('telefono');
        $directorio->save(); //metodo se encarga de ejecutar un insert sobre la tabla

        return redirect('/directorio/crud');
      }

      public function edit($id)
      {
        $directorio=Directorio::find($id);
      return view('directorio.crud.edit')->with(compact('directorio')); //formulario de registro
    }

    public function enviar($id)
    {
      $directorio=Directorio::find($id);
      return view('directorio.crud.enviar')->with(compact('directorio')); //formulario de registro
    }
    public function enviar1(DirectorioFormRequest $request,$id)
    {
      $directorio= Directorio::find($id); 
      $directorio->nombre=$request->input('nombre');
      $directorio->telefono=$request->input('telefono');
      $mensaje =$request->input('mensaje');
      //$mensaje = "hola max desde laravel)";
      $receptor = $request->input('telefono ');
      $objGsmOut = new COM ("ActiveXperts.GsmOut");
      $archivo = 'C:/';
      $dispositivo = 'COM7';
      $velocidad = 0;  
      $objGsmOut->LogFile          = $archivo; 
      $objGsmOut->Device           = $dispositivo;
      $objGsmOut->DeviceSpeed      = $velocidad;         
      $objGsmOut->MessageRecipient = $receptor;
      $objGsmOut->MessageData      = $mensaje;          
      if($objGsmOut->LastError == 0)
      {
        $objGsmOut->Send;
       echo "exito";
      }
      else
      {
        return redirect('/directorio/crud/error');
      }

      
    }
    public function update(DirectorioFormRequest $request,$id)
    {
      // registrar el nuevo cliente
      // dd($request->all()); método dd muestra el contenido del array
      $directorio= Directorio::find($id);    	
     //concatenar     

      $directorio->nombre=$request->input('nombre');
      $directorio->telefono=$request->input('telefono');
      $directorio->save(); //update

      return redirect('/directorio/crud');
    }

    public function destroy($id)
    {

      $directorio= Directorio::find($id); 
      $directorio->delete(); //delete

      return back();
    }

    public function sms($id)
    {

      $mensaje = "hola max desde php .)";
      $receptor = "+59174220303";
      $objGsmOut = new COM ("ActiveXperts.GsmOut");
      $archivo = 'C:/';
      $dispositivo = 'COM7';
      $velocidad = 0;  
      $objGsmOut->LogFile          = $archivo; 
      $objGsmOut->Device           = $dispositivo;
      $objGsmOut->DeviceSpeed      = $velocidad;         
      $objGsmOut->MessageRecipient = $receptor;
      $objGsmOut->MessageData      = $mensaje;          
      if($objGsmOut->LastError == 0)
      {
        $objGsmOut->Send;
        echo 'OK';
      }
      else
      {
        echo "no se envio sms";
      }
    }
}
