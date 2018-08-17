@extends('main')
@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="/css/sale.css">
    <link rel="stylesheet" href="css/sale.css">
@stop
@section('title')
Manage Sales
@stop

@section('content')
    @if(\Session::has('feedback'))
        <p>{{ Session::get('feedback') }}</p>
    @endif

    <div class="row">
        <div class="col-md-6">
            <h2>Add Sale</h2>
            {{ Form::open(['route' => 'sale.store', 'id'=>'sale-builder-form']) }}
                @include('pages.sale.form')
            {{ Form::close() }}
        </div>
        <div class="col-md-6">
            <h2>Information</h2>
            <div class="form-feedback">
                
            </div>
        </div>
    </div>
    <div class="row">
        
        <div class="col-md-12">
            <h2>Sale List</h2>
            <table id="sale-list">
                <thead>
                    <tr>
                        <th>Manage</th>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Customer Email</th>
                        <th>Customer Address</th>
                        <th>Customer State</th>
                        <th>Customer Zip</th>
                        <th>Customer Phone</th>
                        <th>Item Description</th>
                        <th>Amount</th>
                        <th>Paid?</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales as $sale)
                    <tr>
                            <td>
                            <a href="/sale/{{$sale['sale_id']}}">
                                <button>Details</button>
                            </a>
                            <a href="/sale/{{$sale['sale_id']}}/edit">
                                <button class="">Edit{{-- <span class="glyphicon glyphicon-pencil"></span> --}}</button>
                            </a> <br>
                            <button onclick="if(confirm('Are you sure?')){$(this).find('form').submit()};" href="">
                                @if(!$sale['paid'])
                                Mark Paid
                                @else
                                Mark Unpaid
                                @endif
                                <form action="{{ url('/sale/' . $sale['sale_id'] . '/paid') }}" method="post">
                                    {{ csrf_field() }}
                                </form>
                            </button>
                            <button class="" onclick="if(confirm('Are you sure?')){$(this).find('form').submit()};" href="">Delete
                                <form action="{{ route('sale.destroy', $sale['sale_id']) }}" method="post">
                                    {{-- <input type="hidden" name="_method" value="DELETE"> --}}
                                    {{ method_field("DELETE") }}
                                    {{ csrf_field() }}
                                </form>
                            </button>
                        </td>
                        <td>{{$sale['sale_id']}}</td>
                        <td>{{$sale['name']}}</td>
                        <td>{{$sale['email']}}</td>
                        <td>{{$sale['address']}}</td>
                        <td>{{$sale['state']}}</td>
                        <td>{{$sale['zip']}}</td>
                        <td>{{$sale['phone_number']}}</td>
                        <td>{{$sale['description']}}</td>
                        <td>{{$sale['amount']}}</td>
                        <td>@if($sale['paid']) Yes @else No @endif</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <ul>

            
            </ul>
        </div>
    </div>

@stop

@section('scripts')
    <script src="/js/modules/customer-preview.js"></script>
    <script src="js/sale.js"></script>
@stop