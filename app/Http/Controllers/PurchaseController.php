<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Purchase;


class PurchaseController extends LedgerController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $purchases = Purchase::all();
        return view('pages.purchase.index')->with(compact('purchases'));
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
            $purchase = new Purchase;
    
            // $purchase->id = $request->input('id');
            $purchase->date = $request->input('date');
            $purchase->vendor_id = $request->input('vendor_id');
            
            $purchase->description = $request->input('description');
            $purchase->amount = $request->input('amount');
            $purchase->bill_id = $request->input('bill_id');
            $purchase->due_date = $request->input('due_date');
    
            $paid = $request->input('paid') ? 1 : 0;

            $purchase->paid = $paid;
            $purchase->notes = $request->input('notes');
            
            $more_args = array(
                'repeat'        => False,
            );

            $today = date("m-d-Y H:i:sa");

            //need to figure out which account is being affected from the purchase            
            $this->addNewEntry($today, $request->input('description'), 'Inventory', $request->input('amount'), 'Debit', 'Debit', 'Asset', $more_args);
            $more_args['repeat'] = True;
            $this->addNewEntry($today, $request->input('description'), 'Accounts Payable', $request->input('amount'), 'Credit', 'Credit', 'Liability', $more_args);



            $purchase->save();

            $message = "Successfully added new purchase";
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
        try {
            $purchase = Purchase::find($id);
            $purchase_array = $purchase->toArray();
            $purchase->delete();
            $message = "Successfully deleted purchase for '" . $purchase_array['description'] . "' (ID: " . $purchase_array['purchase_id'] . ")";
        }
        catch (\Exception $e) {
            $message = $e->getMessage();
        }

        return redirect()->back()->with('feedback', $message);
    }

    /**
    * Cascades the changes to various other databases which may 
    *   share similar information
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

    public function togglePaid($id)
    {
        try {
            $purchase = Purchase::find($id);
            $purchase_array = $purchase->toArray();

            if($purchase_array['paid'] === 0) {
                $purchase['paid'] = 1;

                $amount = $purchase['amount'];
                // $due_date = $purchase['due_date'];
                // $phone = $purchase['phone'];
                $description = $purchase['description'] . "(cash paid)";

                $more_args = array(
                'repeat'        => False,
                // 'purchase_id'    => $id
                );
                
                $today = date("m-d-Y H:i:sa");
                $lol = $this->addNewEntry($today, $description, 'Accounts Payable', $amount, 'Debit', 'Credit ', 'Liability', $more_args);
    
                $more_args['repeat'] = True;
                $this->addNewEntry($today, $description, 'Cash', $amount, 'Credit', 'Debit', 'Asset', $more_args);

                $message = 'Successfully marked paid';
            }
            else {
                $purchase['paid'] = 0;
                $message = 'Successfully marked unpaid';
            }
            $purchase->save();
        }
        catch (\Exception $e) {
            $message = $e->getMessage();
        }
        return redirect()->back()->with('feedback', $message);
    }
}
