<?php
namespace sis5cs\Http\Controllers\apicredito;

use App\Http\Requests\RegisterAuthRequest;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\http\Response;
use Illuminate\Http\Request;
use sis5cs\Http\Controllers\Controller;
use sis5cs\Http\Requests\UserFormRequest;
use sis5cs\Rol;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth; 
use File;
use DB;
use sis5cs\Credito;
use sis5cs\Persona;
use sis5cs\Foto;   
use sis5cs\SeguimientoFoto; 
use Validator;
use Image;
use sis5cs\Http\Requests\FotoFormRequest;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class CreditoController extends Controller
{
    public function index() {
        //$input = $request->only('id_credito', 'id_persona');
        $credito = Credito::select("credito.*")->get()->toArray();
        return response()->json($credito);

        
        
    }
        

    public function show($id)
    {  
        
        $credito = Credito::select("credito.*")
        ->where("credito.id_credito", $id)
        ->first();
        return response()->json([
              "ok" => true,
              "data"=>$credito,
        ]);
    }
    public function busqueda(Request $request)
    {
        $nombre= $request->input('nombre');
        $apellido_pa= $request->input('ap_paterno');
        $apellido_ma= $request->input('ap_materno');
        $ci= $request->input('ci');
         
        $persona = DB::table('persona')
        ->where('ap_materno', null)
        ->update(['ap_materno'=> ""]);

        if($nombre != null && $apellido_pa == null && $apellido_ma ==null && $ci==null){
        $credito = DB::table('credito')
        ->join('persona', 'persona.id_persona', '=', 'credito.id_persona')
        ->select('credito.id_credito','persona.id_persona','persona.nombre','persona.ap_paterno','persona.ap_materno','credito.fecha_solicitud')      
        ->where("persona.nombre","ilike","%".$nombre."%")  
        //->where("persona.nombre",$nombre) 
        //->where('persona.ap_materno', null)
        //->update(['persona.ap_materno'=> ""])
        //->where("persona.ap_paterno",$apellido_pa)   
        //->where("persona.ap_materno",$apellido_ma)
        //->orwhere("persona.ci",$ci)
        ->get();}
        
        if($apellido_pa != null  && $nombre == null  && $apellido_ma ==null && $ci==null){
            $credito = DB::table('credito')
            ->join('persona', 'persona.id_persona', '=', 'credito.id_persona')
            ->select('credito.id_credito','persona.id_persona','persona.nombre','persona.ap_paterno','persona.ap_materno','credito.fecha_solicitud')      
            ->where("persona.ap_paterno","ilike",$apellido_pa) 
            ->get();}
            if( $apellido_ma !=null && $nombre == null && $apellido_pa == null  && $ci == null){
                $credito = DB::table('credito')
                ->join('persona', 'persona.id_persona', '=', 'credito.id_persona')
                ->select('credito.id_credito','persona.id_persona','persona.nombre','persona.ap_paterno','persona.ap_materno','credito.fecha_solicitud')      
                ->where("persona.ap_materno","ilike",$apellido_ma) 
                ->get();}
                if($nombre == null && $apellido_pa == null && $apellido_ma ==null && $ci !=null){
                    $credito = DB::table('credito')
                    ->join('persona', 'persona.id_persona', '=', 'credito.id_persona')
                    ->select('credito.id_credito','persona.id_persona','persona.nombre','persona.ap_paterno','persona.ap_materno','credito.fecha_solicitud')      
                    ->where("persona.ci",$ci) 
                    ->get();}
                    if($nombre != null && $apellido_pa != null && $apellido_ma !=null && $ci !=null){
                        $credito = DB::table('credito')
                        ->join('persona', 'persona.id_persona', '=', 'credito.id_persona')
                        ->select('credito.id_credito','persona.id_persona','persona.nombre','persona.ap_paterno','persona.ap_materno','credito.fecha_solicitud')      
                        ->where("persona.nombre","ilike",$nombre)
                        ->where("persona.ap_paterno","ilike",$apellido_pa)
                        ->where("persona.ap_materno","ilike",$apellido_ma)
                        ->where("persona.ci",$ci) 
                        ->get();}
        return response()->json([
            "ok" => true,
            "data"=>$credito,
      ]);
    }
    

    public function store(Request $request)
    {    
        $path = public_path() . '/images/fotos/';
        $imagenOriginal = $request->file('archivo');
        $imagen = Image::make($imagenOriginal);
        $temp_name = uniqid() . '.' . $imagenOriginal->getClientOriginalExtension();
        $imagen->resize(800, 600);
        $imagen->save($path . $temp_name, 100);
        //variable temporal
        $foto = new Foto();
        $foto->archivo = $temp_name;
        $foto->detalle =$request ->input('detalle');
        $foto->id_seguimiento_foto = $request->input('id_seguimiento_foto');
        $foto->save();
    
        
    }
    public function store2(FotoFormRequest $request)
    {   
         
        if(empty($id)== false){
            $longitud=null;
            $latitud=null;
         }
       
        $fot= $request-> file('fotografia'); 
        $urlimage=[];
        foreach($fot as $fo){
        $path = public_path() . '/images/fotos/'; 
        $imagen = Image::make($fo);   
        $temp_name = uniqid() . '.' . $fo->getClientOriginalExtension();
        $imagen->resize(800, 600);
        $imagen->save($path . $temp_name, 100);
        $urlimage[]=$temp_name;
        $tam= sizeof($urlimage); //tama;o del array
         }
         $fotoseguimiento = new SeguimientoFoto();
         $fotoseguimiento->descripcion= $request-> input('titulo');
         $fotoseguimiento->id_credito =Session::get('id_credito');
         $fotoseguimiento->longitud = $request-> input('longitud');
         $fotoseguimiento->latitud = $latitud-> input('latitud');
         $notification = 'Excelente se Agrego una nueva Foto';
         $fotoseguimiento->save();
         for($i =0;$i<$tam;$i++){
         $foto = new Foto();
         $foto->archivo = $urlimage[$i];
         $foto->detalle =$request ->input('detalle');
         $foto->id_seguimiento_foto=$fotoseguimiento->id_seguimiento_foto;
         $foto->save();
        
        }
             
    }
  
    public function listuser(Request $request)
    {  
        
        $id_persona= $request->input('id_persona');  
        $persona = DB::table('credito')
        ->join('persona', 'persona.id_persona', '=', 'credito.id_persona')
        ->select('persona.nombre','persona.ap_paterno','persona.ap_materno','credito.id_credito','credito.fecha_solicitud')
        ->where('credito.id_persona', $id_persona)
        ->get();
        //return $persona;
        return response()->json([
              "ok" => true,
              "data"=>$persona,
        ]);
    }
    public function listarcarpetauser(Request $request)
   {
           
    $id_credito= $request->input('id_credito');  
    $listaseguimiento = DB::table('seguimiento_fotografico')
    //->join('persona', 'persona.id_persona', '=', 'credito.id_persona')
    ->select('seguimiento_fotografico.id_seguimiento_foto','seguimiento_fotografico.descripcion','seguimiento_fotografico.created_at')
    ->where('seguimiento_fotografico.id_credito', $id_credito)
    ->get();
    //return $persona;
    return response()->json([
          "ok" => true,
          "data"=>$listaseguimiento,
    ]);
   }
   public function nuevacarpeta(Request $request)
   {
    $fotoseguimiento = new SeguimientoFoto();
    $fotoseguimiento->descripcion= $request-> input('descripcion');
    $fotoseguimiento->id_credito =$request-> input('id_credito');
    //$fotoseguimiento->longitud = $longitud;
    //$fotoseguimiento->latitud = $latitud;
    $fotoseguimiento->save();
   }
}
