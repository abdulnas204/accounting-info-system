@extends('main')

@section('title')
    Manage Bills
@stop

@section('content')
    @if(\Session::has('feedback'))
        <p>{{ Session::get('feedback') }}</p>
    @endif
    <a href="{{ URL::previous() }}"><<<< Back</a>
    <div class="row">
        <div class="col-md-6">
            <h2>Edit Bill</h2>
            {{ Form::model($bill, ['route' => ['bill.update', $bill->bill_id], 'method' => 'POST', 'id'=>'bill-builder-form']) }}
                <input type="hidden" name="_method" value="PUT">
                {{ method_field('PUT') }}
                {{-- {{ csrf_field() }} --}}
                @include('pages.bill.form')
            {{ Form::close() }}
        </div>
        
    </div>

@stop

@section('scripts')
    <script src="/js/bill.js"></script>
@stop
