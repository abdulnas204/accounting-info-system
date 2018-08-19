<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Sale;


class SaleController extends LedgerController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sales = Sale::all()->toArray();
        $sales = array_reverse($sales);
        return view('pages.sale.index')->with(compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $name = $request->input('name');
            $company = $request->input('company');
            $email = $request->input('email');
            $address = $request->input('address');
            $state = $request->input('state');
            $zip = $request->input('zip');
            $country = $request->input('country');
            $phone_number = $request->input('phone_number');

            $due_date = $request->input('due_date');
            $amount = $request->input('amount');
            $paid = $request->input('paid');
            $paid = $paid ? 1 : 0;
            $description = $request->input('item');

            $inventory_id = $request->input('inventory_id');
            $id = $request->input('customer_id');

            $sale = new Sale;
            $sale->name = $name;
            $sale->company = $company;
            $sale->email = $email;
            $sale->address = $address;
            $sale->state = $state;
            $sale->zip = $zip;
            $sale->country = $country;
            $sale->phone_number = $phone_number;

            $sale->due_date = $due_date;
            $sale->amount = $amount;
            $sale->paid = $paid;
            $sale->description = $description;

            $sale->inventory_id = $inventory_id;
            $sale->customer_id = $id;
            $sale->user_id = \Auth::user()->id;

            $sale->save();
            $sale_id = sale::orderBy('sale_id', 'DESC')->first()['sale_id'];

            $more_args = array(
                'repeat'        => False,
                'sale_id'    => $sale_id
            );
            $today = date("m-d-Y H:i:sa");

            if($paid) {

                $this->addNewEntry($today, $description, 'Cash', $amount, 'Debit', $more_args);
            }
            else {
                $this->addNewEntry($today, $description, 'Accounts Receivable', $amount, 'Debit', $more_args);
            }

            $more_args['repeat'] = True;
            $this->addNewEntry($today, $description, 'Revenues', $amount, 'Credit', 'Credit', 'Revenue', $more_args);

            $message = 'Successfully entered in an sale';
        }
        catch(\Exception $e) {
            $message = $e->getMessage();
        }
        return redirect()->back()->with('feedback', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
