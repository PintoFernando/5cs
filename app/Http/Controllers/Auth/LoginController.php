<?php

namespace sis5cs\Http\Controllers\Auth;

use sis5cs\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //Redireccion admin
    protected $redirectTo = '/dashbord';
    //Redireccion cliente
    protected $redirectTocliente = 'cliente/dashboard/';
    //Redireccion jefe
    protected $redirectTojefe = 'jefecredito/dashboard/';
    protected $redirectTooficial = 'oficial/dashboard/';
    protected $redirectToplataforma = 'plataforma/persona/crud';
    protected $redirectToriesgos = 'riesgos/dashboard/';
    protected $redirectToasesoria = 'asesoria/dashboard/';
    protected $redirectTocomite = 'comite/dashboard/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectPath()
    {
        
        if (auth()->user()->id_rol == 1) {
            return $this->redirectTo;
        }
        if (auth()->user()->id_rol == 2) {
            return $this->redirectTojefe;
        }
        if (auth()->user()->id_rol == 3) {
        
            return $this->redirectTooficial;
        }
        if (auth()->user()->id_rol == 4) {
            return $this->redirectToplataforma;
        }
        if (auth()->user()->id_rol == 5) {
            return $this->redirectTocliente;
        }
        if (auth()->user()->id_rol == 6) {
            return $this->redirectToriesgos;
        }
        if (auth()->user()->id_rol == 7) {
            return $this->redirectToasesoria;
        }
        if (auth()->user()->id_rol == 8) {
            return $this->redirectTocomite;
        }

        //return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }
}
