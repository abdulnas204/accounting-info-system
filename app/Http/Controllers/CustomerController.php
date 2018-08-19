<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Invoice;
use App\Helpers\Ledger;
use App\Http\Resources\Customer as CustomerResource;
use App\Helpers\HttpResponse;

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
            $customer->phone_number = $request->input('phone_number');
            $customer->city = $request->input('city');
            $customer->state = $request->input('state');
            $customer->zip = $request->input('zip');
            $customer->country = $request->input('country');
            $customer->notes = $request->input('notes');
            $customer->user_id = \Auth::user()->id;
            $customer->save();

            $message = 'Successfully entered in a customer';
        }
        catch(\Exception $e) {
            $message = $e->getMessage();
        }
        return redirect()->back()->with('feedback', $message);
    }

    /**
     * Display customers with information from other databases as well
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Ledger $ledger)
    {
        //
        //$ledger->test();
        $invoice['invoices'] = Customer::find($id)->invoice->sortByDesc('invoice_id');
        $balances = $invoice['invoices']->pluck('amount');

        $invoice['total'] = $balances->sum();
        $invoice['count'] = sizeof($invoice['invoices']);

        $customer = Customer::find($id)->first();


        // $customer['invoice'] = $invoice;
        return view('pages.customer.show')->with(compact('customer', 'invoice'));
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
        $state = $customer->toArray()['state'];

        // return view('pages.customer.edit')->with('customer', $customer)->with('state', $state);
        return view('pages.customer.edit', compact(['customer', 'state']));
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
            $customer_id = $customer['customer_id'];
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
    * @param Request/request $request
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

    /**
     * Handler for getting a customer
     */
    public function getCustomer($id)
    {
        try {
            return new CustomerResource(Customer::find($id));
        }
        catch (Exception $e) {
            return 0;
        }
    }

    /**
     * Handler for posting new Customer
     */
    public function postCustomer(Request $request)
    {
        try {
            $body = $request->all()['data'];

            $potential = Customer::where('email', '=', $body['email'])->first();

            if (empty($potential)) {
                $customer = new Customer;
                $message = 'success - new';
            }
            else {
                $customer = $potential;
                $message = 'success - update';
            }

            $customer->name = $body['name'];
            $customer->company = $body['company'];
            $customer->email = $body['email'];
            $customer->address = $body['address'];
            $customer->phone_number = $body['phone_number'];
            $customer->city = $body['city'];
            $customer->state = $body['state'];
            $customer->zip = $body['zip'];
            $customer->country = $body['country'];
            $customer->notes = $body['notes'];
            $customer->save();
            return json_encode(HttpResponse::success($message));
        }
        catch (\Exception $e) {
            return json_encode(HttpResponse::error($e->getMessage()));
        }
    }
}
