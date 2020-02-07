<?php
namespace sis5cs\Http\Controllers;
use Illuminate\Http\Request;
use sis5cs\Cliente;
use sis5cs\Persona;
use sis5cs\Profesion;
use sis5cs\Http\Requests\ClienteFormRequest;
use sis5cs\Http\Requests\PersonaFormRequest;
use DB;

use Fpdf;
use sis5cs\Direccion;

class ClienteController extends Controller
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
             $clientes=DB::table('persona as p')
             ->join('cliente as c','c.id_persona','=','p.id_persona')
             ->select('p.id_persona','p.ci','p.nombre','p.ap_paterno','p.ap_materno','p.ap_casada','p.fec_nac','p.genero','p.celular','p.dependientes','p.estado_civil','p.id_profesion','c.id_cliente as id_cliente')
            ->where('p.nombre','ILIKE','%'.$query.'%')
       
            ->orderBy('c.id_persona','desc')
            ->paginate(7);
            return view('cliente.crud.index',["clientes"=>$clientes,"searchText"=>$query]);

        }//busqueda por nombre y ci
    	/*$clientes=Cliente::paginate(7);
        return view('cliente.crud.index')->with(compact('clientes'));//listado*/
    }
    public function create()
    {
        $personas=Persona::all();
        return view('cliente.crud.create')->with(compact('personas'));//listado
    }
    public function store(ClienteFormRequest $request)
    {
       // registrar el nuevo cliente
    	// dd($request->all()); método dd muestra el contenido del array
      $cliente= new Cliente();     
      $cliente->id_persona=$request->input('id_persona');
      $cliente->save(); //metodo se encarga de ejecutar un insert sobre la tabla

      return redirect('/cliente/crud');
    }

     public function edit($id)
    {
      $persona=Persona::find($id);
    	$profesion=Profesion::all();
      return view('cliente.crud.edit')->with(compact('persona','profesion')); //formulario de registro
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

      return redirect('/cliente/crud');
    }

     public function destroy($id)
    {

      $persona= Persona::find($id); 
      $persona->delete(); //delete

      return back();
    }
      public function reporte(){
         //Obtenemos los registros
         $persona=Persona::find(1);
         $direccion=Direccion::find(1);
         $pdf = new Fpdf();
         $pdf::AddPage();
         $pdf::SetTextColor(35,56,113);
         $pdf::SetFont('arial','B',11);
         $pdf::Cell(0,10,utf8_decode("Cooperativa De Ahorro y Crédito"),0,"","L");
         $pdf::Ln(4);
         $pdf::Cell(0,10,utf8_decode("San Martín Ltda.  "),0,"","L");
         $pdf::Ln();
         //$pdf::Image('img/icono.png',10,6,30);
         $pdf::SetTextColor(35,56,113);
         $pdf::SetFont('Arial','B',11);
         $pdf::Cell(0,10,utf8_decode("Solicitud de credito"),0,"","C");
         $pdf::Ln();
         $pdf::Ln();
         $pdf::SetTextColor(255,255,255);  // Establece el color del texto 
         $pdf::SetFillColor(18, 171, 7); // establece el color del fondo de la celda 
         $pdf::SetFont('Arial','B',10); 
         //El ancho de las columnas debe de sumar promedio 190   
         //-------
         $pdf::cell(190,5,utf8_decode("DATOS PEROSNALES"),1,"","C",true);     
         $pdf::Ln();
         $pdf::cell(63.3,4,utf8_decode("Apellido Paterno"),1,"","L",true);
         $pdf::cell(63.3,4,utf8_decode("Apellido Materno"),1,"","L",true);
         $pdf::cell(63.3,4,utf8_decode("Nombres"),1,"","L",true);
         $pdf::Ln();
         $pdf::SetFont("Arial","",9);
         $pdf::SetTextColor(0,0,0);
         $pdf::cell(63.3,4,utf8_decode($persona->ap_paterno),1,"","L",false);
         $pdf::cell(63.3,4,utf8_decode($persona->ap_materno),1,"","L",false);
         $pdf::cell(63.3,4,utf8_decode($persona->nombre),1,"","L",false);
         $pdf::Ln();

         //------
         $pdf::SetTextColor(255,255,255);
         $pdf::SetFont("Arial","B",8);
         $pdf::cell(38.3,4,utf8_decode("Documento identidad"),1,"","L",true);
         $pdf::cell(15.3,4,utf8_decode("Edad"),1,"","L",true);
         $pdf::cell(35.3,4,utf8_decode("Fecha nacimiento"),1,"","L",true);
         $pdf::cell(40.3,4,utf8_decode("Lugar nacimiento"),1,"","L",true);
         $pdf::cell(40.3,4,utf8_decode("Estado civil"),1,"","L",true);
         $pdf::cell(20.3,4,utf8_decode("dependientes"),1,"","L",true);
         $pdf::Ln();
         $pdf::SetFont("Arial","",9);
         $pdf::SetTextColor(0,0,0);
         $pdf::cell(38.3,4,utf8_decode($persona->ci),1,"","L",false);
         $pdf::cell(15.3,4,utf8_decode($persona->edad),1,"","L",false);
         $pdf::cell(35.3,4,utf8_decode($persona->fec_nac),1,"","L",false);
         $pdf::cell(40.3,4,utf8_decode("---"),1,"","L",false);
         $pdf::cell(40.3,4,utf8_decode($persona->estado_civil),1,"","L",false);
         $pdf::cell(20.3,4,utf8_decode($persona->dependientes),1,"","L",false);
         $pdf::Ln();
      //---------
         $pdf::SetTextColor(255,255,255);
         $pdf::SetFont("Arial","B",8);
         $pdf::cell(38.3,4,utf8_decode("Dirección"),1,"","L",true);
         $pdf::cell(15.3,4,utf8_decode("N°"),1,"","L",true);
         $pdf::cell(35.3,4,utf8_decode("Calle de referencia"),1,"","L",true);
         $pdf::cell(40.3,4,utf8_decode("Zona"),1,"","L",true);
         $pdf::cell(30.3,4,utf8_decode("La vivienda es"),1,"","L",true);
         $pdf::cell(30.3,4,utf8_decode("telefono"),1,"","L",true);
         $pdf::Ln();
         $pdf::SetFont("Arial","",9);
         $pdf::SetTextColor(0,0,0);
         $pdf::cell(38.3,4,utf8_decode($direccion->cll_principal),1,"","L",false);
         $pdf::cell(15.3,4,utf8_decode($direccion->direc_numero),1,"","L",false);
         $pdf::cell(35.3,4,utf8_decode($direccion->cll_secundaria),1,"","L",false);
         $pdf::cell(40.3,4,utf8_decode($direccion->zona),1,"","L",false);
         $pdf::cell(30.3,4,utf8_decode($direccion->id_tipo_vivienda),1,"","L",false);
         $pdf::cell(30.3,4,utf8_decode($persona->celular),1,"","L",false);
         $pdf::Ln();
         
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(255, 255, 255); // establece el color del fondo de la celda
         $pdf::SetFont("Arial","",9);
         /*
         foreach ($registros as $reg)
         {
            $pdf::cell(30,6,utf8_decode($reg->codigo),1,"","L",true);
            $pdf::cell(80,6,utf8_decode($reg->nombre),1,"","L",true);
            $pdf::cell(65,6,utf8_decode($reg->categoria),1,"","L",true);
            $pdf::cell(15,6,utf8_decode($reg->stock),1,"","L",true);
            $pdf::Ln(); 
         }
         */
         $pdf::Output();
         exit;
    }


    public function word()
    {
       /*
      $wordTest=new \PhpOffice\PhpWord\PhpWord();
      $newSection=$wordTest->addSection();
      $descrip="lorem ipsum namekusein picoro daymacun sdfffffffffffffffffffffffffff";
      $newSection->addText($descrip,array('name'=>'Tahoma','size'=>15, 'color'=>'blue'));
      $objectWriter=\PhpOffice\PhpWord\IOFactory::createWriter($wordTest,'Word2007');
      try
      {
        $objectWriter->save(storage_path('TestWordFile.docx'));
      } catch (Exception $e)
      {
      }
        return response()->download(storage_path('TestWordFile.docx'));

      */  




$templateWord = new \PhpOffice\PhpWord\TemplateProcessor('c:/plantilla/plantilla.docx'); 
$nombre = "Carlos";
$apellido = "Garcia";
// --- Asignamos valores a la plantilla
$templateWord->setValue('nombre',$nombre);
$templateWord->setValue('apellido',$apellido);


// --- Guardamos el documento
$templateWord->saveAs('Documento02.docx');
header("Content-Disposition: attachment; filename=Documento02.docx; charset=iso-8859-1");
echo file_get_contents('Documento02.docx');

    }
}
