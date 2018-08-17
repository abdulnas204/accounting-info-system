@extends('main')

@section('title')
    Viewing Invoice

@endsection

@section('content')
    {{-- {{env('APP_URL')}} --}}
<div class="row">
    <div class="col-md-4">
        
        <a href="{{ route('invoice.index') }}"><<<< Back to Invoices</a>
    </div>
    <div class="col-md-8" style="display:flex; justify-content: flex-end; margin-top: 5px">
        <a href="/invoice/{{$invoice['invoice_id']}}/print" class="fake-button" target="_blank">Print</a>
        &nbsp|&nbsp
        <a class="fake-button" href="/invoice/{{$invoice['invoice_id']}}/edit">
            Edit
        </a>
        &nbsp|&nbsp
        <span class="fake-button-a fake-button" onclick="if(confirm('Are you sure?')){$(this).find('form').submit()};">Delete
            <form action="{{ url('/invoice/' . $invoice['invoice_id']) }}" method="post">
                {{ method_field("DELETE") }}
                {{ csrf_field() }}
            </form>
        </span>
        &nbsp|&nbsp
        <span class="fake-button-a fake-button" onclick="if(confirm('Are you sure?')){$(this).find('form').submit()};">
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
<div id="invoice-view-container" >
    @if(\Session::has('feedback'))
        <p>{{ \Session::get('feedback') }}</p>
    @endif
    @include('pages.invoice.templates.default-1')

</div>

@endsection
