<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaxOptions;

class TaxController extends Controller
{
    public function all(Request $request)
    {
        $options = TaxOptions::all()->toArray();
        print_r(json_encode($options));
    }

    public function getTax($id)
    {
        try {
            $taxes = TaxOptions::find($id)->toArray();

            print_r(json_encode($taxes));

        }
        catch (\Exception $e) {
            // $message = $e->getMessage();
            print_r($e->getMessage());
        }
    }
}
