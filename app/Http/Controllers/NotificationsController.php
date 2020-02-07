<?php
namespace sis5cs\Http\Controllers;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;
use sis5cs\Seguimiento;
use Illuminate\notifications\DatabaseNotification;

class NotificationsController extends Controller
{
    public function __construct()
  {
    $this->middleware('auth');
  }
  public function index()
  {

    return view('notifications.index',[
      'unreadNotifications'=>auth()->user()->unreadNotifications,
      'readNotifications'=>auth()->user()->readNotifications
      ]);
  }

  public function show($id)
  {
    $message=Seguimiento::findOrFail($id);
    return view('notifications.show',compact('message'));
  }

    public function read($id)
  {
   DatabaseNotification::find($id)->markAsRead();
    return back()->with('flash','Notificacion marcada como leida');
  }

    public function destroy($id)
  {
   DatabaseNotification::find($id)->delete();
    return back()->with('flash','Notificacion eliminada');
  }
}  

