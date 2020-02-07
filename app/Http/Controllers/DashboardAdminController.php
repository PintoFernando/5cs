<?php

namespace sis5cs\Http\Controllers;

use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}
	public function index(Request $request)
	{		
	  return view('dashboard.index');
	} 
}
