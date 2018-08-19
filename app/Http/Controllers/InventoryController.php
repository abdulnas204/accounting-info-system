<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Inventory;
use App\Models\InventoryItems;

class InventoryController extends LedgerController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $inventorys = Inventory::all()->toArray();
        $inventorys = array_reverse($inventorys);
        foreach ($inventorys as $inventory) {
            $inventory['total_value'] = 0;
        }
        return view('pages.inventory.index')->with(compact('inventorys'));
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

    protected function retrieveAllInventoryItems()
    {

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
            $name = $request->input('inventory_name');
            $description = $request->input('description');
            $vendor_name = $request->input('vendor_name');
            $vendor_id = $request->input('vendor_id');
            $date = $request->input('date');

            $units_purchased = $request->input('units_purchased');
            $unit_type = $request->input('units_type');
            $price_point = $request->input('price_point');
            $due_date = $request->input('due_date');
            $paid = $request->input('paid');
            $paid = $paid ? 1 : 0;
            $total_val = $units_purchased * $price_point;

            // Check if the inventory entry exists - if not, then create new entry
            $inventory_entry = Inventory::where('name', '=', $name)->first();
            if ($inventory_entry === null) {
                $entry = new Inventory;
                $entry->name = $name;
                $entry->description = $description;
                $entry->units = $units_purchased;
                $entry->cost_basis = $price_point;
                $entry->user_id = \Auth::user()->id;
                
                $entry->save();
            }

            // Add every inventory entry as a new record - table is only a running total though
            $inv_id = Inventory::where('name', '=', $name)->first()['inventory_id'];
            $inventory = new InventoryItems;
            $inventory->name = $name;
            // $inventory->description = $description;
            $inventory->date = $date;

            $inventory->units = $units_purchased;
            $inventory->unit_type = $unit_type;
            $inventory->cost_basis = $price_point;
            $inventory->due_date = $due_date;
            $inventory->paid = $paid;

            $inventory->vendor_id = $vendor_id;
            $inventory->inventory_id = $inv_id;
            $inventory->order_value = $total_val;


            $more_args = array(
                'repeat'        => False,
            );

            // Create entry for ledger
            $today = date("m-d-Y H:i:sa");
            $this->addNewEntry($today, $description, 'Inventory', $total_val, 'Debit', 'Debit', 'Asset', $more_args);

            $more_args['repeat'] = True;
            if ($paid) {
                $this->addNewEntry($today, $description, 'Cash', $total_val, 'Credit', 'Debit', 'Asset', $more_args);
            }
            else {
                $this->addNewEntry($today, $description, 'Accounts Payable', $total_val, 'Credit', 'Credit', 'Liability', $more_args);
            }

            $message = 'Successfully entered in an inventory';
        }
        catch(\Exception $e) {
            $message = $e->getMessage();
        }
        
        $inventory->save();
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
    public function retrieveInventoryPreview(Request $request)
    {
        $name = $request->all();
        $name = $name[0];
        $inventory = Inventory::all()->toArray();

        $array = array_filter($inventory, function($arr) use ($name, $inventory){
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
