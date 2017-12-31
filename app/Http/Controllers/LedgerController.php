<?php

namespace App\Http\Controllers;
//namespace App;

use Illuminate\Http\Request;
use App\Balance_Sheet_Accounts;


class LedgerController extends Controller
{
    public function __construct()
    {

    }
    // Access database, 
    public function showAccounts(Request $request)
    {
        //print_r("Hello world!");
        $results = Balance_Sheet_Accounts::all();
        $temp = [];
        $returnSet = [];

        foreach($results as $result){ 
            array_push($returnSet, [
                "identifier" => $result->account_name,
                "payload"    => $result
            ]);
        }

        print_r(json_encode($returnSet));

    }
}
