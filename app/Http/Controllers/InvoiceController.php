<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Customer;
use App\Models\TransactionList;
use App\Models\GeneralLedgerTransactions;
use App\Models\InvoiceDetails;
use App\Models\TaxOptions;

use Illuminate\Http\Request;
// use App\Http\Controllers\LedgerController;

// class InvoiceController extends Controller
class InvoiceController extends LedgerController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ids = TaxOptions::all()->toArray();
        $tax_ids = [];

        foreach ($ids as $id) {
            $tax_ids[$id['tax_id']] = $id['name'] . ' ' . $id['percentage'] . "%";
        }
        $invoices = Invoice::orderBy('invoice_id', 'DESC')->paginate(20);
        // $invoices = array_reverse($invoices);
        return view('pages.invoice.index')->with(compact('invoices', 'tax_ids'));
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
    protected function computeInvoiceTotal(Array $items, Array $prices, Array $quantity, Array $units)
    {
        $line_items = [];
        for ($i = 0;$i < sizeof($items); $i++) {
            $object = [
                'item' => $items[$i],
                'price' => $prices[$i],
                'quantity' => $quantity[$i],
                'unit' => $units[$i],
                'total_value' => $prices[$i] * $quantity[$i],
            ];
            array_push($line_items, $object);
        }

        $totals = $line_items;
        return $totals;
    }
    public function store(Request $request)
    {
        //
        try {


            $name = $request->input('name');
            $date = $request->input('date');
            // $due_date = $request->input('due_date');
            $id = $request->input('customer_id');
            $company = $request->input('company');
            $email = $request->input('email');
            $address = $request->input('address');
            $order_id = $request->input('order_id');
            // $amount = $request->input('amount');
            $due_date = $request->input('due_date');
            // $phone = $request->input('phone');
            $description = $request->input('description');


            $invoice = new Invoice;
            $invoice->name = $name;
            $invoice->customer_id = $id;
            $invoice->date = $date;
            $invoice->company = $company;
            $invoice->email = $email;
            $invoice->address = $address;
            $invoice->order_id = $order_id;
            $invoice->due_date = $due_date;
            // $invoice->phone_number = 
            $invoice->description = $description;

            $invoice_id = Invoice::orderBy('invoice_id', 'DESC')->first()['invoice_id'] + 1;

            
            $loltest = $request->input('loltest');
            // $message = 'Successfully added invoice';
            $message = $request->input('invoice-line-item-price.0');

            $item = $request->input('invoice-line-item-name');
            $quantity = $request->input('invoice-line-item-quantity');
            $price = $request->input('invoice-line-item-price');
            $unit = $request->input('invoice-line-item-unit');

            $totals = $this->computeInvoiceTotal($item, $price, $quantity, $unit);

            $total_sum = 0;
            $loaded_queries = [];
            foreach ($totals as $total) {
                $invoice_detail = new InvoiceDetails;
                $invoice_detail->item = $total['item'];
                $invoice_detail->price = $total['price'];
                $invoice_detail->quantity = $total['quantity'];
                $invoice_detail->unit = $total['unit'];
                $invoice_detail->invoice_id = $invoice_id;
                $invoice_detail->total_value = $total['price'] * $total['quantity'];

                $total_sum += $total['total_value'];
                array_push($loaded_queries, $invoice_detail);
            }
            $tax = TaxOptions::find($request->input('tax_id'))->toArray();
            $invoice->taxes = $total_sum * $tax['percentage'] / 100;
            $invoice->tax_type = $request->input('tax_id');
            $invoice->amount = $total_sum + ($total_sum * $tax['percentage'] / 100);
            $message = 'Successfully added invoice';
            


            $more_args = array(
                'repeat'        => False,
                'invoice_id'    => $invoice_id
            );
            $invoice->save();
            foreach($loaded_queries as $query) {
                $query->save();
            }
            // print_r($invoice);
            $today = date("m-d-Y H:i:sa");
            $this->addNewEntry($today, $description, 'Accounts Receivable', $total_sum, 'Debit', 'Debit', 'Asset', $more_args);

            $more_args['repeat'] = True;
            $this->addNewEntry($today, $description, 'Revenues', $total_sum, 'Credit', 'Credit', 'Revenue', $more_args);

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
        $invoice = Invoice::find($id);
        $invoice_details = $invoice->findInvoiceDetails->toArray();
        $customer_details = Customer::find($invoice->toArray()['customer_id']);
        $tax_id = $invoice->toArray()['tax_type'];
        // $invoice_details['total_value'] = $invoice_details[]
        return view('pages.invoice.show')->with(compact('invoice', 'invoice_details', 'tax_id', 'customer_details'));
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
        $ids = TaxOptions::all()->toArray();
        $tax_ids = [];

        foreach ($ids as $i) {
            $tax_ids[$i['tax_id']] = $i['name'] . ' ' . $i['percentage'] . "%";
        }

        // $tax_ids = TaxOptions::all()->toArray();
        $invoice = Invoice::find($id);
        $invoice_details = $invoice->findInvoiceDetails->toArray();
        $customer_details = Customer::find($invoice->toArray()['customer_id']);
        $tax_id = $invoice->toArray()['tax_type'];
        return view('pages.invoice.edit')->with(compact('invoice', 'invoice_details', 'customer_details', 'tax_id', 'tax_ids'));
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
            Invoice::find($id)->update($request->all());
            InvoiceDetails::
            $message = 'Edit successful';
        }
        catch (\Exception $e) {
            $message = $e->getMessage();
        }
        
        return redirect('/invoice')->with('feedback', $message);
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
            $invoice = Invoice::find($id);

            $invoice_array = $invoice->toArray();
            $invoice_id = $invoice_array['id'];
            $invoice_name = $invoice_array['name'];

            $transaction = TransactionList::where('invoice_id', $invoice_id)->first();
            $tx = $transaction->toArray();
            $tx_id = $tx['transaction_id'];
            
            $ledger_entry = GeneralLedgerTransactions::where('tx_id', $tx_id)->delete();

            $invoice->delete();
            $transaction->delete();
            $message = "Deleted " . $invoice_name . "(ID: " . $invoice_id . ")";
        }
        catch (\Exception $e) {
            $message = $e->getMessage();
        }

        return redirect()->back()->with('feedback', $message);
    }

    public function togglePaid($id)
    {
        try {
            $invoice = Invoice::find($id);
            $invoice_array = $invoice->toArray();

            if($invoice_array['paid'] === 0) {
                $invoice['paid'] = 1;

                $amount = $invoice['amount'];
                // $due_date = $invoice['due_date'];
                // $phone = $invoice['phone'];
                $description = $invoice['description'] . "(cash paid)";

                $more_args = array(
                'repeat'        => False,
                'invoice_id'    => $id
                );
                
                $today = date("m-d-Y H:i:sa");
                $lol = $this->addNewEntry($today, $description, 'Cash', $amount, 'Debit', 'Debit ', 'Asset', $more_args);
    
                $more_args['repeat'] = True;
                $this->addNewEntry($today, $description, 'Accounts Receivable', $amount, 'Credit', 'Debit', 'Asset', $more_args);

                $message = 'Successfully marked paid';
            }
            else {
                $invoice['paid'] = 0;
                $message = 'Successfully marked unpaid';
            }
            $invoice->save();
        }
        catch (\Exception $e) {
            $message = $e->getMessage();
        }
        return redirect()->back()->with('feedback', $message);
    }
    public function print($id)
    {
        $invoice = Invoice::find($id);
        $invoice_details = $invoice->findInvoiceDetails->toArray();
        $customer_details = Customer::find($invoice->toArray()['customer_id']);
        return view('pages.invoice.templates.print.default-1')->with(compact('invoice', 'invoice_details', 'customer_details'));
    }
}
