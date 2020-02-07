<?php

namespace sis5cs\Http\Controllers\Plataforma;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardPlataformaController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}
	public function index(Request $request)
	{		
	  return view('plataforma.dashboard.index');
	}  
}
