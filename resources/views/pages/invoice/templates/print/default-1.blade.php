@extends('headless_main')
@section('stylesheet')
    {{-- <link rel="stylesheet" href="css/inventory.css"> --}}
    <link rel="stylesheet" href="/css/invoice_templates/default-1.css">
@stop
@section('title')
    {{-- Manage inventorys --}}
@stop

@section('content')
    @include('pages.invoice.templates.default-1')
@stop