<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Invoice;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customers = Customer::all()->sortBy('name')->toArray();

        return view('pages.customer.index')->with('customers', $customers);
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
            $customer = new Customer;
            
            $customer->name = $request->input('name');
            $customer->email = $request->input('email');
            $customer->company = $request->input('company');
            $customer->address = $request->input('address');
            $customer->phone_number = $request->input('phone');
            $customer->state = $request->input('state');
            $customer->zip = $request->input('zip');
            $customer->country = $request->input('country');
            $customer->notes = $request->input('notes');
            $customer->save();


            return redirect()->back()->with('feedback', 'Successfully entered in a customer');
        }
        catch(\Exception $e) {
            return redirect()->back()->with('feedback', 'Error with entry');
        }
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
        $customer = Customer::find($id);
        return view('pages.customer.show')->with('customer', $customer);
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
        $customer = Customer::find($id);

        return view('pages.customer.edit')->with('customer', $customer);
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
        try {
            Customer::find($id)->update($request->all());
            $message = 'Edit successful';

            $this->cascadeChanges($request, $id);
        }
        catch (\Exception $e) {
            $message = $e->getMessage();
        }
        return redirect('/customer')->with('feedback', $message);
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
        try {
            $customer = Customer::find($id);
            $customer_array = $customer->toArray();
            $customer_id = $customer['id'];
            $customer_name = $customer_array['name'];
            $customer->delete();

            // return redirect()->back()->with('feedback', 'Deleted ' . $invoice_name);
            $message = "Deleted " . $customer_name . "(ID: " . $customer_id . ")";
        }
        catch (\Exception $e) {
            // return redirect()->back()->with('feedback', 'Error with delete request...');
            $message = json_encode($e);
        }

        return redirect()->back()->with('feedback', $message);
    }

    /**
    * Cascades the changes to various other databases which may share similar information
    *
    * @param \Illuminate\Http\Request $request
    * @param int $id
    */
    protected function cascadeChanges(Request $request, $id)
    {
        $new_info = $request->all();
        $invoices = Invoice::where('customer_id', '=', $id)->get();

        foreach($invoices as $invoice) {
            $invoice->name = $new_info['name'];
            $invoice->company = $new_info['company'];
            $invoice->email = $new_info['email'];
            $invoice->address = $new_info['address'];
            $invoice->save();
        }
    }
    /**
    * Generates a list of possible matches for quickfilling input boxes
    *
    * @param Request/request
    * @return json_encode(object) for ajax requests
    */
    public function retrieveCustomerPreview(Request $request)
    {
        $name = $request->all();
        $name = $name[0];
        $customers = Customer::all()->toArray();

        $array = array_filter($customers, function($arr) use ($name, $customers){
            if(strtolower(substr($arr['name'], 0, strlen($name))) === strtolower($name)) {
                return $arr;
            }
        });
        if(gettype($array) === 'array') {
            if(sizeof($array) === 1) {
                $values = array_values($array);
                print_r(json_encode($values));
            }
            else {
                $values = array_values($array);
                print_r(json_encode($values));
                
            }
        }
        elseif(gettype($array) === 'object') {
            $return = [];
            foreach($array as $k => $v) {
                array_push($return, $v);
            }
            print_r($return);
        }
    }
}