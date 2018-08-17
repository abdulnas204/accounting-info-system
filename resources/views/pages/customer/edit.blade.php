@extends('main')

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="/css/customer.css">
@stop
@section('title')
    Edit Customer
@endsection

@section('content')
<div id="customer-view-container">
    @if(\Session::has('feedback'))
        <p>{{ Session::get('feedback') }}</p>
    @endif

    <a href="{{ URL::previous() }}"><<<< Back</a>

    <div class="customer-form">
        {{ Form::model($customer, ['route' => ['customer.update', $customer->customer_id], 'method' => 'POST']) }}
            <input type="hidden" name="_method" value="PUT">
            {{-- {{ csrf_field() }} --}}
            {{ method_field('PUT') }}
            @include('pages.customer.form')

        {{ Form::close() }}
    </div>

</div>

@endsection