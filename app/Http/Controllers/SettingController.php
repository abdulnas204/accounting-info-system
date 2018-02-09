<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('pages.setting.index');
    }
    public function home()
    {
    	return view('pages.setting.home');
    }
    public function general()
    {
    	return view('pages.setting.general');
    }
    public function reports()
    {
    	return view('pages.setting.reports');
    }
    public function taxes()
    {
    	return view('pages.setting.taxes');
    }
    public function localization()
    {
    	return view('pages.setting.localization');
    }
}
