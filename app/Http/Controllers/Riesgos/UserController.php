<?php
namespace sis5cs\Http\Controllers\Riesgos;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;
use sis5cs\User;
use sis5cs\Rol;
use sis5cs\Http\Requests\UserFormRequest;
use DB;
use Auth;
use File;
use Image;


class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      $id_user=Auth::user()->id_users;
      $users = DB::table('users')
      ->join('rol', 'users.id_rol', '=', 'rol.id_rol')
      ->select('users.*', 'rol.rol')
      ->where('id_users',$id_user)
      ->get();
      return view('riesgos.user.index',compact('users'));
    }



    public function edit($id)
    {

      $users=User::find($id);

  return view('riesgos.user.edit')->with(compact('users')); //formulario de registro
}
public function edit_photo()
{
  $id=Auth::user()->id_users;
  $users=User::find($id);
  return view('riesgos.user.edit_photo')->with(compact('users')); //formulario de registro
}

public function update_datos(UserFormRequest $request,$id)
{

 $u=User::find($id);  
 $u->name=$request->input('name');
 $u->email=$request->input('email');
 $u->save(); //metodo se encarga de ejecutar un insert sobre la tabla
 $notification= 'Exelente sus datos se han modificado correctamente';     
 return redirect('riesgos/user/')->with(compact('notification'));
}

public function update_picture(UserFormRequest $request,$id)
{

 $path=public_path().'/images/usersperfils/'; 
 $imagenOriginal=$request->file('fotografia');
 $imagen=Image::make($imagenOriginal);
 $temp_name=uniqid().'.'.$imagenOriginal->getClientOriginalExtension();
 $imagen->resize(200,200);

 //variable temporal
 $u=User::find($id); 
 $anterior_file=$u->imagen;
 $u->imagen=$temp_name;
  $u->save(); //metodo se encarga de ejecutar un insert sobre la tabla
  if($u->save())
  {
    //mover nuevo archivo al directorio
    $imagen->save($path.$temp_name,100);
    //eliminar archivo antiguo del directorio
    $direccion=public_path().'/images/usersperfils/'.$anterior_file;
    $deleted=File::delete($direccion);
  }
 $notification= 'Exelente sus datos se han modificado correctamente';     
 return redirect('riesgos/user/')->with(compact('notification'));
}
}
