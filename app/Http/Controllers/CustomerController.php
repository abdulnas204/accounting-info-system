<?php

namespace App\Http\Controllers;

use App\Customer;
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
        return view('pages.customers.index');
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

        return view('pages.customers.edit')->with('customer', $customer);
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
            return redirect()->back()->with('feedback', 'Edit successful');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('feedback', $e->getMessage());
        }
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
