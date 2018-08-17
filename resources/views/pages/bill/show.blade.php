@extends('main')

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="/css/bill.css">
@stop
@section('title')
    Viewing Bill
@endsection

@section('content')
<div id="bill-view-container" >
    @if(\Session::has('feedback'))
        <p>{{ \Session::get('feedback') }}</p>
    @endif
    <a href="{{ route('bill.index') }}"><<<< Back to Bills</a>

    <div class="container col-md-8">
        
        <div class="row">
            <div class="col-md-6">
                <h2>{{ $bill['name'] }}</h2>
            </div>
            <div class="col-md-6" style="display:flex; justify-content: flex-end; margin-top: 5px">
                <a class="fake-button" href="/bill/{{$bill['bill_id']}}/edit">
                    Edit
                </a>
                &nbsp|&nbsp
                <span class="fake-button-a" onclick="if(confirm('Are you sure?')){$(this).find('form').submit()};">Delete
                    <form action="{{ url('/bill/' . $bill['bill_id']) }}" method="post">
                        {{ method_field("DELETE") }}
                        {{ csrf_field() }}
                    </form>
                </span>
                &nbsp|&nbsp
                <span class="fake-button-a" onclick="if(confirm('Are you sure?')){$(this).find('form').submit()};">
                    @if(!$bill['paid'])
                    Mark Paid
                    @else
                    Mark Unpaid
                    @endif
                    <form action="{{ url('/bill/' . $bill['bill_id'] . '/paid') }}" method="post">
                        {{ csrf_field() }}
                    </form>
                </span>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-md-8">
                {{ $bill['address'] }}  <br>
                {{ $bill['city'] }}, {{ $bill['state'] }} {{ $bill['zip'] }} {{ $bill['country'] }} <br>
                {{ $bill['phone_number'] }} | {{ $bill['email'] }}<br>
                
            </div>
            <div class="col-md-4">
                <strong>Notes:</strong> <br>
                {{ $bill['notes'] }}
            </div>
        </div>  --}}
        <hr>
            <div class="row">
                <div class="col-md-12">
                    <table>
                        <thead>
                            <tr>
                                <th>bill ID</th>
                                <th>Due Date</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>bill Created</th>
                                <th>Order ID</th>
                                <th>Paid?</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        {{-- @foreach($bill as $i) --}}
                        <tr>
                            <td>{{ $bill['bill_id'] }}</td>
                            <td>{{ $bill['due_date'] }}</td>
                            <td>{{ $bill['description'] }}</td>
                            <td>$ {{ $bill['amount'] }}</td>
                            <td>{{ $bill['created_at'] }}</td>
                            <td>{{ $bill['order_id'] }}</td>
                            <td>@if($bill['paid'])Yes @else No @endif</td>
                        </tr>
                        {{-- @endforeach --}}
                        </tbody>
                        
                    </table>
                    <hr>

                    {{-- Might need to fix this for accessibility later... --}}
                    <table>
                        <thead>
                            <tr>
                                <th>Total bills</th>
                                <td>{{ $bill['count'] }}</td>
                                {{-- <th>Average Receivable Maturity</th> --}}
                                <th>Total Outstanding</th>
                                <td>$ {{ $bill['total'] }}</td>
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