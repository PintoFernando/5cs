<?php

namespace sis5cs\Http\Controllers\Comite;
use sis5cs\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardComiteController extends Controller
{
     public function __construct()
	{
		$this->middleware('auth');
	}
	public function index(Request $request)
	{		
	  return view('comite.dashboard.index');
	}  
}
