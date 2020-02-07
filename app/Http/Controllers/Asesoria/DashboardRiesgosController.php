<?php

namespace sis5cs\Http\Controllers\Riesgos;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardRiesgosController extends Controller
{
     public function __construct()
	{
		$this->middleware('auth');
	}
	public function index(Request $request)
	{		
	  return view('oficial.dashboard.index');
	}  
}
