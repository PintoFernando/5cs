<?php

namespace sis5cs\Http\Controllers\Plataforma;

use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Session;
use sis5cs\Area;
use sis5cs\Http\Controllers\Controller;
use sis5cs\Http\Requests\SeguimientoFormRequest;
use sis5cs\Seguimiento;
use sis5cs\User;
use sis5cs\Notifications\DerivadoSent;

class SeguimientoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $seguimiento = DB::table('seguimiento')
        ->join('credito', 'seguimiento.id_credito', '=', 'credito.id_credito')
        ->join('users', 'seguimiento.id_users', '=', 'users.id_users')
        ->join('area', 'seguimiento.id_area', '=', 'area.id_area')
        ->select('seguimiento.*', 'area.*', 'users.*', 'credito.*')
        ->where('credito.id_credito', Session::get('id_credito'))
        ->get();
        $usuarios = User::All();
        $areas = Area::All();
        return view('plataforma.seguimiento.index')->with(compact('seguimiento', 'usuarios', 'areas'));
    }

    public function create()
    {
        if (Session::get('id_credito') == null) {
            alert()->info('Info', 'Seleccione crédito')->showConfirmButton();
            return redirect('plataforma/dashboard/');
        } else {
            $existe_registros = Seguimiento::where('id_credito', Session::get('id_credito'))->exists();
            $seguimiento = Seguimiento::where('id_credito', Session::get('id_credito'))->get();
            //--
            if ($existe_registros) //si no existe registros
            {
                if ($seguimiento->last()->id_users == Auth::user()->id_users) {
                    alert()->info('Info', 'Ya registro')->showConfirmButton();
                    return redirect('plataforma/seguimiento/');
                } else {
                    if ($seguimiento->last()->usuario_destino == Auth::user()->id_users) {
                        return view('plataforma.seguimiento.create');
                    } else {
                        alert()->info('Info', 'No tiene pendientes')->showConfirmButton();
                        return redirect('plataforma/seguimiento/');
                    }

                }
            } else {
                return view('plataforma.seguimiento.create');
            }
            //--
        }
    }

    public function store(SeguimientoFormRequest $request)
    {
        $recuperar = $request->input('fecha_inicio');
        $now = Carbon::now();
        if ($recuperar == 1) {
            $seguimiento = new Seguimiento();
            $seguimiento->fecha_inicio = $now;
            $seguimiento->id_users = Auth::user()->id_users;
            $seguimiento->id_credito = Session::get('id_credito');
            $seguimiento->id_area = 1;
            $seguimiento->save(); //metodo se encarga de ejecutar un insert sobre la tabla
            alert()->info('Info', 'Exelente')->showConfirmButton();
            return redirect('/plataforma/seguimiento/');
        } else {
            return redirect('/plataforma/seguimiento/');
        }
    }
    public function edit_fin($id)
    {
        $seguimiento = Seguimiento::where('id_credito', Session::get('id_credito'))->get();
        $segui = Seguimiento::find($id); //para mandar el id_seguimiento a la vista
        if ($seguimiento->last()->completado == true) {
            alert()->info('Info', 'Ya está completado')->showConfirmButton();
            return redirect('plataforma/seguimiento/');
        } else {
            if ($seguimiento->last()->id_users == Auth::user()->id_users) {
                if ($seguimiento->last()->id_seguimiento == $id) {
                    if (empty($seguimiento->last()->fecha_fin)) {
                        return view('plataforma.seguimiento.fin')->with(compact('segui'));
                    } else {
                        alert()->info('Info', 'Ya Marco Fin')->showConfirmButton();
                        return redirect('plataforma/seguimiento');
                    }
                } else {
                    alert()->info('Info', 'Ya está completado')->showConfirmButton();
                    return redirect('plataforma/seguimiento');
                }

            } else {
                alert()->info('Info', 'No corresponde')->showConfirmButton();
                return redirect('plataforma/seguimiento');
            }
        }

    }
    public function update_fin(SeguimientoFormRequest $request, $id)
    {
        $now = Carbon::now();
        $seguimiento = Seguimiento::find($id);
        if ($request->input('fin') == 1) {
            $seguimiento->fecha_fin = $now;
            $seguimiento->save();
            alert()->info('Info', 'Exelente')->showConfirmButton();
            return redirect('/plataforma/seguimiento');
        }
    }

    public function edit_derivar($id)
    {
        $seguimiento = Seguimiento::where('id_credito', Session::get('id_credito'))->get();
        $segui = Seguimiento::find($id); //para mandar el id_seguimiento a la vista
        if ($seguimiento->last()->completado == true) {
            alert()->info('Info', 'Ya está completado')->showConfirmButton();
            return redirect('plataforma/seguimiento/');
        } else {
            if ($seguimiento->last()->id_users == Auth::user()->id_users) {
                if ($seguimiento->last()->id_seguimiento == $id) 
                {
                    if (empty($seguimiento->last()->usuario_destino)) {
                        $usuarios_sis = User::All();
                        $area_destino = Area::All();
                        $seguimiento = Seguimiento::find($id);
                        return view('plataforma.seguimiento.derivar')->with(compact('segui', 'usuarios_sis', 'area_destino'));
                    } else {
                        alert()->info('Info', 'Ya Derivó a otra área')->showConfirmButton();
                        return redirect('plataforma/seguimiento');
                    }
                }else{
                    alert()->info('Info', 'Ya está completado')->showConfirmButton();
                    return redirect('plataforma/seguimiento');
                }

            } else {
                alert()->info('Info', 'No corresponde')->showConfirmButton();
                return redirect('plataforma/seguimiento/');
            }

        }

    }
    public function update_derivar(SeguimientoFormRequest $request, $id)
    {
        $seguimiento = Seguimiento::find($id);
        $seguimiento->observaciones = request('observaciones');
        $seguimiento->usuario_destino = request('id_users');
        $id_rol=User::where('id_users',request('id_users'))->firstOrFail()->id_rol;
        $seguimiento->area_destino = $this->area_destino($id_rol);
        $seguimiento->completado = true;
        $seguimiento->save();

        if($seguimiento->save())
        {
           $recipient =User::find($request->id_users);
           $recipient->notify(new DerivadoSent($seguimiento));
       }
        alert()->info('Info', 'Exelente')->showConfirmButton();
        return redirect('/plataforma/seguimiento');
    }

    public function area_destino($v)
    {
     switch ($v) {
         case 2:
         return 3;
         break;

         case 3:
         return 2;
         break;

         case 4:
         return 1;
         break;
        
         case 6:
         return 4;
         break;

         case 7:
         return 5;
         break;

         case 8:
         return 6;
         break;
     }
 }
}
