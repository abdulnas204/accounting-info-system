<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function getIndex(){
    	return view('pages.index');
    }
    public function getLedger(){
    	return view('pages.ledger');
    }
    public function getAdminPage(){
    	return view('pages.ledger');
    }
    public function getFinancialStatements(){
    	return view('pages.ledger');
    }
}