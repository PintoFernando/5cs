<?php

namespace sis5cs\Http\Controllers;

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

    public function index(){
      $users = User::All();
      return view('user.crud.index',compact('users','roles'));
    }
    public function create()
    {
     $users=User::All();
     $roles=Rol::All();
     return view('user.crud.create')->with(compact('users','roles'));
   }
   public function store(UserFormRequest $request)
   {

    $path=public_path().'/images/usersperfils/'; 
    $imagenOriginal=$request->file('fotografia');
    $imagen=Image::make($imagenOriginal);
    $temp_name=uniqid().'.'.$imagenOriginal->getClientOriginalExtension();
    $imagen->resize(200,200);
    $imagen->save($path.$temp_name,100);

    $u= new User(); 
    $u->name=$request->input('name');
    $u->email=$request->input('email');
    $u->id_rol=$request->input('id_rol');
    $u->password=bcrypt($request->input('password'));
    $u->imagen=$temp_name;
    $u->save(); //metodo se encarga de ejecutar un insert sobre la tabla 
    return redirect('/user/crud');
  }

  public function edit($id)
  {

    $users=User::find($id);
    $roles=Rol::All();
    
  return view('user.crud.edit')->with(compact('users','roles')); //formulario de registro
}


public function update(UserFormRequest $request,$id)
{
 $u=User::find($id); 
 $u->name=$request->input('name');
 $u->email=$request->input('email');
 $u->id_rol=$request->input('id_rol');
 $u->save(); //metodo se encarga de ejecutar un insert sobre la tabla  
 return redirect('/user/crud');
}

public function destroy($id)
{
  $u=User::find($id); 
  $direccion=public_path().'/images/usersperfils/'.$u->imagen;
  $deleted=File::delete($direccion);
  $u->delete(); //delete
  return back();
}
}
