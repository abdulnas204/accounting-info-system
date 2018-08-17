@extends('main')
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="/css/setting.css">
@stop
@section('title')
{{-- Settings --}}
@yield('title')
@stop

@section('content')
    <nav id="side-nav-menu">
        <ul>
            <li><a href="home" class="side-nav-button fake-button fake-button-a">Home</a></li>
            <li><a href="general" class="side-nav-button fake-button fake-button-a">Company General</a></li>
            <li><a href="reports" class="side-nav-button fake-button fake-button-a">Reports</a></li>
            <li><a href="taxes" class="side-nav-button fake-button fake-button-a">Taxes</a></li>
            <li><a href="localization" class="side-nav-button fake-button fake-button-a">Localization</a></li>
        </ul>
    </nav>

    <div id="setting-view-container">
        {{-- div --}}
        <div class="col-md-10">
            
        @yield('tab')
        </div>
    {{-- </div> --}}
@stop

@section('scripts')
    <script src="/js/setting.js"></script>
@stop