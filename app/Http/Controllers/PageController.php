<?php
namespace App\Http\Controllers;

class PageController extends Controller {
	public function about()
	{
		//return "About Us Page";
		return view('about');
	}
	public function contact()
	{
		//return "contact";
		return view('contact');
	}
}