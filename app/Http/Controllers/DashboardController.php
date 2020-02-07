<?php

namespace sis5cs\Http\Controllers;
use sis5cs\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index(Request $request)
	{
		
		$nusers=User::count();
		return view('dashboard.index')->with('nusers',$nusers);

	}  
}
