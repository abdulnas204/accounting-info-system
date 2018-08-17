@extends('main')

@section('title')
    Viewing Invoice
@endsection

@section('content')
<div id="customer-view-container" >
    @if(\Session::has('feedback'))
        <p>{{ \Session::get('feedback') }}</p>
    @endif
    <a href="{{ route('invoice.index') }}"><<<< Back to Invoices</a>

    <div class="container col-md-8">
        
        <div class="row">
            <div class="col-md-6">
                <h2>{{ $invoice['name'] }}</h2>
            </div>
            <div class="col-md-6" style="display:flex; justify-content: flex-end; margin-top: 5px">
                <a class="fake-button" href="/invoice/{{$invoice['invoice_id']}}/edit">
                    Edit
                </a>
                &nbsp|&nbsp
                <span class="fake-button-a" onclick="if(confirm('Are you sure?')){$(this).find('form').submit()};">Delete
                    <form action="{{ url('/invoice/' . $invoice['invoice_id']) }}" method="post">
                        {{ method_field("DELETE") }}
                        {{ csrf_field() }}
                    </form>
                </span>
                &nbsp|&nbsp
                <span class="fake-button-a" onclick="if(confirm('Are you sure?')){$(this).find('form').submit()};">
                    @if(!$invoice['paid'])
                    Mark Paid
                    @else
                    Mark Unpaid
                    @endif
                    <form action="{{ url('/invoice/' . $invoice['invoice_id'] . '/paid') }}" method="post">
                        {{ csrf_field() }}
                    </form>
                </span>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-md-8">
                {{ $invoice['address'] }}  <br>
                {{ $invoice['city'] }}, {{ $invoice['state'] }} {{ $invoice['zip'] }} {{ $invoice['country'] }} <br>
                {{ $invoice['phone_number'] }}  | {{ $invoice['email'] }}<br>
                
            </div>
            <div class="col-md-4">
                <strong>Notes:</strong> <br>
                {{ $invoice['notes'] }}
            </div>
        </div>  --}}
        <hr>
            <div class="row">
                <div class="col-md-12">
                    <table>
                        <thead>
                            <tr>
                                <th>Invoice ID</th>
                                <th>Due Date</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Invoice Created</th>
                                <th>Order ID</th>
                                <th>Paid?</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        {{-- @foreach($invoice as $i) --}}
                        <tr>
                            <td>{{ $invoice['invoice_id'] }}</td>
                            <td>{{ $invoice['due_date'] }}</td>
                            <td>{{ $invoice['description'] }}</td>
                            <td>$ {{ $invoice['amount'] }}</td>
                            <td>{{ $invoice['created_at'] }}</td>
                            <td>{{ $invoice['order_id'] }}</td>
                            <td>@if($invoice['paid'])Yes @else No @endif</td>
                        </tr>
                        {{-- @endforeach --}}
                        </tbody>
                        
                    </table>
                    <hr>

                    {{-- Might need to fix this for accessibility later... --}}
                    <table>
                        <thead>
                            <tr>
                                <th>Total Invoices</th>
                                <td>{{ $invoice['count'] }}</td>
                                {{-- <th>Average Receivable Maturity</th> --}}
                                <th>Total Outstanding</th>
                                <td>$ {{ $invoice['total'] }}</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr></tr>
                        </tbody>
                    </table>
                </div>
            </div>

    </div>

</div>

@endsection
