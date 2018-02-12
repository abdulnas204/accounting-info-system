@extends('main')

@section('title')
{{$company_name}}

@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<canvas id="canvas"></canvas>
		</div>
	</div>

@endsection

@section('scripts')
	<script src='/js/index.js'></script>
@stop
