<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Main menu
    public function getIndex()
    {
    	return view('pages.index');
    }

    // View/edit the general ledger
    public function getLedger()
    {
    	return view('pages.ledger');
    }

    // Administrative page
    public function getAdminPage()
    {
    	return view('pages.admin');
    }

    // Sub menu view for various fin statements
    public function getFinancialStatements()
    {
    	return view('pages.compose');
    }

    // Compose & view balance sheet
    public function showBalanceSheet()
    {
    	return view('pages.balancesheet');
    }
}