<?php
namespace sis5cs\Http\Controllers\Oficial;

use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Session;
use sis5cs\Area;
use sis5cs\Http\Controllers\Controller;
use sis5cs\Http\Requests\SeguimientoFormRequest;
use sis5cs\Notifications\DerivadoSent;
use sis5cs\Seguimiento;
use sis5cs\User;

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
        return view('oficial.seguimiento.index')->with(compact('seguimiento', 'usuarios', 'areas'));
    }
    public function create()
    {
        if (Session::get('id_credito') == null) {
            alert()->info('Info', 'Seleccione un crédito')->showConfirmButton();
            return redirect('oficial/dashboard/');
        } else {
            $seguimiento = Seguimiento::where('id_credito', Session::get('id_credito'))->orderBy('id_seguimiento','ASC')->get();
            $existe_registros = Seguimiento::where('id_credito', Session::get('id_credito'))->exists();
            //---
            if ($existe_registros) //si existe
            {
                if ($seguimiento->last()->usuario_destino == Auth::user()->id_users) {
                    if ($seguimiento->last()->id_users == Auth::user()->id_users) {
                        alert()->info('Info', 'Ya derivó a otra área')->showConfirmButton();
                        return redirect('oficial/seguimiento/');
                    } else {
                        return view('oficial.seguimiento.create');
                    }
                } else {
                    alert()->info('Info', 'No tiene pendientes')->showConfirmButton();
                    return redirect('oficial/seguimiento/');
                }

            } else {
                alert()->info('Info', 'No se inició el seguimiento en plataforma')->showConfirmButton();
                return redirect('oficial/seguimiento/');
            }
            //---
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
            $seguimiento->id_area = 2;
            $seguimiento->save(); //metodo se encarga de ejecutar un insert sobre la tabla
            alert()->info('Info', 'Exelente')->showConfirmButton();
            return redirect('/oficial/seguimiento/');
        } else {
            return redirect('/oficial/seguimiento/');
        }
    }
    /*public function edit_fin($id)
    {
        $seguimiento = Seguimiento::where('id_credito', Session::get('id_credito'))->orderBy('id_seguimiento','ASC')->get();
        $segui = Seguimiento::find($id); //para mandar el id_seguimiento a la vista
        if ($seguimiento->last()->completado == true) {
            alert()->info('Info', 'Ya está completado')->showConfirmButton();
            return redirect('oficial/seguimiento');
        } else {
            if ($seguimiento->last()->id_users == Auth::user()->id_users) {
                if ($seguimiento->last()->id_seguimiento == $id) {
                    if (empty($seguimiento->last()->fecha_fin)) {
                        return view('oficial.seguimiento.fin')->with(compact('segui'));
                    } else {
                        alert()->info('Info', 'Ya Marco Fin')->showConfirmButton();
                        return redirect('oficial/seguimiento');
                    }
                } else {
                    alert()->info('Info', 'Ya está completado')->showConfirmButton();
                    return redirect('oficial/seguimiento');
                }

            } else {
                alert()->info('Info', 'No corresponde')->showConfirmButton();
                return redirect('oficial/seguimiento');
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
            return redirect('/oficial/seguimiento');
        }
    }*/
    public function edit_derivar($id)
    {
        $seguimiento = Seguimiento::where('id_credito', Session::get('id_credito'))->orderBy('id_seguimiento','ASC')->get();
        $segui = Seguimiento::find($id); //para mandar el id_seguimiento a la vista
        if ($seguimiento->last()->completado == true) {
            alert()->info('Info', 'Ya está completado')->showConfirmButton();
            return redirect('oficial/seguimiento');
        } else {
            if ($seguimiento->last()->id_users == Auth::user()->id_users) {
                if ($seguimiento->last()->id_seguimiento == $id) {
                    if (empty($seguimiento->last()->usuario_destino)) {
                        $usuarios_sis = User::where('id_users','!=',auth()->id())->where('id_users','!=',15)->get();
                        $area_destino = Area::All();
                        $seguimiento = Seguimiento::find($id);
                        return view('oficial.seguimiento.derivar')->with(compact('segui', 'usuarios_sis', 'area_destino'));
                    } else {
                        alert()->info('Info', 'Ya Derivó a otra área')->showConfirmButton();
                        return redirect('oficial/seguimiento');
                    }
                } else {
                    alert()->info('Info', 'Ya está completado')->showConfirmButton();
                    return redirect('oficial/seguimiento');
                }
            } else {
                alert()->info('Info', 'No corresponde')->showConfirmButton();
                return redirect('oficial/seguimiento');
            }

        }

    }
    public function update_derivar(SeguimientoFormRequest $request, $id)
    {
        $now = Carbon::now();
        $seguimiento = Seguimiento::find($id);
        $seguimiento->observaciones = request('observaciones');
        $seguimiento->usuario_destino = request('id_users');
        $id_rol = User::where('id_users', request('id_users'))->firstOrFail()->id_rol;
        $seguimiento->area_destino = $this->area_destino($id_rol);
        $seguimiento->completado = true;
        $seguimiento->fecha_fin = $now;
        $seguimiento->save();
        if ($seguimiento->save()) {
            $recipient = User::find($request->id_users);
            $recipient->notify(new DerivadoSent($seguimiento));
        }
        alert()->info('Info', 'Exelente')->showConfirmButton();
        return redirect('/oficial/seguimiento');
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
