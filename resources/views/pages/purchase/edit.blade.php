@extends('main')
@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="/css/purchase.css">
@stop
@section('title')
    Manage purchases
@stop

@section('content')
    @if(\Session::has('feedback'))
        <p>{{ Session::get('feedback') }}</p>
    @endif
    <a href="{{ URL::previous() }}"><<<< Back</a>
    <div class="row">
        <div class="col-md-6">
            <h2>Edit purchase</h2>
            {{ Form::model($purchase, ['route' => ['purchase.update', $purchase->purchase_id], 'method' => 'POST', 'id'=>'purchase-builder-form']) }}
                <input type="hidden" name="_method" value="PUT">
                {{ method_field('PUT') }}
                {{-- {{ csrf_field() }} --}}
                @include('pages.purchase.form')
            {{ Form::close() }}
        </div>
        
    </div>

@stop

@section('scripts')
    <script src="/js/purchase.js"></script>
@stop