@extends('main')
@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="/css/customer.css">
@stop
@section('title')
    <h1>Manage Invoices</h1>

@stop

@section('content')
    @if(\Session::has('feedback'))
        <p>{{ Session::get('feedback') }}</p>
    @endif
    <div class="row">
        <div class="col-md-12">
            <h2>Add Invoice</h2>
            {{ Form::model($invoice, ['route' => ['invoice.update', $invoice->invoice_id], 'method' => 'POST', 'id'=>'invoice-builder-form']) }}
                {{-- <input type="hidden" name="_method" value="PUT"> --}}
                {{ method_field('PUT') }}
                @include('pages.invoice.form')
            {{ Form::close() }}
        </div>
        
    </div>

@stop

@section('scripts')
    <script src="js/invoice.js"></script>
@stop