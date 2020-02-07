<?php

namespace sis5cs\Http\Controllers\JefeCredito;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardJefeCreditoController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}
	public function index(Request $request)
	{		
	  return view('jefecredito.dashboard.index');
	}  
}
