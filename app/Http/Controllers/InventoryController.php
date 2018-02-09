<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
        try {
            $name = $request->input('name');
            $company = $request->input('company');
            $email = $request->input('email');
            $address = $request->input('address');
            $zip = $request->input('zip');
            $country = $request->input('country');
            // $phone = $request->input('phone');
            $due_date = $request->input('due_date');
            $description = $request->input('description');
            $amount = $request->input('amount');
            $paid = $request->input('paid');

            // $order_id = $request->input('order_id');
            // $customer_id = $request->input('customer_id');
            // $item_id = $request->input('item_id');

            $invoice = new Invoice;
            $invoice->name = $name;
            $invoice->customer_id = $id;
            $invoice->company = $company;
            $invoice->email = $email;
            $invoice->address = $address;
            $invoice->order_id = $order_id;
            $invoice->amount = $amount;
            $invoice->due_date = $due_date;
            // $invoice->phone_number = 
            $invoice->description = $description;

            $invoice->save();
            $invoice_id = Invoice::orderBy('invoice_id', 'DESC')->first()['invoice_id'];

            $more_args = array(
                'repeat'        => False,
                'invoice_id'    => $invoice_id
            );
            // print_r($invoice);
            $today = date("m-d-Y H:i:sa");
            $lol = $this->addNewEntry($today, $description, 'Accounts Receivable', $amount, 'Debit', 'Debit', 'Asset', $more_args);

            $more_args['repeat'] = True;
            $this->addNewEntry($today, $description, 'Revenues', $amount, 'Credit', 'Credit', 'Revenue', $more_args);

            $message = 'Successfully entered in an Invoice';
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
