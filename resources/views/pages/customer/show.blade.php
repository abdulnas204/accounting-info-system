@extends('main')

@section('title')
    Viewing Customer
@endsection

@section('content')
<div id="customer-view-container" >
    <a href="{{ route('customer.index') }}"><<<< Back to Customers</a>

    <div class="container col-md-8">
        
        <div class="row">
            <div class="col-md-6">
                <h2>{{ $customer['name'] }}</h2>
            </div>
            <div class="col-md-6" style="display:flex; justify-content: flex-end; margin-top: 5px">
                <a class="fake-button" href="/customer/{{$customer['customer_id']}}/edit">
                    Edit
                </a>
                &nbsp|&nbsp
                <span class="fake-button fake-button-a" onclick="if(confirm('Are you sure?')){$(this).find('form').submit()};" href="">Delete
                    <form action="{{ url('/customer/' . $customer['customer_id']) }}" method="post">
                        {{ method_field("DELETE") }}
                        {{ csrf_field() }}
                    </form>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                {{ $customer['address'] }}  <br>
                {{ $customer['city'] }}, {{ $customer['state'] }} {{ $customer['zip'] }} {{ $customer['country'] }} <br>
                {{ $customer['phone_number'] }} | {{ $customer['email'] }}<br>
                
            </div>
            <div class="col-md-4">
                <strong>Notes:</strong> <br>
                {{ $customer['notes'] }}
            </div>
        </div>
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
                            
                        @foreach($invoice['invoices'] as $i)
                        <tr>
                            <td>{{ $i['invoice_id'] }}</td>
                            <td>{{ $i['due_date'] }}</td>
                            <td>{{ $i['description'] }}</td>
                            <td>{{ $i['amount'] }}</td>
                            <td>{{ $i['created_at'] }}</td>
                            <td>{{ $i['order_id'] }}</td>
                            <td>@if($i['paid'])Yes @else No @endif</td>
                        </tr>
                        @endforeach
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
