<?php
namespace sis5cs\Http\Controllers\api;

use App\Http\Requests\RegisterAuthRequest;
use Auth;
use Illuminate\Http\Request;
use sis5cs\Http\Controllers\Controller;
use sis5cs\Http\Requests\UserFormRequest;
use sis5cs\Rol;
use sis5cs\User;
use sis5cs\Persona;
use DB;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;    



class UserController extends Controller
{
    public $loginAfterSignUp = true;
    
   // public function register(Request $request) {
   //     $fecha = $request->input('fec_nac');
    //    $ci= $request->input('ci');
      //  $datos = DB::table('persona')
            
     //       ->select('fec_nac','ci','nombre','id_persona')      
      ///      ->where("fec_nac",$fecha)
     //       ->where("ci",$ci) 
     //       ->get();
     //         foreach($datos as $dat)
     //         {
     //           $id_persona=$dat->id_persona;
     //         }
      //  $user = new User();
     //   $user->name = $request->name;
     //   $user->email = $request->email;
     //   $user->id_persona= $id_persona;
     //   $user->id_rol = 10;
     //   $user->password = bcrypt($request->password);
     //   $user->save();
     //   if ($this->loginAfterSignUp) {
     //       return $this->login($request);
      //  }
      //      return response()->json([
       //     'status' => 'Ok',
       //     'data' => $user
       //     ], 200);
  //  }

    public function login(Request $request) {

        $email = $request->input('email');
        $password= $request->input('password');
        $dato = DB::table('users')
        ->select('id_rol','id_persona')
        ->where("email", $email)
        //->where("password", $password)
        ->get();
       
        foreach($dato as $dat)
        {
          $id_rol=$dat->id_rol;
          $id_persona=$dat->id_persona;
          
        }        
        $input = $request->only('email', 'password');
        $jwt_token = null;
        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
            'status' => 'invalid_credentials',
            'message' => 'Correo o contraseña no válidos.',
    ], 401);
    }
            return response()->json([
            'status' => 'ok',
            'token' => $jwt_token,
            'id_rol' => $id_rol,
            'id_persona' => $id_persona,
    ]);
    }
    public function logout(Request $request) {
           $this->validate($request, [
           'token' => 'required'
    ]);
    try {
           JWTAuth::invalidate($request->token);
           return response()->json([
           'status' => 'ok',
           'message' => 'Cierre de sesión exitoso.'
    ]);
    } catch (JWTException $exception) {
    return response()->json([
           'status' => 'unknown_error',
           'message' => 'Al usuario no se le pudo cerrar la sesión.'
         ], 500);
       }
    }
    public function getAuthUser(Request $request) {
          $this->validate($request, [
         'token' => 'required'
    ]);
    $user = JWTAuth::authenticate($request->token);
          return response()->json(['user' => $user]);
    }
    protected function jsonResponse($data, $code = 200)
   {
           return response()->json($data, $code,
          ['Content-Type' => 'application/json;charset=UTF8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
}













}
