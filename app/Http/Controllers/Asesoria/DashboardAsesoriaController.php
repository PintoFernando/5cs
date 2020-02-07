<?php

namespace sis5cs\Http\Controllers\Asesoria;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardAsesoriaController extends Controller
{
     public function __construct()
	{
		$this->middleware('auth');
	}
	public function index(Request $request)
	{		
	  return view('asesoria.dashboard.index');
	}  
}
