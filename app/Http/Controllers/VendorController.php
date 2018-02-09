<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $vendors = Vendor::all();
        return view('pages.vendor.index')->with(compact('vendors'));
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
        try{
            $vendor = new Vendor;

            $vendor->name = $request->input('name');
            $vendor->company = $request->input('company');
            $vendor->email = $request->input('email');
            $vendor->address = $request->input('address');
            $vendor->phone_number = $request->input('phone_number');
            $vendor->city = $request->input('city');
            $vendor->state = $request->input('state');
            $vendor->zip = $request->input('zip');
            $vendor->country = $request->input('country');
            $vendor->notes = $request->input('notes');

            $vendor->save();
            $message = "Successfully added vendor " . $request->input('name');
        }
        catch (\Exception $e) {
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
        $vendor = Vendor::find($id);

        return view('pages.vendor.show')->with(compact('vendor'));
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
        $vendor = Vendor::find($id);
        $state = $vendor->toArray()['state'];
        return view('pages.vendor.edit')->with(compact('vendor', 'state'));
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
    /**
    * Generates a list of possible matches for quickfilling input boxes
    *
    * @param Request\request $request
    * @return json_encode(object) for ajax requests
    */
    public function retrieveVendorPreview(Request $request)
    {
        $name = $request->all();
        $name = $name[0];
        $vendors = Vendor::all()->toArray();

        $array = array_filter($vendors, function($arr) use ($name, $vendors){
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
