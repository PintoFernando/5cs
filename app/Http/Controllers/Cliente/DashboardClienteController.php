<?php

namespace sis5cs\Http\Controllers\Cliente;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardClienteController extends Controller
{
   public function __construct()
	{
		$this->middleware('auth');
	}
	public function index(Request $request)
	{		
	  return view('cliente.dashboard.index');
	} 
}
