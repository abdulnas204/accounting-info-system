<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Customer;
use App\Models\Transaction;
use App\Models\TransactionData;
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
        $tax_ids['0'] = 'None';

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
    public function store(Request $request)
    {
        try {
            $name = $request->input('name');
            $date = $request->input('date');
            $id = $request->input('customer_id');
            $company = $request->input('company');
            $email = $request->input('email');
            $address = $request->input('address');
            //TODO: Order will be the gateway to inventory - we need to also create an order here
            $order_id = $request->input('order_id');
            // $amount = $request->input('amount');
            $due_date = $request->input('due_date');
            $description = $request->input('description');
            $shipping = $request->input('shipping') ?? 0.00;

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
            $invoice->shipping = $shipping;
            $invoice->user_id = \Auth::user()->id;

            $invoice_id = Invoice::orderBy('invoice_id', 'DESC')->first()['invoice_id'] + 1;

            
            // $message = 'Successfully added invoice';
            $message = $request->input('invoice-line-item-price.0');

            $item = $request->input('invoice-line-item-name');
            $quantity = $request->input('invoice-line-item-quantity');
            $price = $request->input('invoice-line-item-price');
            $unit = $request->input('invoice-line-item-unit');
            $tax = $request->input('invoice-line-item-tax');

            $totals = $this->computeInvoiceTotal($item, $price, $quantity, $tax, $unit);

            $total_sum = 0;
            $loaded_queries = [];
            $taxes = 0;

            foreach ($totals as $total) {
                $invoice_detail = new InvoiceDetails;
                $invoice_detail->item = $total['item'];
                $invoice_detail->price = $total['price'];
                $invoice_detail->quantity = $total['quantity'];
                $invoice_detail->unit = $total['unit'];
                $invoice_detail->tax_id = $total['tax_id'];
                $invoice_detail->invoice_id = $invoice_id;
                $invoice_detail->total_value = $total['price'] * $total['quantity'] * (1 + $total['tax_percent']);
                $invoice_detail->user_id = \Auth::user()->id;

                $total_sum += $total['total_value'];
                array_push($loaded_queries, $invoice_detail);
                $taxes += $total['price'] * $total['quantity'] * $total['tax_percent'];
            }
            //$tax = TaxOptions::find($request->input('tax_id'))->toArray();
            $total_sum += (float)$shipping;

            $invoice->taxes = $taxes;
            $invoice->tax_type = $request->input('tax_id');
            $invoice->amount = $total_sum;
            $message = 'Successfully added invoice';


            $invoice->save();
            $invoice_id = $invoice->invoice_id;
            $more_args = array(
                'repeat'        => False,
                'invoice_id'    => $invoice_id
            );
            foreach($loaded_queries as $query) {
                $query->save();
            }
            // print_r($invoice);
            $today = date("m-d-Y H:i:sa");
            $this->addNewEntry($today, $description, 'Accounts Receivable', $total_sum, 'Debit', $more_args);

            // TODO: Clear out 'repeat' key and use something better to add journal entries to the same TX
            $more_args['repeat'] = True;
            $this->addNewEntry($today, $description, 'Revenues', $total_sum, 'Credit', $more_args);

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
            $invoice_id = $invoice_array['invoice_id'];
            $invoice_name = $invoice_array['name'];

            // TODO: Need to cascade the changes to tx & tx_data
            if($transaction = Transaction::where('invoice_id', $invoice_id)->first()) {

                $tx = $transaction->toArray();
                $tx_id = $tx['transaction_id'];
            
                $ledger_entry = TransactionData::where('tx_id', '=', $tx_id)->get();
                \Log::debug(json_encode($ledger_entry));
                foreach ($ledger_entry as $entry) {
                    $entry->delete();
                }
                $transaction->delete();
            }
            $invoice->delete();
            $message = "Deleted " . $invoice_name . "(ID: " . $invoice_id . ")";
        }
        catch (\Exception $e) {
            $message = $e->getMessage();
        }

        return redirect()->back()->with('feedback', $message);
    }

    protected function computeInvoiceTotal(Array $items, Array $prices, Array $quantity, Array $tax, Array $units)
    {
        $line_items = [];
        for ($i = 0; $i < sizeof($items); $i++) {
            //$tax_percentage = TaxOptions::
            $tax_percentage = TaxOptions::find($tax[$i]);
            if (empty($tax_percentage)) {
                $object = [
                    'item' => $items[$i],
                    'price' => $prices[$i],
                    'quantity' => $quantity[$i],
                    'unit' => $units[$i],
                    'tax_id' => 0,
                    'tax_percent' => 0,
                    'total_value' => $prices[$i] * $quantity[$i],
                ];
            }
            else {
                $tax_percentage = $tax_percentage->toArray()['percentage'];
                $object = [
                    'item' => $items[$i],
                    'price' => $prices[$i],
                    'quantity' => $quantity[$i],
                    'tax_id' => $tax[$i],
                    'unit' => $units[$i],
                    'tax_percent' => ((float)($tax_percentage)) / 100,
                    'total_value' => $prices[$i] * $quantity[$i] * (1+((float)$tax_percentage / 100)),
                ];
            }
            array_push($line_items, $object);
        }

        $totals = $line_items;
        return $totals;
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
                $lol = $this->addNewEntry($today, $description, 'Cash', $amount, 'Debit', $more_args);
    
                $more_args['repeat'] = True;
                $this->addNewEntry($today, $description, 'Accounts Receivable', $amount, 'Credit', $more_args);

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
